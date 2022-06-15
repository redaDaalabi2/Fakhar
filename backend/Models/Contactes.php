<?php
    class Contactes {

        // db
        private $conn;
        //utilisateurs properties
        public $id;
        public $nom;
        public $prenom;
        public $email;
        public $telephone;
        public $message;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create_contacte() {
            // request
            $sql = "INSERT INTO contact (`nom`, `prenom`, `email`, `telephone`, `message`) 
                VALUES (:nom,:prenom,:email,:telephone,:message)";

            // prepare request
            $stmt = $this->conn->prepare($sql);

            //bind data
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':prenom', $this->prenom);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':telephone', $this->telephone);
            $stmt->bindParam(':message', $this->message);

            // exectute
            return $stmt->execute();
        }

        // get all contactes
        public function get_contactes() {
            $sql = "SELECT * FROM contact";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function delete_contacte() {
            $sql = "DELETE FROM contact WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);
            return $stmt->execute();
        }

        public function count_contacte()
        {
            $sql = "SELECT COUNT(*) as counter FROM contact";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rowCount = $stmt->fetchColumn();
            return $rowCount;
        }
    }
?>
