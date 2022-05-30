<?php

    class Statistiques {

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function count_delivered_commandes()
        {
            $sql = "SELECT count( commandes.id_com ) as count FROM `commandes` WHERE statut= 'livrée'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $countAll = $stmt->fetch(PDO::FETCH_ASSOC);
            return $countAll['count'];
        }
        
        public function count_validated_Commandes()
        {
            $sql = "SELECT count( commandes.id_com ) as count FROM `commandes` WHERE statut= 'Non-livré'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $countAll = $stmt->fetch(PDO::FETCH_ASSOC);
            return $countAll['count'];
        }
        public function count_clients()
        {
            $sql = "SELECT count( clients.id_Client ) as count FROM `clients`";
            $stmt   = $this->conn->prepare($sql);
            $stmt->execute();
            $countAll = $stmt->fetch(PDO::FETCH_ASSOC);
            return $countAll['count'];
        }

    }

?>
