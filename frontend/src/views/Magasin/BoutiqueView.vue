<template>
  <div>
    <div class="cherche_header">
        <input placeholder="Chercher" v-model="keyword"> 
        <router-link v-if="showings" to="/Magasin/ProfileView" class="compte"><i class="fa-solid fa-user"></i> mon compte</router-link> 
    </div>
    <section class="main-pro">
        <div class="content">
            <div class="card" v-for="poterie in filteredpoteries" :key="poterie.id_produit">
                <img v-bind:src="poterie.image" alt="">
                <h3 class="card-titre">{{ poterie.nom }}</h3>
                <div class="desc">
                    <a class="card-butt">
                        <router-link class="Ajouter" to="/Magasin/CommandeView">Acheter</router-link>
                    </a>
                    <span class="prix">{{ poterie.prix }} DH</span>
                </div>
            </div>
        </div>
        <div class="pagination">
            <div><i class="fa-solid fa-angles-left"></i></div>
            <div><i class="fa-solid fa-chevron-left"></i></div>
            <div>1</div>
            <div>2</div>
            <div><i class="fa-solid fa-chevron-right"></i></div>
            <div><i class="fa-solid fa-angles-right"></i></div>
        </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "BoutiqueView",
  props: ["setvr", "showings"],
  data(){
      return{
        keyword:'',
        poteries: [],
        poterie: {
            id_produit: '',
            Cate_Id: '',
            nom: '',
            quantite: '',
            prix: '',
            description: '',
            image: ''
        }
      }
  },
  components: {
    
  },
  created() {
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
  },
  computed : {
    filteredpoteries() {
        return this.poteries.filter((poterie) => {
            return poterie.nom.toLowerCase().indexOf(this.keyword.toLowerCase()) > -1;
        });
    }
  },
//   beforeMount(){
//     let checklocal = localStorage.getItem('token');
//     if(!checklocal){
//       this.$router.push('/LoginView');
//     }
//   }
};
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";
.cherche_header {
    margin-top: 13vh;
    margin-inline: 52px;
    padding-block: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    input {
        padding: 10px 20px;
        margin: 0 10px;
        outline: none;
        border: 1px solid $main-color;
        border-radius: 5px;
        color: $dash-color;
        @include mobile {
            padding: 5px 10px;
        }
    }
    .compte {
        background-color:$main-color;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        text-decoration: none;
        padding: 10px 20px;
        cursor: pointer;
        font-weight: bold;
        border: 1px solid $main-color;
        &:hover {
            background-color: white;
            color: $main-color;
        }
        @include mobile {
            font-size: 14px;
            padding: 5px 10px;
            font-weight: normal;
        }
    }
    @media (max-width: 430px) {
        flex-direction: column;
        gap: 10px;
        
    }
}
.content {
    display: flex;
    justify-content: space-around;
    flex-direction: row;
    flex-wrap: wrap;
    padding: 0px 40px 0px 40px;
    margin-bottom: 2rem;
    .card {
        width: 21.25em;
        box-shadow: 0 5px 25px rgb(1 1 1 / 15%);
        margin: 15px;
        transition: 0.7s ease;
        .card-titre {
            text-align: center;
            color: $alt-color;
            font-weight: 400;
            padding-top: 15px;
        }
        img {
            width: 100%;
            transform: scale(1);
            transition: .3s ease-in-out;
            &:hover {
                transform: scale(1.1);
                border-radius: 5px;
            }
        }
        .desc {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-inline: 15px;
        .card-butt {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 15px;
            padding-bottom: 15px;
            .Ajouter {
                text-decoration: none;
                color: $like-black-color;
                background-color: $main-color;
                border: 1px solid white;
                border-radius: 5px;
                padding: 15px;
                &:hover{
                    background-color: white;
                    border: 1px solid $main-color;
                    color: $main-color;
                    cursor: pointer;
                    margin: 0px;
                }
            }
        }
        .prix {
            color: $alt-color;
            font-weight: bold;
            font-size: 25px;
        }
        }
    }
}
.pagination {
    display: flex;
    justify-content: center;
    width: 100%;
    margin-bottom: 30px;
    padding: 10px 20px;
}

.pagination div {
    padding: 10px;
    height: 40px;
    width: 40px;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: $main-color;
    color: #ffffff;
    box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.20);
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
