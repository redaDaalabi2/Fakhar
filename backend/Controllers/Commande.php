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
            $this->linecmd = new Line_commandes($this->db);
            $this->utilisateur = new Utilisateurs($this->db);

            // getdata
            $this->data = json_decode(file_get_contents("php://input"));
        }

        public function create()
        {
            $this->utilisateur->token = $this->data->token;

            if ($this->utilisateur->check_token()) {

                $this->produit->id_produit = $this->data->id_produit;
                $quantite = $this->data->quantite;
                $resultProduit = $this->produit->get();

                if (!isset($quantite) || empty($quantite)) {
                    $quantite = 1;
                }
                if ($resultProduit['quantite'] >= $quantite) {
                    $this->linecmd->quantite = $quantite;
                    $this->linecmd->prix_totale = $resultProduit['prix'] * $quantite;
                    $this->linecmd->id_produit = $resultProduit['id_produit'];
                    $infoClient = $this->utilisateur->get_info_token();
                    $this->commande->Client_Id = $infoClient['id'];
                    $resultCommande = $this->commande->last_commande();

                    if (empty($resultCommande) || $resultCommande[0]['statut'] != "en cour") {
                        $this->commande->statut = "en cour";
                        if ($this->commande->create()) {
                            $resultCommande = $this->commande->last_commande();
                            $this->linecmd->id_com = $resultCommande[0]['id_com'];
                            if ($this->linecmd->create()) {
                                echo json_encode(array(
                                    'message' => 'La commande a été créée et le produit a été ajouté à votre panier',
                                    'state' => true
                                ));
                                $this->produit->quantite = $resultProduit['quantity'] - $quantite;
                                $this->produit->update_quantite();
                            } else {
                                echo json_encode(array(
                                    'message' => 'La commande a été créée et le produit n`a pas été ajouté à votre panier',
                                    'state' => false
                                ));
                            }
                        } else {
                            echo json_encode(array(
                                'message' => 'la commande n`a pas été créée',
                                'state' => false
                            ));
                        }
                    } else {
                        $this->linecmd->com_Id = $resultCommande[0]['com_Id'];
                        if (empty($this->linecmd->product_existe())) {
                            if ($this->linecmd->create()) {
                                echo json_encode(array(
                                    'message' => 'Le produit a été ajouté à votre panier',
                                    'state' => true
                                ));
                                $this->produit->quantite = $resultProduit['quantite'] - $quantite;
                                $this->produit->update_quantite();
                            } else {
                                echo json_encode(array(
                                    'message' => 'Le produit n`a pas été ajouté à votre panier',
                                    'state' => false
                                ));
                            }
                        } else {
                            echo json_encode(array(
                                'message' => 'le produit existe déjà dans votre panier',
                                'state' => false
                            ));
                        }
                    }
                } else {
                    echo json_encode(array(
                        'message' => 'Stoke ne suffit pas',
                        'state' => false
                    ));
                }
            } else {

                echo json_encode(array(
                    'authentification' => false
                ));
            }
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

    }

?>
