<?php

    class Line_commande {

        public $db;
        public $product;
        public $data;

        public function __construct()
        {
            // instantiate database
            $database = new Database();
            $this->db = $database->connect();

            //Instantiate User object
            $this->utilisateur = new Line_commandes($this->db);

            // fetch data
            $this->data = json_decode(file_get_contents("php://input"));
        }

    }

?>
