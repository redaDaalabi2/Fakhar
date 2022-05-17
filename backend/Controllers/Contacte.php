<?php

    class Contacte {
     
        public $db;
        public $data;
        public function __construct()
        {
            // instantiate database
            $database = new Database();
            $this->db = $database->connect();

            //Instantiate User object
            $this->contacte = new Contactes($this->db);

            // fetch data
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function contacter() {

            $this->contacte->nom = $this->data->nom;
            $this->contacte->prenom = $this->data->prenom;
            $this->contacte->email = $this->data->email;
            $this->contacte->telephone = $this->data->telephone;
            $this->contacte->message = $this->data->message;

            if ($this->contacte->create_contacte()) {

                echo json_encode(array(
                    'message' => 'Contact a été créé avec succès',
                    'state' => true
                ));
            } else {
                echo json_encode(array(
                    'message' => 'error',
                    'state' => false
                ));
            }

        }

    }
?>
