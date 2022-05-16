<?php
    class Contactes {

        // db
        private $conn;
        //utilisateurs properties
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
    }
?>
