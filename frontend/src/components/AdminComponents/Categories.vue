<template>
    <div>
        <h1 class="titre">Liste des Catégories</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du Catégorie</p>
            <div><button class="add_new" @click="showModal1=true">+ Ajouter une Catégorie</button> </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom de catégorie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="categorie in categories" :key="categorie.id_Cate">
                        <td>{{ categorie.id_Cate }}</td>
                        <td>{{ categorie.nom_cate }}</td>
                        <td>
                            <button @click="showModal2=true, getOnecategorie(categorie.id_Cate)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button @click="delete_categorie(categorie.id_Cate)"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        <div class="close-div" v-if="showModal1"  @click="showModal1=false;"></div>
        <form class="popup-all" v-if="showModal1" @submit.prevent="add_categories">
            <h2>Ajouter une catégorie<a  v-if="showModal1=true" @click="showModal1=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">nom de catégorie</label>
            <input required type="text" v-model="nom_cate" placeholder="Nom" class="input-pop">
            <input type="submit" value="Valider" class="submit-pop">
        </form>
        <div class="close-div" v-if="showModal2"  @click="showModal2=false;"></div>
        <form class="popup-all" v-if="showModal2" @submit.prevent="update_categorie(categorie.id_Cate)">
            <h2>Modifier une catégorie<a  v-if="showModal2=true" @click="showModal2=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
            <label for="">nom de catégorie</label>
            <input required type="text" v-model="categorie.nom_cate" placeholder="Nom" class="input-pop">
            <input type="submit" value="Valider" class="submit-pop">
        </form>
    </div>
</template>

<script>
import axios from "axios";
import swal from 'sweetalert';
export default {
    name: "Categ-ories",
    data() {
        return {
            showModal1 : false,
            showModal2 : false,
            categories: [],
            categorie: {
                id_Cate: "",
                nom_cate: ""
            },
            token: localStorage.getItem("token"),
        };
    },
    mounted() {
        this.getAllCategories();
    },
    methods: {
        getAllCategories(){
            axios.get('http://localhost/Fakhar/Categorie/getAll_categorie')
            .then(response => {
                this.categories = response.data;
            })
        },
        add_categories(){
            if(this.nom_cate != ""){
                axios.post('http://localhost/Fakhar/Categorie/create_categorie', {
                    token: this.token,
                    nom_cate: this.nom_cate
                })
                .then(response => {
                    if(response){
                        swal("Catégorie ajoutée avec succès", "", "success");
                    }
                    else{
                        swal("Erreur", "", "error");
                    }
                })
                this.categories.push({
                    id_Cate: this.categories.length + 1,
                    nom_cate: this.nom_cate
                });
                this.showModal1 = false;
            }

        },
        delete_categorie(id_Cate){
            axios.post('http://localhost/Fakhar/Categorie/delete_categorie', {
                id_Cate: id_Cate,
                token: this.token,
            })
            .then(() => {
                console.log(id_Cate);
                console.log(this.token);
                this.categories = this.categories.filter(categorie => {
                    return categorie.id_Cate !== id_Cate;
                });
            })
        },
        getOnecategorie(id_Cate){
            axios.get('http://localhost/Fakhar/Categorie/get_categorie/'+id_Cate)
            .then(response => {
                this.categorie = response.data;
                console.log(this.categorie);
            })
        },
        update_categorie(){
            axios.put('http://localhost/Fakhar/Categorie/update_categorie', {
                token: this.token,
                id_Cate: this.categorie.id_Cate,
                nom_cate: this.categorie.nom_cate,
            })
            .then(response => {
                if(response){
                    swal("Catégorie modifiée avec succès", "", "success");
                }
                else{
                    swal("Erreur", "", "error");
                }
            })
            this.categories.forEach((element,index) => {
                if(element.id_Cate == this.categorie.id_Cate){
                    this.categories[index] = this.categorie;
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
    margin-right: 10px;
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

tr:hover td {
    color: $dash-color;
    cursor: pointer;
    background-color: #f6f9fc;
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