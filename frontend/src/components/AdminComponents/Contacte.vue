<template>
    <div>
        <h1 class="titre">Liste des Contacte</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du contate</p>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>E-mail</th>
                        <th>Téléphone</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contacte in contactes" :key="contacte.id">
                        <td>{{ contacte.id }}</td>
                        <td>{{ contacte.nom }}</td>
                        <td>{{ contacte.prenom }}</td>
                        <td>{{ contacte.email }}</td>
                        <td>{{ contacte.telephone }}</td>
                        <td>{{ contacte.message }}</td>
                        <td><button @click="delete_contacte(contacte.id)"><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><path fill="currentColor" d="M7 3h2a1 1 0 0 0-2 0ZM6 3a2 2 0 1 1 4 0h4a.5.5 0 0 1 0 1h-.564l-1.205 8.838A2.5 2.5 0 0 1 9.754 15H6.246a2.5 2.5 0 0 1-2.477-2.162L2.564 4H2a.5.5 0 0 1 0-1h4Zm1 3.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0v-5ZM9.5 6a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 1 0v-5a.5.5 0 0 0-.5-.5Z"/></svg></button></td>
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
    </div>
</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
export default {
    name: "Con-tacte",
    data() {
        return {
            contactes: [],
            contacte: {
                id: '',
                nom: "",
                prenom: "",
                email: "",
                telephone: "",
                message: ""
            }
        };
    },
    created() {
        this.getAll();
    },
    methods: {
        getAll(){
            axios.get('http://localhost/Fakhar/Contacte/get_all')
            .then(response => this.contactes = response.data)
            .catch(err => console.log(err));
        },
        delete_contacte(id){
            swal({
                title: "Êtes-vous sûr ?",
                text: "Une fois supprimé, vous ne pourrez plus récupérer ce contact",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Pouf ! Votre contact a été supprimé !", {
                    icon: "success",
                    });
                    axios.post('http://localhost/Fakhar/Contacte/delete',{
                        id: id
                    }
                    )
                    .then(() => {
                        this.contactes = this.contactes.filter(contacte => {
                            return contacte.id !== id;
                        });
                    })
                } else {
                    swal("Votre contact est en sécurité !");
                }
            });
        },
    }
}
</script>

<style scoped lang="scss">
@import "@/sass/_mixin.scss";
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
    background-color: #f80000;
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

::placeholder {
    color: #0298cf;
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