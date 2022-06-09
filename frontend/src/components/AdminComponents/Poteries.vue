<template>
    <div>
        <h1 class="titre">Liste des Poteries</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du poteries</p>
            <div><button @click="showModal1=true" class="add_new">+ Ajouter un poterie</button> </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Poteries</th>
                        <th>Images</th>
                        <th>Categories</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="poterie in poteries" :key="poterie.id_produit">
                        <td>{{ poterie.nom }}</td>
                        <td><img v-bind:src="'http://localhost/Fakhar/frontend/public/produit/' + poterie.image" /></td>
                        <td>cuisine</td>
                        <td>{{ poterie.prix }}</td>
                        <td>{{ poterie.quantite }}</td>
                        <td><button @click="showModal2=true"><i class="fa-solid fa-pen-to-square"></i></button>  <button><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <div><i class="fa-solid fa-angles-left"></i></div>
            <div><i class="fa-solid fa-chevron-left"></i></div>
            <div>1</div>
            <div>2</div>
            <div><i class="fa-solid fa-chevron-right"></i></div>
            <div><i class="fa-solid fa-angles-right"></i></div>
        </div>
    </div>
    <div class="close-div" v-if="showModal1"  @click="showModal1=false;"></div>
        <form class="popup-all" v-if="showModal1" >
            <h2>Ajouter un poterie<a  v-if="showModal1=true" @click="showModal1=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">Poteries</label>
            <input v-model="poterie.nom" type="text" placeholder="Poteries" class="input-pop">
            <label for="" >Images</label>
            <input @change="sendImage($event)" type="file" class="input-file">
            <label for="">Catégories</label>
            <select class="input-pop">
                <option class="select-pop" selected disabled>choiser le nom de categorie</option>
                <option v-for="cate in categories" class="select-pop" :key="cate.id_Cate" :value="cate.nom_cate">{{cate.nom_cate}}</option>
            </select>
            <label for="">Prix</label>
            <input v-model="poterie.prix" type="number" placeholder="Prix" class="input-pop">
            <label for="">Quantité</label>
            <input v-model="poterie.quantite" type="number" placeholder="Quantité" class="input-pop">
            <input @click="add_poterie" type="submit" value="Valider" class="submit-pop">
        </form>
        <div class="close-div" v-if="showModal2"  @click="showModal2=false;"></div>
        <form class="popup-all" v-if="showModal2" >
            <h2>Modifier un poterie<a  v-if="showModal2=true" @click="showModal2=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">Poteries</label>
            <input type="text" placeholder="Poteries" class="input-pop">
            <label for="">Images</label>
            <input type="file" class="input-file">
            <label for="">Catégories</label>
            <select class="input-pop" @click="getAllcategories">
                <option class="select-pop">Sélectionez un catégorie</option>
            </select>
            <label for="">Prix</label>
            <input type="number" placeholder="Prix" class="input-pop">
            <label for="">Quantité</label>
            <input type="number" placeholder="Quantité" class="input-pop">
            <input type="submit" value="Valider" class="submit-pop">
        </form>
    </div>
</template>

<script>
import axios from "axios";
import swal from 'sweetalert';
export default {
    name: "pote-ries",
    data() {
        return {
            showModal1 : false,
            showModal2 : false,
            poteries: [],
            category: [],
            categories: [],
            categorie: {
                id_Cate: "",
                nom_cate: ""
            },
            poterie: {
                id_produit: '',
                Cate_Id: '',
                nom: '',
                quantite: '',
                prix: '',
                description: '',
                image: ''
            },
            token: localStorage.getItem('token'),
        };
    },
    created() {
        this.getAllpoteries();
    },
    mounted() {
        this.getAllcategories();
    },
    methods: {
        getAllpoteries() {
            axios.get('http://localhost/Fakhar/Poterie/getAll_produit')
                .then(response => {
                    this.poteries = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        add_poterie() {
            if(this.poterie.nom != "" && this.poterie.image != "" && this.poterie.prix != "" && this.poterie.quantite != "") {
                axios.post('http://localhost/Fakhar/Poterie/create_produit', {
                    token: this.token,
                    nom: this.nom,
                    image: this.image,
                    quantite: this.quantite,
                    prix: this.prix
                })
                .then(response => {
                    if(response){
                    swal({
                        title: "Success",
                        text: "Votre poterie a été ajouté avec succès",
                        icon: "success",
                        button: "OK",
                    });
                    }
                    else{
                        swal({
                            title: "Error",
                            text: "Votre poterie n'a pas été ajouté",
                            icon: "error",
                            button: "OK",
                        });
                    }
                })
            }  
        },
        getAllcategories(){
            axios.get('http://localhost/Fakhar/Categorie/getAll_categorie')
            .then(response => {
                this.categories = response.data;
                console.log(this.categories);
            })
        },
        sendImage(event){
            this.poterie.image = event.target.files[0]
        }
    }
}
</script>

<style scoped lang="scss">
@import "@/sass/_mixin.scss";
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
    position: absolute;
    top: 13%;
    right: 20%;
    z-index: 99;
    background-color: white;
    padding: 0px 35px 20px;
    border-radius: 10px;
}
.popup-all h2{
    font-size: 20px;
    text-align: center;
    padding: 20px;
}
.input-pop{
    padding: 15px 480px 15px 10px;
    border-radius: 10px;
    border: solid 1px;
    border-color: #b1b1b1;
    margin-bottom: 20px;
    width: 100%;
}
.select-pop {
    padding: 15px 480px 15px 10px;
    border-radius: 10px;
    border: solid 1px;
    border-color: #b1b1b1;
    margin-bottom: 20px;
    width: 100%;
}
.input-file {
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
    @include mobile {
        display: none;
    }
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
    background-color:  #0298cf;
}

td button:nth-child(2) {
    background-color: #f80000;
}

.add_new {
    padding: 10px 20px;
    color: white;
    background-color: $dash-color;
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
    border: 1px solid #ced0d2;
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