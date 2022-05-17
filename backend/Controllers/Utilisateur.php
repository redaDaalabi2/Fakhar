<?php
    class Utilisateur
    {
        public $db;
        public $product;
        public $data;

        public function __construct()
        {
            // instantiate database
            $database = new Database();
            $this->db = $database->connect();

            //Instantiate User object
            $this->utilisateur = new Utilisateurs($this->db);

            // fetch data
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function register_client()
        {

            $this->utilisateur->email = $this->data->email;
            $this->utilisateur->motdepasse = password_hash($this->data->motdepasse, PASSWORD_DEFAULT);

            $this->utilisateur->nom = $this->data->nom;
            $this->utilisateur->prenom = $this->data->prenom;
            $this->utilisateur->genre = $this->data->genre;
            $this->utilisateur->Telephone = $this->data->Telephone;
            $this->utilisateur->adresse = $this->data->adresse;

            $bol = true;
            $rowCount = $this->utilisateur->checkemail();

            if ($rowCount >= 1) {
                $bol = false;
            }

            if ($bol) {
                if ($this->utilisateur->create_client()) {

                    echo json_encode(array(
                        'message' => 'Compte créé avec succès',
                        'state' => true
                    ));
                } else {
                    echo json_encode(array(
                        'message' => 'error',
                        'state' => false
                    ));
                }
            } else {
                echo json_encode(array(
                    'message' => 'ce mail existe déjà',
                    'state' => false
                ));
            }
        }

        public function register_admin()
        {

            $this->utilisateur->email = $this->data->email;
            $this->utilisateur->motdepasse = password_hash($this->data->motdepasse, PASSWORD_DEFAULT);

            $this->utilisateur->nom = $this->data->nom;
            $this->utilisateur->prenom = $this->data->prenom;

            $bol = true;
            $rowCount = $this->utilisateur->checkemail();

            if ($rowCount >= 1) {
                $bol = false;
            }

            if ($bol) {
                if ($this->utilisateur->create_admin()) {

                    echo json_encode(array(
                        'message' => 'Compte créé avec succès',
                        'state' => true
                    ));
                } else {
                    echo json_encode(array(
                        'message' => 'error',
                        'state' => false
                    ));
                }
            } else {
                echo json_encode(array(
                    'message' => 'ce mail existe déjà',
                    'state' => false
                ));
            }
        }

        public function login()
        {

            $this->utilisateur->email = $this->data->email;
            $motdepasse = $this->data->motdepasse;

            if ($row = $this->utilisateur->login()) {

                $hachPassword = $row['motdepasse'];
                $this->utilisateur->id = $row['id'];
            }

            if ($row != 0 && password_verify($motdepasse, $hachPassword) && $row['role'] == 'admin') {
                $token = $this->utilisateur->gen_token();
                $this->utilisateur->token = $token;

                $this->utilisateur->gave_token();
                $role = $this->utilisateur->get_role_token();
                echo json_encode(array(
                    'message' => 'admin login',
                    'token' => $token,
                    'role' => $role,
                    'state' => true
                ));
            } elseif ($row != 0 && password_verify($motdepasse, $hachPassword)) {
                $token = $this->utilisateur->gen_token();
                $this->utilisateur->token = $token;
                $this->utilisateur->gave_token();
                echo json_encode(array(
                    'message' => 'utilisateur login', 'token' => $token,
                    'state' => true
                ));
            } elseif ($row != 0) {
                echo json_encode(array(
                    'message' => 'données non valides',
                    'state' => false
                ));
            } else {
                echo json_encode(array('message' => "l'utilisateur n'existe pas", 'state' => false));
            }
        }

        public function get_info_client_token()
        {

            $this->utilisateur->token = $this->data->token;
            if ($info = $this->utilisateur->get_info_token()) {
                echo json_encode(array('info' => $info));
            } else {
                echo json_encode(array('message' => "token non valide"));
            }
        }
        public function check_token()
        {
            
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                echo json_encode(array('message' => 'token est valide'));
            } else {
                echo json_encode(array('message' => "token non valide"));
            }
        }
        public function get_role_token()
        {

            $this->utilisateur->token = $this->data->token;

            if ($this->utilisateur->check_token()) {
                if ($role = $this->utilisateur->get_role_token()) {
                    echo json_encode(array('role' => $role));
                }
            } else {
                echo json_encode(array('message' => "token non valide"));
            }
        }
        public function get_id_token()
        {

            $this->utilisateur->token = $this->data->token;

            if ($this->utilisateur->check_token()) {
                if ($info = $this->utilisateur->get_info_token()) {
                    echo json_encode(array('id' => $info['id']));
                }
            } else {
                echo json_encode(array('message' => "token non valide"));
            }
        }
        public function get_info_client()
        {
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                if ($info = $this->utilisateur->get_info_token()) {
                    echo json_encode($info);
                }
            }
        }

        public function update_client_info()
        {
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                if ($info = $this->utilisateur->get_info_token()) {
                    $this->utilisateur->id_Client = $info['id'];
                    $this->utilisateur->nom = $this->data->nom;
                    $this->utilisateur->prenom = $this->data->prenom;
                    $this->utilisateur->genre = $this->data->genre;
                    $this->utilisateur->Telephone = $this->data->Telephone;
                    $this->utilisateur->adresse = $this->data->adresse;

                    if ($this->utilisateur->update_client_info()) {
                        echo json_encode(array('message' => "Update successfuly", 'state' => true));
                    } else {
                        echo json_encode(array('message' => "err", 'state' => false));
                    }
                }
            }
        }
    }
?>
