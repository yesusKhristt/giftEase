<?php
class ProductsModel
{
    private $pdo;
    private $user;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function createTableIfNotExists()
    {
        //INSERT INTO products (vendor_id, name, price, description,mainCategory, subCategory, created_at) VALUES (9, 'Apex Slaughterspine', 35, 'COOLEST FICTIONAL DINASAUR EVER', 1,13, CURRENT_TIMESTAMP);
        $sql2 = "
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            name VARCHAR(500) NOT NULL,
            price INT NOT NULL,
            description VARCHAR(3000) NOT NULL,
            status VARCHAR(20) NOT NULL,
            mainCategory INT NOT NULL,
            subCategory INT NOT NULL,
            totalStock INT NOT NULL,
            reservedStock INT NOT NULL,
            sold INT NOT NULL,
            impressions INT NOT NULL,
            clicks INT NOT NULL,
            raiting INT NOT NULL,
            displayImage VARCHAR(500) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (mainCategory) REFERENCES categories(id) ON DELETE CASCADE,
            FOREIGN KEY (subCategory) REFERENCES subcategories(id) ON DELETE CASCADE
        );
         ";

        $sql3 = "
         CREATE TABLE IF NOT EXISTS productImages (
            product_id INT NOT NULL,
            sortOrder INT NOT NULL,
            image_loc VARCHAR(500) NOT NULL,
            PRIMARY KEY (product_id, sortOrder),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );
        ";

