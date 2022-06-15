<?php

    class Commandes {

        //db
        private $conn;

        //Line_commandes properties
        public $id_com;
        public $Client_Id;
        public $date;
        public $statut;
        public $prix_totale;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function last_commande()
        {
            $sql = "SELECT * FROM commandes WHERE Client_Id = $this->Client_Id AND statut = 'en cours'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function create()
        {
            $sql = "INSERT INTO commandes (statut, Client_Id) VALUES ('$this->statut','$this->Client_Id')";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public function show_commande()
        {
            $sql = "SELECT * FROM commandes o , clients c WHERE o.statut != 'en cour' and o.Client_Id =c.Client_Id ORDER BY id_com DESC";
            $stmt = $this->conn->prepare($sql);
            if ($stmt->execute()) {
                $rowCount = $stmt->rowCount();
                if ($rowCount == 0
                ) {
                    return false;
                } else {
                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return $row;
                }
            } else {
                return false;
            }
        }
        public function delivered()
        {
            $sql = "UPDATE commandes SET statut = 'livré'  WHERE id_com=$this->id_com";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        public function get()
        {
            $sql = "SELECT * FROM commandes WHERE id_com=$this->id_com";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function update_validate()
        {
            $sql = "UPDATE commandes SET statut = 'Non-livré' , date = '$this->date' WHERE id_com=$this->id_com";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        public function update_prix()
        {
            $sql = "UPDATE commandes SET  prix_totale = $this->prix_totale WHERE id_com=$this->id_com";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }

        public function count_commande()
        {
            $sql = "SELECT COUNT(*) as counter FROM commandes";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $rowCount = $stmt->fetchColumn();
            return $rowCount;
        }

    }

?>
