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

    }

?>
