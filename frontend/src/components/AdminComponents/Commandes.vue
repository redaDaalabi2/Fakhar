<template>
    <div>
        <h1 class="titre">Liste des Commandes</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du commande</p>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>N° CMD</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Date</th>
                        <th>adresse</th>
                        <th>Prix (DH)</th>
                        <th>Quantite</th>
                        <th>Status</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="commande in commandes" :key="commande.id_com">
                        <td>{{ commande.id_com }}</td>
                        <td>{{ commande.prenom }}</td>
                        <td>{{ commande.Telephone }}</td>
                        <td>{{ commande.date }}</td>
                        <td>{{ commande.adresse }}</td>
                        <td>{{ commande.prix }}</td>
                        <td>{{ commande.quantite }}</td>
                        <td>{{ commande.statut }}</td>
                        <td> <button @click="showModal=true, getOneCommande(commande.id_com)"><i class="fa-solid fa-circle-info"></i></button></td>
                    </tr>               
                </tbody>
            </table>
        </div>
        <div class="close-div" v-if="showModal"  @click="showModal=false;"></div>
        <form class="popup-all" v-if="showModal">
            <h2>détail de commande<a  v-if="showModal=true" @click="showModal=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label class="input-pop">id de la commande : {{ commande.id_com }}</label>
            <label class="input-pop">la date de la commande : {{ commande.date }}</label>
            <label class="input-pop">livraison : {{ commande.statut }}</label>
            <label class="input-pop">prix totale : {{ commande.prix_totale }}</label>
            <label class="input-pop">nom de poterie : {{ commande.nom }}</label>
            <label class="input-pop">nom de client : {{ commande.prenom }}</label>
            <label class="input-pop">le genre de client : {{ commande.genre }}</label>
            <label class="input-pop">N° de Telephone : {{ commande.Telephone }}</label>
            <label class="input-pop">adresse de client : {{ commande.adresse }}</label>
            <label class="input-pop">quantite : {{ commande.quantite }}</label>
            <label class="input-pop">prix de poterie: {{ commande.prix }}</label>
            <label class="input-pop">descreption de poterie : {{ commande.descreption }}</label>
            <img class="imagepopup" v-bind:src="commande.image">
        </form>
        <div class="pagination">
            <div><i class="fa-solid fa-angles-left"></i></div>
            <div><i class="fa-solid fa-chevron-left"></i></div>
            <div>1</div>
            <div>2</div>
            <div><i class="fa-solid fa-chevron-right"></i></div>
            <div><i class="fa-solid fa-angles-right"></i></div>
        </div>
    </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Comma-ndes",
    data() {
        return {
            showModal : false,
            commandes: [],
            commande: {
                id_com: "",
                Client_Id: "",
                date: "",
                status: "",
                prix_totale: "",
                produit_Id: "",
                id_Client: "",
                nom: "",
                prenom: "",
                genre: "",
                Telephone: "",
                adresse: "",
                id_produit: "",
                Cate_Id: "",
                quantite: "",
                prix: "",
                descreption: "",
                image: ""
            },
        };
    },
    methods: {
        getAllcommande(){
            axios.get('http://localhost/Fakhar/Commande/get_commande_with_client_and_product')
            .then(response => {
                this.commandes = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        getOneCommande(id_com){
            axios.get('http://localhost/Fakhar/Commande/getOne_commande/'+id_com)
            .then(response => {
                this.commande = response.data;
                console.log(this.commande);
            })
        }
    },
    mounted() {
        this.getAllcommande();
    },
}
</script>

<style scoped lang="scss">
@import "@/sass/_mixin.scss";
.imagepopup {
    width: 500px !important;
}
.submit-pop {
    display: flex;
    margin: 0 auto;
    background-color: #1d1b31;
    border: 1px solid white;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    padding: 15px 40px;
    margin-top: 10px;
    &:hover {
        background-color: white;
        border: 1px solid #1d1b31;
        color: #1d1b31;
        cursor: pointer;
    }
}
.close-div{
    width: 100%;
    height: 100%;
    background-color: #1b1b1b42;
    position: fixed;
    z-index: 88;
    top: 0%;
}
.popup-all{
    position: fixed;
    top: 13%;
    right: 25%;
    z-index: 99;
    background-color: white;
    padding: 0px 35px 20px;
    border-radius: 10px;
    max-height: 80vh;
    overflow-y: scroll;
}
.popup-all h2{
    font-size: 20px;
    text-align: center;
    padding: 20px;
}
.input-pop{
    padding: 15px 40px 15px 10px;
    border-radius: 10px;
    border: solid 1px;
    border-color: #b1b1b1;
    margin-bottom: 20px;
}
.popup-all label {
  display: block;
  margin-bottom: 10px;
  font-weight: bold;
}
.close {
    float: right;
    cursor: pointer;
}
.titre {
    padding-block: 20px;
    text-align: center;
    font-size: 2em;
    color: white;
    font-weight: bold;
    box-shadow: 0 0 10px #ddd;
    background-color: $dash-color;
    @include tablet {
        font-size: 1.5em;
    }
    @include mobile {   
        font-size: 1.2em;
    }
}
body {
    overflow: hidden;
}

.table {
    width: 100%;
    padding-left: 13vh;
}

.table_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding: 20px;
    background-color: rgb(240, 240, 240);
}

.table_header p {
    color: #000000;
    font-weight: bold;
}

button {
    outline: none;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    padding: 10px;
    color: #ffffff;
}

td button:nth-child(1) {
    background-color: $dash-color;
}

.add_new {
    padding: 10px 20px;
    color: #ffffff;
    background-color: #0298cf;
}

.table_section {
    height: 500px;
    overflow: auto;
}

table {
    width: 100%;
    table-layout: fixed;
    min-width: 900px;
    border-collapse: collapse;
}

thead th {
    position: sticky;
    top: 0;
    background-color: #f6f9fc;
    color: $alt-color;
    font-size: 15px;
}

th,
td {
    border-bottom: 1px solid #dddddd;
    padding: 10px 20px;
    word-break: break-all;
    text-align: center;
}

td img {
    height: 60px;
    width: 60px;
    object-fit: cover;
    border-radius: 15px;
    border: 5px solid #ced0d2;
}

tr:hover td {
    color: $dash-color;
    cursor: pointer;
    background-color: #f6f9fc;
}

.pagination {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 30px 20px;
}

.pagination div {
    padding: 10px;
    height: 40px;
    width: 40px;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $dash-color;
    color: #ffffff;
    box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.75);
    margin: 0 5px;
    cursor: pointer;
}

// ::placeholder {
//     color: #0298cf;
// }

::-webkit-scrollbar {
    height: 5px;
    width: 5px;
}

::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}
</style>