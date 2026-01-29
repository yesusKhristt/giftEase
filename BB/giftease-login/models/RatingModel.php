<?php

class RatingModel
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS vendor_ratings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            customer_id INT NOT NULL,
            order_id INT NOT NULL,
            rating INT NOT NULL,
            review TEXT DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

            UNIQUE (vendor_id, customer_id, order_id),

            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (customer_id) REFERENCES clients(id) ON DELETE CASCADE
        );
        ";

        $this->pdo->exec($sql);
    }

    public function addRating($vendorId, $customerId, $orderId, $rating, $review = null)
    {
        // Safety validation
        if ($rating < 1 || $rating > 5) {
            throw new Exception("Invalid rating value");
        }

        $stmt = $this->pdo->prepare("
            INSERT INTO vendor_ratings 
            (vendor_id, customer_id, order_id, rating, review)
            VALUES (?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $vendorId,
            $customerId,
            $orderId,
            $rating,
            $review
        ]);

        $this->updateVendorRating($vendorId);
    }

    public function hasRated($vendorId, $customerId, $orderId): bool
    {
        $stmt = $this->pdo->prepare("
            SELECT 1 
            FROM vendor_ratings 
            WHERE vendor_id = ? AND customer_id = ? AND order_id = ?
            LIMIT 1
        ");

        $stmt->execute([$vendorId, $customerId, $orderId]);
        return (bool) $stmt->fetchColumn();
    }

    public function getVendorRatings($vendorId, $limit = 10): array
    {
        $stmt = $this->pdo->prepare("
            SELECT vr.rating, vr.review, vr.created_at,
                   c.first_name, c.last_name
            FROM vendor_ratings vr
            JOIN clients c ON vr.customer_id = c.id
            WHERE vr.vendor_id = ?
            ORDER BY vr.created_at DESC
            LIMIT ?
        ");

        $stmt->bindValue(1, $vendorId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function updateVendorRating($vendorId)
    {
        $stmt = $this->pdo->prepare("
            SELECT AVG(rating) AS avg_rating, COUNT(*) AS total
            FROM vendor_ratings
            WHERE vendor_id = ?
        ");

        $stmt->execute([$vendorId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $update = $this->pdo->prepare("
            UPDATE vendors
            SET avg_rating = ?, rating_count = ?
            WHERE id = ?
        ");

        $update->execute([
            round($data['avg_rating'], 1),
            $data['total'],
            $vendorId
        ]);
    }
}
