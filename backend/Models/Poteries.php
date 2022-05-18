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
        public $description;
        public $image;

        public function __construct($db)
        {
            $this->conn = $db;
        }

    }

?>
