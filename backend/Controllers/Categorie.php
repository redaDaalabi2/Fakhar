<?php

    class Categorie {

        //db
        public $db;
        public $categorie;
        public $data;

        public function __construct()
        {
            // instantiate this->database
            $database = new database();
            $this->db = $database->connect();

            // instantiate Utilisateur object
            $this->categorie = new Categories($this->db);
            $this->utilisateur = new Utilisateurs($this->db);

            // get this->data
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function create_categorie()
        {

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
                return false;

            $this->categorie->nom_cate = $this->data->nom_cate;
            $this->utilisateur->token = $this->data->token;
            $role = $this->utilisateur->get_role_token();

            if ($this->utilisateur->check_token() && $role == "admin") {

                if ($this->categorie->create()) {

                    echo json_encode(array(
                        'message' => 'catégorie créée avec succès',
                        'state' => true
                    ));
                } else {
                    echo json_encode(array(
                        'message' => 'catégorie n`a pas été créée',
                        'state' => false
                    ));
                }
            }
        }

        public function update_categorie()
        {

            // push this->data into properties
            $this->categorie->id_Cate = $this->data->id_Cate;
            $this->categorie->nom_cate = $this->data->nom_cate; 
            $this->utilisateur->token = $this->data->token;
            $role = $this->utilisateur->get_role_token();
            if ($this->utilisateur->check_token() && $role == "admin") {

                if ($this->categorie->update()) {
                    echo json_encode(array(
                        'message' => 'catégorie modifier avec succès',
                        'state' => true
                    ));
                } else {
                    echo json_encode(array(
                        'message' => 'catégorie n`est pas été modifier',
                        'state' => false
                    ));
                }
            }
        }
        public function delete_categorie()
        {
            // push this->data into properties
            $this->categorie->id_Cate = $this->data->id_Cate;
            $this->utilisateur->token = $this->data->token;
            $role = $this->utilisateur->get_role_token();
            if ($this->utilisateur->check_token() && $role == "admin") {
                if ($this->categorie->delete()) {
                    echo json_encode(array('message' => 'catégorie a été supprimée', 'status' => true));
                } else {
                    echo json_encode(array('message' => 'catégorie n`a pas été supprimée', 'status' => false));
                }
            }
        }

        public function get_categorie($id_Cate)
        {
            $this->categorie->id_Cate = $id_Cate;
            $row = $this->categorie->get();
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode('Aucune catégorie trouvée');
            }
        }

        public function getAll_categorie()
        {
            $rows = $this->categorie->getAll();
            if ($rows) {
                echo json_encode(
                    $rows
                );
            } else {
                echo json_encode(array(
                    'message' => 'Aucune catégorie trouvée',
                    'state' => false
                ));
            }
        }

    }

?>
