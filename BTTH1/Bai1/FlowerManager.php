<?php

class FlowerManager {
    /** @var PDO conn */
    private $conn = null;

    public function __construct(Database $db)
    {
        $this->conn = $db->conn;
    }

    public function addFlower($name, $desc, $src) {
        $sql = 'INSERT INTO Flower (Name, Description, Src) VALUE (:name, :desc, :src);';

        $statement = $this->conn->prepare($sql);

        $statement->bindParam(':name', $name);
        $statement->bindParam(':desc', $desc);
        $statement->bindParam(':src', $src);

        $statement->execute();
    }

    public function getAllFlowers() {
        $sql = 'SELECT * FROM Flower;';
        $statement = $this->conn->query($sql);
        return $statement->fetchAll();
    }

    public function updateFlower($id, $name, $desc, $src) {
        $sql = 'UPDATE Flower SET Name = :name, Description = :desc, Src = :src WHERE ID = :id;';
        $statement = $this->conn->prepare($sql);
        $statement->execute([
            'name' => $name,
            'desc' => $desc,
            'src' => $src
        ]);
    }

    public function deleteFlower($id) {
        $sql = 'DELETE FROM Flower WHERE ID = :id;';
        $statement = $this->conn->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function existsTable() {
        $sql = 'SELECT * FROM Flower;';
        $statement = $this->conn->query($sql);
        return $statement->rowCount();
    }
}

?>