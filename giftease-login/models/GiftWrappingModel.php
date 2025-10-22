<?php
// ClientModel.php***

class GiftWrapppingModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    public function createTables()
    {
        // --- Clients table (linked to users table) ---
        $sql1 = "CREATE TABLE IF NOT EXISTS boxWrap (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS boxRibbon (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql3 = "CREATE TABLE IF NOT EXISTS paperBag (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql4 = "CREATE TABLE IF NOT EXISTS paperBagRibbon (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql5 = "CREATE TABLE IF NOT EXISTS chocolates (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql6 = "CREATE TABLE IF NOT EXISTS cards (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql7 = "CREATE TABLE IF NOT EXISTS softToys (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            price INT NOT NULL,
            previewImage VARCHAR(300) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            layer INT NOT NULL
        );";
        $sql8 = "CREATE TABLE IF NOT EXISTS customWrap (
            id INT AUTO_INCREMENT PRIMARY KEY,
            box INT,
            boxDeco INT,
            bag INT,
            bagDeco INT,
            softToy INT,
            chocolate INT,
            card INT,
            price INT NOT NULL,
            FOREIGN KEY (box) REFERENCES boxWrap(id) ON DELETE CASCADE,
            FOREIGN KEY (boxDeco) REFERENCES boxRibbon(id) ON DELETE CASCADE,
            FOREIGN KEY (bag) REFERENCES paperBag(id) ON DELETE CASCADE,
            FOREIGN KEY (bagDeco) REFERENCES paperBagRibbon(id) ON DELETE CASCADE,
            FOREIGN KEY (softToy) REFERENCES chocolates(id) ON DELETE CASCADE,
            FOREIGN KEY (chocolate) REFERENCES cards(id) ON DELETE CASCADE,
            FOREIGN KEY (card) REFERENCES softToys(id) ON DELETE CASCADE
            
        );";
        $sql9 = "CREATE TABLE IF NOT EXISTS giftWrapPackage (
            id INT AUTO_INCREMENT PRIMARY KEY,
            box INT,
            boxDeco INT,
            bag INT,
            bagDeco INT,
            softToy INT,
            chocolate INT,
            card INT,
            price INT NOT NULL,
            description VARCHAR(1500) NOT NULL,
            displayImage VARCHAR(300) NOT NULL,
            FOREIGN KEY (box) REFERENCES boxWrap(id) ON DELETE CASCADE,
            FOREIGN KEY (boxDeco) REFERENCES boxRibbon(id) ON DELETE CASCADE,
            FOREIGN KEY (bag) REFERENCES paperBag(id) ON DELETE CASCADE,
            FOREIGN KEY (bagDeco) REFERENCES paperBagRibbon(id) ON DELETE CASCADE,
            FOREIGN KEY (softToy) REFERENCES chocolates(id) ON DELETE CASCADE,
            FOREIGN KEY (chocolate) REFERENCES cards(id) ON DELETE CASCADE,
            FOREIGN KEY (card) REFERENCES softToys(id) ON DELETE CASCADE
            
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
            $this->pdo->exec($sql4);
            $this->pdo->exec($sql5);
            $this->pdo->exec($sql6);
            $this->pdo->exec($sql7);
            $this->pdo->exec($sql8);
            $this->pdo->exec($sql9);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function addBoxWrap($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO boxWrap (name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addBoxRibbon($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO boxRibbon (name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addPaperBag($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO paperBag(name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addPaperBagRibbon($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO paperBagRibbon(name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addChocolates($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO chocolates (name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addCard($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO cards (name, price, previewImage, displayImage, layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function addSoftToy($name, $price, $previewImage, $displayImage, $layer)
    {
        $stmt = $this->pdo->prepare("INSERT INTO softToys (name, price, previewImage, displayImage,layer) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $name,
            $price,
            $previewImage,
            $displayImage,
            $layer
        ]);
    }

    public function getBoxWrap()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM boxwrap");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBoxRibbon()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM boxribbon");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaperBag()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM paperbag");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaperBagRibbon()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM paperbagribbon");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChocolates()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM chocolates");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSoftToys()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM softtoys");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCards()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM cards");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateBoxWrap($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE boxWrap SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updateBoxRibbon($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE boxRibbon SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updatePaperBag($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE paperBag SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updatePaperBagRibbon($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE paperBagRibbon SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updateChocolates($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE chocolates SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updateCard($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE cards SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function updateSoftToy($id, $name, $price, $layer)
    {
        $stmt = $this->pdo->prepare("UPDATE softToys SET name = ?, price = ?, layer = ? WHERE id = ?");
        return $stmt->execute([
            $name,
            $price,
            $layer,
            $id
        ]);

    }

    public function deleteBoxWrap($id){
        $stmt = $this->pdo->prepare("DELETE FROM boxWrap WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deleteBoxRibbon($id){
        $stmt = $this->pdo->prepare("DELETE FROM boxRibbon WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deletePaperBag($id){
        $stmt = $this->pdo->prepare("DELETE FROM paperBag WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deletePaperBagRibbon($id){
        $stmt = $this->pdo->prepare("DELETE FROM paperBagRibbon WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deleteChocolates($id){
        $stmt = $this->pdo->prepare("DELETE FROM chocolates WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deleteCard($id){
        $stmt = $this->pdo->prepare("DELETE FROM cards WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function deleteSoftToy($id){
        $stmt = $this->pdo->prepare("DELETE FROM softToys WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Add a new customWrap
    public function addCustomWrap($box, $boxDeco, $bag, $bagDeco, $softToy, $chocolate, $card, $price)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO customWrap (box, boxDeco, bag, bagDeco, softToy, chocolate, card, price)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $box,
            $boxDeco,
            $bag,
            $bagDeco,
            $softToy,
            $chocolate,
            $card,
            $price
        ]);
    }

    // Add a new giftWrapPackage
    public function addGiftWrapPackage($box, $boxDeco, $bag, $bagDeco, $softToy, $chocolate, $card, $price, $description, $displayImage)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO giftWrapPackage (box, boxDeco, bag, bagDeco, softToy, chocolate, card, price, description, displayImage)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $box,
            $boxDeco,
            $bag,
            $bagDeco,
            $softToy,
            $chocolate,
            $card,
            $price,
            $description,
            $displayImage
        ]);
    }


}


?>