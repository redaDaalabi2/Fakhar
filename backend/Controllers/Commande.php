<?php

    class Commande {

        //db
        public $db;
        //properties
        public $produit;
        public $utilisateur;
        public $linecmd;
        public $commande;
        // data from json
        public $data;

        public function __construct()
        {
            // instantiate Database
            $database = new Database();
            $this->db = $database->connect();

            // instantiate utilisateur object
            $this->produit = new Poteries($this->db);
            $this->commande = new Commandes($this->db);
            $this->utilisateur = new Utilisateurs($this->db);

            // getdata
            $this->data = json_decode(file_get_contents("php://input"));
        }

        //public function create commande 
        public function create_commande()
        {
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                $this->commande->Client_Id = $this->data->Client_Id;
                $this->commande->statut = $this->data->statut;
                $this->commande->quantite_com = $this->data->quantite_com;
                $this->commande->prix_totale = $this->data->prix_totale;
                $this->commande->produit_Id = $this->data->produit_Id;
                if ($this->commande->create()) {
                    echo json_encode(array("message" => "commande created"));
                } else {
                    echo json_encode(array("message" => "commande not created"));
                }   
            }
        }

        //public function getAll commande
        public function getAll_commande()
        {
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                $commandes = $this->commande->getAll();
                echo json_encode($commandes);
            }
        }

        public function getOne_commande($id_com)
        {
            $this->commande->id_com = $id_com;
            $row = $this->commande->getOne_commande();
            if ($row) {
                echo json_encode($row);
            } else {
                echo json_encode('aucun commande trouvé');
            }
        }

        public function get_commande_with_client_and_product()
        {
            $commandes = $this->commande->getAll_commande();
            echo json_encode($commandes);
        }

        public function showCommande()
        {
            $rows = $this->commande->show_Commande();
            if ($rows) {
                echo json_encode(array(
                    'message' => $rows,
                    'state' => true
                ));
            } else {
                echo json_encode(array(
                    'message' => 'aucune commande trouvée',
                    'state' => false
                ));
            }
        }

        public function show_linecmd_commande($com_Id)
        {
            $this->linecmd->com_Id = $com_Id;
            $rows = $this->linecmd->getAll_linecmd();
            echo json_encode(array(
                'message' => $rows,
                'state' => true
            ));
        }

        public function delivered()
        {
            $this->utilisateur->token = $this->data->token;
            $role = $this->utilisateur->get_role_token();
            if ($this->utilisateur->check_token() && $role == "admin") {
                $this->commande->id_com = $this->data->id_com;
                $this->commande->delivered();
                echo json_encode(array(
                    'message' => 'dazet lamana',
                    'state' => true
                ));
            }
        }

        public function validate()
        {
            $this->utilisateur->token = $this->data->token;
            $id_com = $this->data->id_com;
            $this->commande->id_com = $id_com;
            $resultCommande  = $this->commande->get();
            /* idClient from commande table */
            $idClient_commande = $resultCommande['Client_Id'];
            $info = $this->utilisateur->get_info_token();
            /* idClient from token */
            $idClient = $info['Client_Id'];
            if ($idClient == $idClient_commande) {
                $date = date("Y-m-d");
                $this->commande->date = $date;
                $this->commande->update_validate();
                echo json_encode(array('message' => 'Cette commande a été validé', 'date' => $date, 'state' => true));
            } else {
                echo json_encode(array(
                    'message' => 'Cette commande n`a pas été validée',
                    'state' => false
                ));
            }
        }

        public function get_Number_Commande()
        {
            $result = $this->commande->count_commande();
            if ($result) {
                echo json_encode($result);
            } else {
                echo json_encode(["error"]);
            }
        }

        public function update_quantite_poterie(){
            $this->utilisateur->token = $this->data->token;
            $this->produit->id_produit = $this->data->id_produit;
            $this->produit->quantite = $this->data->quantite;
            if ($this->utilisateur->check_token()) {
                if ($this->produit->update_quantite()){
                    echo json_encode(array(
                        'message' => 'quantite modifier avec succès',
                        'state' => true
                    ));
                }else{
                    echo json_encode(array(
                    'message' => 'quantite n`a pas été modifier',
                    'state' => false
                    ));
                }
            }
        }

        public function update_statut_commande(){
            $this->utilisateur->token = $this->data->token;
            $this->commande->id_com = $this->data->id_com;
            if ($this->utilisateur->check_token()) {
                if ($this->commande->update_statut()) {
                    echo json_encode(array(
                        'message' => 'statut modifier avec succès',
                        'state' => true
                    ));
                } else {
                    echo json_encode(array(
                        'message' => 'statut n`a pas été modifier',
                        'state' => false
                    ));
                }
            }
        }

    }

?>
