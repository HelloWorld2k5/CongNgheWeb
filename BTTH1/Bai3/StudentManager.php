<?php

class StudentManager {
    /** @var PDO $conn */
    private $conn = null;

    public function __construct(Database $db) {
        $this->conn = $db->conn;
    }

    //Add an student
    public function addStudent($userName, $pass, $lastName, $firstName, $city, $email, $course1) {
        $sql = 'INSERT INTO Account (UserName, Pass, LastName, FirstName, City, Email, Course1)
                      VALUE (:userName, :pass, :lastName, :firstName, :city, :email, :course1);';
        $statement = $this->conn->prepare($sql);

        $statement->bindParam(':userName', $userName);
        $statement->bindParam(':pass', $pass);
        $statement->bindParam(':lastName', $lastName);
        $statement->bindParam(':firstName', $firstName);
        $statement->bindParam(':city', $city);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':course1', $course1);

        $statement->execute();
        echo 'Thêm thành công!<br>';
    }

    //Get all students
    public function getAllStudents() {
        $sql = 'SELECT * FROM Account;';
        $statement = $this->conn->query($sql);
        return $statement->fetchAll();       
    }

    //Check database exist
    public function existsTable() {
        $sql = 'SELECT * FROM Account;';
        $statement = $this->conn->query($sql);
        return $statement->rowCount();
    }
}

?>