        try {
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function fetchAll()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products");
        $stmt->execute();

        // Fetch all rows as an array of associative arrays
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchAllfromVendor($Vendor_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE vendor_id = $Vendor_id");
        $stmt->execute();

        // Fetch all rows as an array of associative arrays
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  public function fetchProduct($productId)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM products WHERE id = $productId");
        $stmt1->execute();
        $product1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $this->pdo->prepare("SELECT image_loc FROM productimages WHERE product_id = $productId ORDER BY sortOrder ASC");
        $stmt2->execute();
        $product2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $stmt3 = $this->pdo->prepare("SELECT shopName, phone, rating FROM vendors WHERE id = ?");
        $stmt3->execute([$product1[0]['vendor_id']]);
        $product3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
        

        return [
            'id' => $product1[0]['id'],
            'name' => $product1[0]['name'],
            'price' => $product1[0]['price'],
            'description' => $product1[0]['description'],
            'totalStock' => $product1[0]['totalStock'],
            'reservedStock' => $product1[0]['reservedStock'],
            'impressions' => $product1[0]['impressions'],
            'subcategory' => $product1[0]['subCategory'],
            'category' => $product1[0]['mainCategory'],
            'sold' => $product1[0]['sold'],
            'clicks' => $product1[0]['clicks'],
            'rating' => $product1[0]['raiting'],
            'images' => $product2,
            'shop' => $product3[0]['shopName'],
            'phone' => $product3[0]['phone'],
            'vendorRating' => $product3[0]['rating']
        ];

    }
    public function fetchProductPic($productId)
    {
        $stmt2 = $this->pdo->prepare("SELECT image_loc FROM productimages WHERE product_id = $productId ORDER BY sortOrder ASC");
        $stmt2->execute();
        return $stmt2->fetchAll(PDO::FETCH_ASSOC);

    }

    public function fetchProductPicCol($productId)
    {
        $stmt2 = $this->pdo->prepare("SELECT image_loc FROM productimages WHERE product_id = $productId ORDER BY sortOrder ASC");
        $stmt2->execute();
        return $stmt2->fetch(PDO::FETCH_ASSOC);

    }


    public function deleteProduct($productId)
    {
        $stmt1 = $this->pdo->prepare("DELETE FROM products WHERE id = $productId");
        $stmt1->execute();
    }

    public function addProduct($vendor_id, $name, $price, $description, $mainC, $subC, $profilePath)
    {
        $stmt1 = $this->pdo->prepare("INSERT INTO products (vendor_id, name, price, description, status, mainCategory, subCategory, totalStock, reservedStock, sold, impressions, clicks, raiting, displayImage, created_at) VALUES (?, ?, ?, ?, 'active',? ,  ? , 0 ,0, 0, 0, 0, 0, ? ,CURRENT_TIMESTAMP)");
        $stmt1->execute([
            $vendor_id,
            $name,
            $price,
            $description,
            $mainC,
            $subC,
            $profilePath[0]
        ]);
        $productID = $this->pdo->lastInsertId();
        ;
        $sort = 1;
        foreach ($profilePath as $image) {
            $stmt2 = $this->pdo->prepare("INSERT INTO productImages (product_id, sortOrder, image_loc) VALUES (?, ? ,?)");
            $stmt2->execute([
                $productID,
                $sort,
                $image
            ]);
            $sort++;
        }
        return $productID;
    }

    public function addStock($product_id, $stockQuantity)
    {
        $stmt1 = $this->pdo->prepare("SELECT totalStock from products WHERE id = ?");
        $stmt1->execute([
            $product_id
        ]);
        $currStock = $stmt1->fetch();
        $newstock = $currStock[0] + $stockQuantity;
        $stmt2 = $this->pdo->prepare("UPDATE products SET totalStock = ? WHERE id = ?");
        $stmt2->execute([
            $newstock,
            $product_id
        ]);
    }

    public function substractStock($product_id, $stockQuantity)
    {
        $stmt1 = $this->pdo->prepare("SELECT totalStock from products WHERE id = ?");
        $stmt1->execute([
            $product_id
        ]);
        $currStock = $stmt1->fetch();
        if ($currStock[0] - $stockQuantity >= 0) {
            $stmt2 = $this->pdo->prepare("UPDATE products SET totalStock = ? WHERE id = ?");
            $stmt2->execute([
                $currStock[0] - $stockQuantity,
                $product_id
            ]);
            return true;
        }
        else{
            return false;
        }
    }

    
    public function addReserved($product_id, $stockQuantity)
    {
        $stmt1 = $this->pdo->prepare("SELECT reservedStock from products WHERE id = ?");
        $stmt1->execute([
            $product_id
        ]);
        $currStock = $stmt1->fetch();
        $newstock = $currStock[0] + $stockQuantity;
        $stmt2 = $this->pdo->prepare("UPDATE products SET reservedStock = ? WHERE id = ?");
        $stmt2->execute([
            $newstock,
            $product_id
        ]);
    }

    public function substractReserved($product_id, $stockQuantity)
    {
        $stmt1 = $this->pdo->prepare("SELECT reservedStock from products WHERE id = ?");
        $stmt1->execute([
            $product_id
        ]);
        $currStock = $stmt1->fetch();
        if ($currStock[0] - $stockQuantity >= 0) {
            $stmt2 = $this->pdo->prepare("UPDATE products SET reservedStock = ? WHERE id = ?");
            $stmt2->execute([
                $currStock[0] - $stockQuantity,
                $product_id
            ]);
            return true;
        }
        else{
            return false;
        }
    }

    public function editProduct($product_id, $name, $price, $description, $mainC, $subC, $profilePath)
    {
        // fallback to DB images if $profilePath is empty
        if (empty($profilePath)) {
            $profilePath = $this->fetchProductPic($product_id);
            $notuploaded = true;
        } else {
            $notuploaded = false;
        }

        // get displayImage safely
        if (empty($profilePath)) {
            $displayImage = null; // no images at all
        } else {
            $first = $profilePath[0];
            $displayImage = $notuploaded ? $first['image_loc'] : $first;
        }

        // update products table
        $stmt1 = $this->pdo->prepare('
        UPDATE products 
        SET name = ?, price = ?, description = ?, mainCategory = ?, subCategory = ?, displayImage = ?  
        WHERE id = ?
    ');
        $stmt1->execute([
            $name,
            $price,
            $description,
            $mainC,
            $subC,
            $displayImage,
            $product_id
        ]);

        // delete old images
        $stmt3 = $this->pdo->prepare("DELETE FROM productImages WHERE product_id = ?");
        $stmt3->execute([$product_id]);

        // insert new images
        $sort = 1;
        foreach ($profilePath as $row) {
            $image = $notuploaded ? $row['image_loc'] : $row;
            $stmt2 = $this->pdo->prepare("
            INSERT INTO productImages (product_id, sortOrder, image_loc)
            VALUES (?, ?, ?)
        ");
            $stmt2->execute([
                $product_id,
                $sort,
                $image
            ]);
            $sort++;
        }
    }

}