<?php

    class Line_commande {

        /* db */
        public $db;
        /* properties */
        public $utilisateur;
        public $linecmd;
        public $commande;
        public $produit;
        /* data from json */
        public $data;

        public function __construct()
        {
            // instantiate Database
            $database = new Database();
            $this->db = $database->connect();

            // instantiate User object
            $this->commande = new Commandes($this->db);
            $this->linecmd = new Line_commandes($this->db);
            $this->utilisateur = new Utilisateurs($this->db);
            $this->produit = new Poteries($this->db);

            // getdata
            $this->data = json_decode(file_get_contents("php://input"));
        }

        function index()
        {
            $this->utilisateur->token = $this->data->token;
            if ($this->utilisateur->check_token()) {
                $infoClient = $this->utilisateur->get_info_token();
                $this->commande->idClient = $infoClient['id'];
                $resultCommande = $this->commande->last_commande();
                $countAll = 0;
                $delivery = 0;
                $calcprix = 0;
                $totaleprix = 0;
                if (!empty($resultCommande)) {
                    $this->linecmd->com_Id = $resultCommande[0]['com_Id'];
                    $countAll = $this->linecmd->count_linecmd();
                    if ($countAll != 0) {
                        $quantite_All = $this->linecmd->calc_quantite_cmd_produit_All();
                        $getAll = $this->linecmd->getAll_linecmd();
                        /* Calculateur de frais de livraison */
                        if ($quantite_All != 0) {
                            if ($quantite_All <= 3) {
                                $delivery = 10;
                            } elseif ($quantite_All <= 5) {
                                $delivery = 5;
                            } else {
                            }
                        } else {
                            $delivery = 0;
                        }
                        /* Calculer le prix total */
                        foreach ($getAll as $get) {
                            $calcprix += $get['prix_totale'];
                        }
                        $totaleprix = $calcprix + $delivery;
                        $this->commande->totaleprix = $totaleprix;
                        $this->commande->id_com = $getAll[0]['id_com'];
                        $this->commande->update_prix();
                        /* */
                        echo json_encode(array('message' => 'votre pnaier ', 'countAll' => $countAll, 'quantite_All' => $quantite_All, 'calcprix' => $calcprix, 'totaleprix' => $totaleprix, 'delivery' => $delivery, 'produit' => $getAll, 'state' => true));
                    } else {
                        echo json_encode(array(
                            'message' => 'votre pnaier est null', 'countAll' => $countAll,
                            'state' => false
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'message' => 'votre pnaier est null', 'countAll' => $countAll,
                        'state' => false
                    ));
                }
            } else {
                echo json_encode(array(
                    'authentification' => false
                ));
            }
        }

        function delete($id)
        {
            $this->linecmd->id_linecmd = $id;
            $result_linecmd = $this->linecmd->get_linecmd();
            $this->produit->id_produit = $result_linecmd['id_produit'];
            $quantite_linecmd = $result_linecmd['quantite'];
            $result_produit = $this->produit->get();
            $quantite_stock = $result_produit['quantite'];
            if ($this->linecmd->delete()) {
                $this->produit->quantite = $quantite_stock + $quantite_linecmd;
                $this->produit->update_quantite();
            }
        }

        function update_quantite_panier($id)
        {
            $this->linecmd->id_linecmd = $id;
            $result_linecmd = $this->linecmd->get_linecmd();
            /* ancienne quantité dans le panier ( line_cmd) */
            $old_quantite = $result_linecmd['quantite'];
            $this->produit->id_produit = $result_linecmd['id_produit'];
            $result_produit = $this->produit->get();
            /* la quantité en dépôt  */
            $stock_quantite =   $result_produit['quantite'];
            /* prix du produit */
            $prix = $result_produit['prix'];
            /* nouvelle quantité du client */
            $new_quantite = $this->data->new_quantite;
            if ($old_quantite != $new_quantite) {
                if ($stock_quantite >= $new_quantite - $old_quantite) {
                    if ($old_quantite > $new_quantite) {
                        $this->linecmd->prix_totale = $prix * $new_quantite;
                        $this->linecmd->quantite = $new_quantite;
                        if ($this->linecmd->update_quantite_prix_totale_linecmd()) {
                            $result_quantite = $old_quantite - $new_quantite;
                            $this->produit->quantite = $stock_quantite + $result_quantite;
                            $this->produit->update_quantite();
                            echo json_encode(array(
                                'message' => 'modifier avec succés',
                                'state' => true
                            ));
                        }
                    } elseif ($old_quantite < $new_quantite) {
                        $this->linecmd->prix_totale = $prix * $new_quantite;
                        $this->linecmd->quantite = $new_quantite;
                        if ($this->linecmd->update_quantite_prix_totale_linecmd()) {
                            $result_quantite =  $new_quantite - $old_quantite;
                            $this->produit->quantite = $stock_quantite - $result_quantite;
                            $this->produit->update_quantite();
                            echo json_encode(array(
                                'message' => 'modifier avec succés',
                                'state' => true
                            ));
                        }
                    }
                } else {
                    echo json_encode(array(
                        'message' => 'Stoke ne suffit pas',
                        'state' => false
                    ));
                }
            }
        }

    }

?>
