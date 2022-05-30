<?php

    class Line_commandes {

        //db
        private $conn;

        //Line_commandes properties
        public $id_linecmd;
        public $com_Id;
        public $produit_Id;
        public $quantite;
        public $prix_totale;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function create()
        {
            $sql = "INSERT INTO linecmd (com_Id , produit_Id , quantite , prix_totale) VALUES ('$this->com_Id', '$this->produit_Id', '$this->quantite','$this->prix_totale')";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function product_existe()
        {
            $sql = ("SELECT * FROM linecmd WHERE com_Id=$this->com_Id and produit_Id=$this->produit_Id");
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAll_linecmd()
        {
            $sql = "SELECT l.id_linecmd, l.com_Id, l.produit_Id, l.quantite, l.prix_totale , p.nom, p.prix, p.image  FROM linecmd l ,produits p  WHERE l.produit_Id=p.id_produit and l.id_linecmd=$this->id_com ORDER BY l.id_linecmd DESC";
            $stmt   = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function count_linecmd()
        {
            $sql = "SELECT COUNT(linecmd.id_linecmd) as count FROM linecmd , commandes  WHERE linecmd.com_Id = commandes.id_com and commandes.id_com = $this->id_com";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $countAll = $stmt->fetch(PDO::FETCH_ASSOC);
            return $countAll['count'];
        }

        public function calc_quantite_cmd_produit_All()
        {
            $sql = "SELECT SUM(l.quantite) as quantite FROM linecmd l , produits p WHERE l.produit_Id = p.id_produit and l.com_Id =$this->com_Id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $quantite_10 = $stmt->fetch(PDO::FETCH_ASSOC);
            return $quantite_10['quantite'];
        }

        public function get_linecmd()
        {
            $sql = "SELECT * FROM linecmd WHERE id_linecmd = $this->id_linecmd";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result_linecmd = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result_linecmd;
        }
        public function delete()
        {
            $sql = "DELETE FROM linecmd WHERE id_linecmd=$this->id_linecmd";
            $stmt   = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        function update_quantite_prix_totale_linecmd()
        {
            $sql = "UPDATE linecmd SET quantite=$this->quantite , prix_totale=$this->prix_totale WHERE id_linecmd=$this->id_linecmd";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }

?>
