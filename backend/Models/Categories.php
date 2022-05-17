<?php

    class Categories {

        // db
        private $conn;
        //categories properties
        public $id_Cate;
        public $nom_cate;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create()
        {

            $sql = "INSERT INTO categories (nom_cate) VALUES (:nom_cate)";

            // Clean data
            $this->nom_cate = htmlspecialchars(strip_tags($this->nom_cate));


            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':nom_cate', $this->nom_cate);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function update()
        {

            $sql = "UPDATE categories SET nom_cate = :nom_cate WHERE id_Cate = :id_Cate";

            // Clean data
            $this->nom_cate = htmlspecialchars(strip_tags($this->nom_cate));
            $this->id_Cate = htmlspecialchars(strip_tags($this->id_Cate));


            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':nom_cate', $this->nom_cate);
            $stmt->bindParam(':id_Cate', $this->id_Cate);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function delete()
        {
            $sql = "DELETE FROM categories WHERE id_Cate = :id_Cate";

            // Clean data
            $this->id_Cate = htmlspecialchars(strip_tags($this->id_Cate));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':id_Cate', $this->id_Cate);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function get()
        {
            $sql = "SELECT * FROM categories WHERE id_Cate = :id_Cate";

            // Clean data
            $this->id_Cate = htmlspecialchars(strip_tags($this->id_Cate));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':id_Cate', $this->id_Cate);

            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();
                if ($rowCount == 0) {
                    return false;
                } else {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    return $row;
                }
            } else {
                return false;
            }
        }

        public function getAll()
        {
            $sql = "SELECT * FROM categories ORDER BY id_Cate DESC";

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();
                if ($rowCount == 0) {
                    return false;
                } else {
                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $row;
                }
            } else {
                return false;
            }
        }

    }

?>
