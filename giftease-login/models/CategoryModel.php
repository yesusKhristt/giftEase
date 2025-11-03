<?php
class CategoryModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists();
    }

    public function createTableIfNotExists()
    {
        $sql1 = "
        CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL
        );
         ";

        $sql2 = "
        CREATE TABLE IF NOT EXISTS subCategories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL,
            category INT NOT NULL,
            FOREIGN KEY (category) REFERENCES categories(id) ON DELETE CASCADE
        );
         ";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function addCategory($name)
    {
        $stmt = $this->pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
    }

    public function addSubcategory($name, $category)
    {
        $stmt = $this->pdo->prepare("INSERT INTO subCategories (name, category) VALUES (?, ?)");
        $stmt->execute([$name, $category]);
    }

    public function getCategory()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubcategory($category_ID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM subCategories WHERE category = ?");
        $stmt->execute([$category_ID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSubcategory()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM subCategories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $name){
        $stmt = $this->pdo->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->execute([$name, $id]);

    }

    public function deleteCategory($id){
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);

    }

    public function updateSubcategory($id, $name, $category){
        $stmt = $this->pdo->prepare("UPDATE subCategories SET name = ?, category = ? WHERE id = ?");
        $stmt->execute([$name, $category, $id]);

    }

    public function deleteSubcategory($id){
        $stmt = $this->pdo->prepare("DELETE FROM subCategories WHERE id = ?");
        $stmt->execute([$id]);

    }
}