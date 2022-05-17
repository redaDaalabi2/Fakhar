<?php

    class Utilisateurs
    {
        // db
        private $conn;
        //utilisateurs properties
        public $id;
        public $email;
        public $motdepasse;
        public $token;
        // client properties
        public $id_Client;
        public $nom;
        public $prenom;
        public $genre;
        public $Telephone;
        public $adresse;
        //admin properties
        public $id_Admin;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        //register
        public function checkemail()
        {
            $sql = "SELECT * FROM utilisateurs WHERE email = :email";

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':email', $this->email);

            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();
                return $rowCount;
            }
        }
        public function create_client()
        {
            $sql = " INSERT INTO utilisateurs (role, email , motdepasse) VALUES ('client' , :email , :motdepasse)";

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->motdepasse = htmlspecialchars(strip_tags($this->motdepasse));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':motdepasse', $this->motdepasse);

            $stmt->execute();

            //get the last id from visitor table
            $last_id  = $this->conn->lastInsertId();


            $sql2 = "INSERT INTO clients (nom, prenom, genre, Telephone, adresse, id_Client) 
            VALUES (:nom, :prenom, :genre, :Telephone, :adresse, " . $last_id . ")";

            // clean client informations
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->prenom = htmlspecialchars(strip_tags($this->prenom));
            $this->genre = htmlspecialchars(strip_tags($this->genre));
            $this->Telephone = htmlspecialchars(strip_tags($this->Telephone));
            $this->adresse = htmlspecialchars(strip_tags($this->adresse));

            $stmt1 = $this->conn->prepare($sql2);

            // bind data
            $stmt1->bindParam(':nom', $this->nom);
            $stmt1->bindParam(':prenom', $this->prenom);
            $stmt1->bindParam(':genre', $this->genre);
            $stmt1->bindParam(':Telephone', $this->Telephone);
            $stmt1->bindParam(':adresse', $this->adresse);

            if ($stmt1->execute()) {
                return true;
            }
            return false;
        }

        public function create_admin()
        {
            $sql = " INSERT INTO utilisateurs (role, email , motdepasse) VALUES ('admin' , :email , :motdepasse)";

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->motdepasse = htmlspecialchars(strip_tags($this->motdepasse));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':motdepasse', $this->motdepasse);

            $stmt->execute();

            //get the last id from visitor table
            $last_id  = $this->conn->lastInsertId();


            $sql2 = "INSERT INTO admin (nom, prenom, id_Admin) 
                VALUES (:nom, :prenom, " . $last_id . ")";

            // clean client informations
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->prenom = htmlspecialchars(strip_tags($this->prenom));

            $stmt1 = $this->conn->prepare($sql2);

            // bind data
            $stmt1->bindParam(':nom', $this->nom);
            $stmt1->bindParam(':prenom', $this->prenom);

            if ($stmt1->execute()) {
                return true;
            }
            return false;
        }

        /* login  */
        public function login()
        {
            $sql = "SELECT * FROM utilisateurs WHERE email = :email";

            // Clean data
            $this->email = htmlspecialchars(strip_tags($this->email));


            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':email', $this->email);


            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                return $row;
            }
            return false;
        }
        public function gen_token()
        {
            $clientAlphabet = '0123456789ABCDEFabcdefghijklmnopqrstuvwxyz@-';
            $token = password_hash(uniqid($clientAlphabet, true), PASSWORD_DEFAULT);
            return $token;
        }
        public function gave_token()
        {
            $sql = "UPDATE utilisateurs SET token = :token WHERE id = $this->id";

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':token', $this->token);

            if ($stmt->execute()) {

                return true;
            }
            return false;
        }
        public function check_token()
        {
            $sql = "SELECT * FROM utilisateurs WHERE token = :token";
            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':token', $this->token);


            if ($stmt->execute()) {

                $row = $stmt->rowcount();
                if ($row == 1) {

                    return true;
                } else {
                    return false;
                }
            }

            return false;
        }
        public function get_info_token()
        {
            $sql = "SELECT * FROM utilisateurs , clients WHERE token = :token and utilisateurs.id = clients.id_Client";

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':token', $this->token);


            if ($stmt->execute()) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                return $row;
            }

            return false;
        }
        public function get_role_token()
        {
            $sql = "SELECT role FROM utilisateurs WHERE token = :token ";

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':token', $this->token);

            if ($stmt->execute()) {

                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                return $row['role'];
            }

            return false;
        }
        public function update_client_info()
        {
            $sql = "UPDATE clients  
                SET nom = :nom , prenom=:prenom , genre=:genre , Telephone=:Telephone , adresse=:adresse
                WHERE id_Client = $this->id_Client";

            // clean client informations
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->prenom = htmlspecialchars(strip_tags($this->prenom));
            $this->genre = htmlspecialchars(strip_tags($this->genre));
            $this->Telephone = htmlspecialchars(strip_tags($this->Telephone));
            $this->adresse = htmlspecialchars(strip_tags($this->adresse));

            $stmt = $this->conn->prepare($sql);

            // bind data
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':prenom', $this->prenom);
            $stmt->bindParam(':genre', $this->genre);
            $stmt->bindParam(':Telephone', $this->Telephone);
            $stmt->bindParam(':adresse', $this->adresse);

            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }
