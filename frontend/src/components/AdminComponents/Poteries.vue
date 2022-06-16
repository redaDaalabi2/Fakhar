<template>
    <div>
        <h1 class="titre">Liste des Poteries</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du poteries</p>
            <!-- <input placeholder="Chercher" v-model="keywords">  -->
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
                        <td><img v-bind:src="poterie.image" /></td>
                        <td>cuisine</td>
                        <td>{{ poterie.prix }}</td>
                        <td>{{ poterie.quantite }}</td>
                        <td>
                            <button @click="showModal2=true, getOnepoterie(poterie.id_produit)"><i class="fa-solid fa-pen-to-square"></i></button>  <button @click="delete_poterie(poterie.id_produit)"><i class="fa-solid fa-trash"></i></button>
                        </td>
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
        <form class="popup-all" v-if="showModal1" @submit.prevent="add_poterie()">
            <h2>Ajouter un poterie<a  v-if="showModal1=true" @click="showModal1=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">Poteries</label>
            <input v-model="poterie.nom" required type="text" placeholder="Poteries" class="input-pop">
            <label for="" >Images</label>
            <input required type="file" class="input-file" @change="sendImage($event)">
            <label for="">Catégories</label>
            <select class="input-pop" v-model="poterie.Cate_Id" required>
                <option class="select-pop" selected disabled >choiser le nom de categorie</option>
                <option v-for="cate in categories" class="select-pop" :key="cate.id_Cate" :value="cate.id_Cate">{{cate.nom_cate}}</option>
            </select>
            <label for="">Prix</label>
            <input v-model="poterie.prix" required type="number" placeholder="Prix" class="input-pop">
            <label for="">Description</label>
            <input v-model="poterie.descreption" required type="text" placeholder="Description" class="input-pop">
            <label for="">Quantité</label>
            <input v-model="poterie.quantite" required type="number" placeholder="Quantité" class="input-pop">
            <input type="submit" class="submit-pop" value="Valider" >
        </form>
        <div class="close-div" v-if="showModal2"  @click="showModal2=false;"></div>
        <form class="popup-all" v-if="showModal2" @submit.prevent="update_poterie(poterie.id_produit)">
            <h2>Modifier un poterie<a  v-if="showModal2=true" @click="showModal2=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">Poteries</label>
            <input type="text" v-model="poterie.nom" placeholder="Poteries" class="input-pop">
            <label for="">Images</label>
            <input type="file" class="input-file" @change="sendImage($event)">
            <label for="">Catégories</label>
            <select class="input-pop" @click="getAllcategories" v-model="poterie.nom_cate">
                <option class="select-pop" selected disabled >{{poterie.nom_cate}}</option>
                <option v-for="cate in categories" class="select-pop" :key="cate.id_Cate" :value="cate.id_Cate">{{cate.nom_cate}}</option>
            </select>
            <label for="">Prix</label>
            <input type="number" v-model="poterie.prix" placeholder="Prix" class="input-pop">
            <label for="">Quantité</label>
            <input type="number" v-model="poterie.quantite" placeholder="Quantité" class="input-pop">
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
            // keywords: '',
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
                descreption: '',
                image: ''
            },
            token: localStorage.getItem('token'),
        };
    },
    // created() {
    //     this.getAllpoteries();
    // },
    // computed: {
    //     filteredpoteries() {
    //         return this.poteries.filter((poterie) => {
    //             return poterie.nom.toLowerCase().match(this.keywords.toLowerCase());
    //         });
    //     }
    // },
    mounted() {
        this.getAllcategories();
        this.getAllpoteries();
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
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }
            const formData = new FormData();
            formData.append('token', this.token);
            formData.append('nom', this.poterie.nom);
            formData.append('quantite', this.poterie.quantite);
            formData.append('prix', this.poterie.prix);
            formData.append('descreption', this.poterie.descreption);
            formData.append('image', this.poterie.image);
            formData.append('Cate_Id', this.poterie.Cate_Id);
            console.log(this.categorie.id_Cate);

            axios.post('http://localhost/Fakhar/Poterie/create_produit',formData,config)
            .then(response => {
            console.log(response);
                if(response){
                this.getAllpoteries();
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
            this.showModal1 = false;
            this.poteries.push(this.poterie);
            this.getAllpoteries();
        },
        getAllcategories(){
            axios.get('http://localhost/Fakhar/Categorie/getAll_categorie')
            .then(response => {
                this.categories = response.data;
            })
        },
        sendImage(event){
            this.poterie.image = event.target.files[0]
        },
        delete_poterie(id_produit){
            axios.post('http://localhost/Fakhar/Poterie/delete_produit',{
                id_produit: id_produit,
                token: this.token
            }
            )
            .then(() => {
                this.getAllpoteries();
                this.poteries = this.poteries.filter(poterie => {
                    return poterie.id_produit !== id_produit;
                });
            })
        },
        getOnepoterie(id_produit){
            axios.get('http://localhost/Fakhar/Poterie/get_produit/'+id_produit)
            .then(response => {
                this.poterie = response.data;
                // console.log(this.poterie);
            })
        },
        update_poterie(){
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            }
            const formData = new FormData();
            formData.append('token', this.token);
            formData.append('id_produit', this.poterie.id_produit);
            formData.append('nom', this.poterie.nom);
            formData.append('quantite', this.poterie.quantite);
            formData.append('prix', this.poterie.prix);
            formData.append('descreption', this.poterie.descreption);
            formData.append('image', this.poterie.image);
            formData.append('Cate_Id', this.poterie.Cate_Id);
            console.log(this.categorie.id_Cate);
            axios.post('http://localhost/Fakhar/Poterie/update_produit',formData,config)
            .then(response => {
                if(response){
                    this.getAllpoteries();
                    swal("Catégorie modifiée avec succès", "", "success");
                }
                else{
                    swal("Erreur", "", "error");
                }
            })
            this.poteries.forEach((element,index) => {
                if(element.id_produit == this.poterie.id_produit){
                    this.poteries[index] = this.poterie;
                }
            });
            this.showModal2 = false;
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
    input {
        padding: 10px 20px;
        margin: 0 10px;
        outline: none;
        border: 1px solid $dash-color;
        border-radius: 5px;
        color: $dash-color;
        @include mobile {
            padding: 5px 10px;
        }
    }
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