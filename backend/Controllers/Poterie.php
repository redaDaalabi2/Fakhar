<?php

class Poterie
{

    //db
    public $db;
    public $produit;
    public $utilisateur;
    public $data;

    public function __construct()
    {
        // instantiate Database
        $database = new Database();
        $this->db = $database->connect();

        // instantiate User object
        $this->produit = new Poteries($this->db);
        $this->utilisateur = new Utilisateurs($this->db);

        // getdata
        $this->data = json_decode(file_get_contents('php://input'));
    }

    // public function upload_image()
    // {
    //     $target_path = $_SERVER['DOCUMENT_ROOT'] . 'http://localhost/Fakhar/frontend/public/produit/';
    //     $imgName = $_POST['imgName'];
    //     $target_path = $target_path . $imgName;
    //     if (move_uploaded_file($_FILES['imgFile']['tmp_name'], $target_path)) {
    //         echo "Le fichier " . basename($_FILES['imgFile']['name']) . "a été téléchargé";
    //     } else {
    //         echo "Une erreur s'est produite lors du téléchargement du fichier, veuillez réessayer!";
    //     }
    // }

    public function create_produit()
    {
        $img = $_FILES['image'];
        $this->produit->nom = $_POST['nom'];
        $this->produit->Cate_Id =  $_POST['Cate_Id'];
        $this->produit->quantite = $_POST['quantite'];
        $this->produit->prix =  $_POST['prix'];
        $this->produit->descreption = $_POST['descreption'];
        $this->utilisateur->token = $_POST['token'];
        $imag_name = $img['name'];
        $imag_size = $img['size'];
        $tmp_name = $img['tmp_name'];

        if ($imag_size > 10250000) {
            echo "sorry , your file is too large";
        } else {
            $img_ex = pathinfo($imag_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png", "webp");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = "img/$new_img_name";
                move_uploaded_file($tmp_name, $img_upload_path);
                $this->produit->image = "http://localhost/Fakhar/backend/IMG/$new_img_name";
            } else {
                echo "you can't upload files of this type";
            }
        }
        
        $role = $this->utilisateur->get_role_token();
        if ($this->utilisateur->check_token() && $role == "admin") {
            if ($this->produit->create()) {
                echo json_encode(array(
                    'message' => 'produit créé avec succès',
                    'state' => true
                ));
            } else {
                echo json_encode(array(
                    'message' => 'le produit n`a pas été créé',
                    'state' => false
                ));
            }
        } else {
            echo json_encode(array(
                'message' => 'le produit n`a pas été créé',
                'state' => false
            ));
        }
    }
    public function update_produit()
    {

        $img = $_FILES['image'];
        $this->produit->id_produit = $_POST['id_produit'];
        $this->produit->nom = $_POST['nom'];
        $this->produit->Cate_Id =  $_POST['Cate_Id'];
        $this->produit->quantite = $_POST['quantite'];
        $this->produit->prix =  $_POST['prix'];
        $this->produit->descreption = $_POST['descreption'];
        $this->utilisateur->token = $_POST['token'];
        $imag_name = $img['name'];
        $imag_size = $img['size'];
        $tmp_name = $img['tmp_name'];

        if ($imag_size > 10250000) {
            echo "sorry , your file is too large";
        } else {
            $img_ex = pathinfo($imag_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png", "webp");
            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = "img/$new_img_name";
                move_uploaded_file($tmp_name, $img_upload_path);
                $this->produit->image = "http://localhost/Fakhar/backend/IMG/$new_img_name";
            } else {
                echo "you can't upload files of this type";
            }
        }

        // push this->data into properties
        // $this->produit->id_produit = $this->data->id_produit;
        // $this->produit->nom = $this->data->nom;
        // $this->produit->Cate_Id = $this->data->Cate_Id;
        // $this->produit->quantite = $this->data->quantite;
        // $this->produit->prix = $this->data->prix;
        // $this->produit->descreption = $this->data->descreption;
        // $this->produit->image = $this->data->image;
        // $this->utilisateur->token = $this->data->token;

        $role = $this->utilisateur->get_role_token();
        if ($this->utilisateur->check_token() && $role == "admin") {

            if ($this->produit->update()) {
                echo json_encode(array(
                    'message' => 'produit modifier avec succès',
                    'state' => true
                ));
            } else {
                echo json_encode(array(
                    'message' => 'le produit n`est pas modifier',
                    'state' => false
                ));
            }
        } else {
            echo json_encode(array(
                'message' => 'le produit n`est pas modifier',
                'state' => false
            ));
        }
    }

    public function delete_produit()
    {

        // push this->data into properties
        $this->produit->id_produit = $this->data->id_produit;
        $this->utilisateur->token = $this->data->token;

        $role = $this->utilisateur->get_role_token();
        if ($this->utilisateur->check_token() && $role == "admin") {
            if ($this->produit->delete()) {
                echo json_encode(array('message' => 'produit supprimer avec succès', 'state' => true));
            } else {
                echo json_encode(array('message' => 'le produit n`est pas supprimer', 'state' => false));
            }
        } else {
            echo json_encode(array('message' => 'le produit n`est pas supprimer', 'state' => false));
        }
    }
    public function getAll_produit()
    {
        $rows = $this->produit->getAll();

        if ($rows) {
            echo json_encode(
                $rows,
            );
        } else {
            echo json_encode(array(
                'message' => 'aucun produit trouvé',
                'state' => false
            ));
        }
    }
    /* for store */
    public function getAll_produit_store()
    {
        $rows = $this->produit->getAll_quantite_notNull();

        if ($rows) {
            echo json_encode(array(
                'message' => $rows,
                'state' => true
            ));
        } else {
            echo json_encode(array(
                'message' => 'aucun produit trouvé',
                'state' => false
            ));
        }
    }

    public function get_produit($id_produit)
    {
        $this->produit->id_produit = $id_produit;
        $row = $this->produit->get();

        if ($row) {
            echo json_encode($row);
        } else {
            echo json_encode('aucun produit trouvé');
        }
    }

    public function get_Number_Poterie()
    {
        $result = $this->produit->count_poterie();
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(["error"]);
        }
    }

    public function top_poterie()
    {
        $rows = $this->produit->top_produit();
        echo json_encode(array('message' => $rows, 'state' => true));
    }
}
