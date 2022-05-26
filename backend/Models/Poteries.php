<?php

    class Poteries {

        //db
        private $conn;

        //Poteries properties
        public $id_produit;
        public $Cate_Id;
        public $nom;
        public $quantite;
        public $prix;
        public $descreption;
        public $image;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create()
        {
            $sql = "INSERT INTO produits (Cate_Id , nom , quantite , prix , descreption , image) VALUES (:Cate_Id , :nom , :quantite , :prix , :descreption , :image)";

            // Clean data
            $this->Cate_Id = htmlspecialchars(strip_tags($this->Cate_Id));
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->quantite = htmlspecialchars(strip_tags($this->quantite));
            $this->prix = htmlspecialchars(strip_tags($this->prix));
            $this->descreption = htmlspecialchars(strip_tags($this->descreption));
            $this->image = htmlspecialchars(strip_tags($this->image));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':Cate_Id', $this->Cate_Id);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':quantite', $this->quantite);
            $stmt->bindParam(':prix', $this->prix);
            $stmt->bindParam(':descreption', $this->descreption);
            $stmt->bindParam(':image', $this->image);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function get()
        {
            $sql = "SELECT * FROM produits p , categories c WHERE id_produit = :id_produit and c.id_Cate=p.Cate_Id";

            // Clean data
            $this->id_produit = htmlspecialchars(strip_tags($this->id_produit));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':id_produit', $this->id_produit);

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

            $sql = "SELECT * FROM produits p , categories c WHERE c.id_Cate=p.Cate_Id  ORDER BY id_produit DESC";

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

        public function getAll_quantite_notNull()
        {

            $sql = "SELECT * FROM produits p , categories c WHERE c.id_Cate=p.Cate_Id and quantite >=1  ORDER BY id_produit DESC";

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

        public function update()
        {

            $sql = "UPDATE produits SET Cate_Id = :Cate_Id , nom = :nom ,quantite = :quantite ,prix = :prix ,descreption = :descreption ,image = :image   WHERE id_produit = :id_produit";

            // Clean data
            $this->id_produit = htmlspecialchars(strip_tags($this->id_produit));
            $this->Cate_Id = htmlspecialchars(strip_tags($this->Cate_Id));
            $this->nom = htmlspecialchars(strip_tags($this->nom));
            $this->quantite = htmlspecialchars(strip_tags($this->quantite));
            $this->prix = htmlspecialchars(strip_tags($this->prix));
            $this->descreption = htmlspecialchars(strip_tags($this->descreption));
            $this->image = htmlspecialchars(strip_tags($this->image));


            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':id_produit', $this->id_produit);
            $stmt->bindParam(':Cate_Id', $this->Cate_Id);
            $stmt->bindParam(':nom', $this->nom);
            $stmt->bindParam(':quantite', $this->quantite);
            $stmt->bindParam(':prix', $this->prix);
            $stmt->bindParam(':descreption', $this->descreption);
            $stmt->bindParam(':image', $this->image);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function update_quantite()
        {
            $sql = "UPDATE produits SET quantite=$this->quantite WHERE id_produit=$this->id_produit";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function delete()
        {
            $sql = "DELETE FROM produits WHERE id_produit = :id_produit";

            // Clean data
            $this->id_produit = htmlspecialchars(strip_tags($this->id_produit));

            // Prepare query
            $stmt = $this->conn->prepare($sql);

            // Bind data
            $stmt->bindParam(':id_produit', $this->id_produit);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function top_produit()
        {
            $sql = "SELECT  p.* , count(l.id_produit) as count FROM produits p , linecmd l WHERE p.id_produit=l.id_produit  GROUP BY l.id_produit ORDER by count DESC LIMIT 4";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }

    }

?>
