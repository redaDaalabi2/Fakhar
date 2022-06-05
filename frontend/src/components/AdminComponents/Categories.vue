<template>
    <div>
        <h1 class="titre">Liste des Catégories</h1>
        <div class="table">
        <div class="table_header">
            <p>détails du Catégorie</p>
            <div><button class="add_new">+ Ajouter un Catégorie</button> </div>
        </div>
        <div class="table_section">
            <table>
                <thead>
                    <tr>
                        <th>Nom de catégorie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Cuisine</td>
                        <td><button><i class="fa-solid fa-pen-to-square"></i></button>  <button><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                    <tr>
                        <td>Décore</td>
                        <td><button><i class="fa-solid fa-pen-to-square"></i></button>  <button><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "Categ-ories",
    data() {
        return {
            
        };
    },
    methods: {

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