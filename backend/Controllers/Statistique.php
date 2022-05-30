<?php

    class Statistique {

        //db
        public $db;
        //propertise
        public $utilisateur;
        public $statistique;

        public function __construct()
        {
            // instantiate Database
            $database = new Database();
            $this->db = $database->connect();

            // instantiate User object
            $this->utilisateur = new Utilisateur($this->db);
            $this->statistique = new Statistiques($this->db);
        }

        public function count_delivered_Commandes()
        {
            $count = $this->statistique->count_delivered_commandes();
            echo json_encode($count);
        }
        public function count_validated_Commandes()
        {
            $count = $this->statistique->count_validated_Commandes();
            echo json_encode($count);
        }
        public function count_clients()
        {
            $count = $this->statistique->count_clients();
            echo json_encode($count);
        }

    }

?>
