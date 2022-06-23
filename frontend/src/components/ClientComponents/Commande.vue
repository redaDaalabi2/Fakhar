<template>
    <div>
        <div class="wrapper">
          <div class="profile-card">
            <div class="content">
              <div class="content_detaille">
              <div class="image_poterie">
                <img v-bind:src="poterie.image" alt="">
              </div>
              <div class="detaille_poterie">
                <h4 class="">Nom de Poterie : <span>{{ poterie.nom }}</span></h4>
                <h4  class="">Catégorie : <span>{{ poterie.nom_cate }}</span></h4>
                <h4  class="">Prix : <span>{{ poterie.prix }} DH</span></h4>
                <div class="">
                  <h4 class="quantite">Quantité :</h4>
                  <div class="increment">
                    <button class="click" v-on:click.prevent="decrement">-</button>
                    <button class="counter">{{ poterie.quantite }}</button>
                    <button id="" class="click" v-on:click.prevent="increment">+</button>
                  </div>
                  <h4 class="prix_totale">Prix de livraison : 2DH</h4>
                  <h4 class="prix_totale">Prix Totale : <span>{{ poterie.quantite * poterie.prix + 2 }} DH</span></h4>
                </div>
              </div>
              </div>
              <div class="description">
                <h4 class="">Description :</h4>
                <p class="">
                  {{ poterie.descreption }}
                </p>
                <button class="commander" @click="commander(), update_quantite()">Commander</button> 
              </div>
          </div>
          </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import swal from 'sweetalert';
export default {
    name: "Comm-ande",
    data(){
        return{
          quantite: '',
          prix_totale: '',
          poterie: {
            id_produit: '',
            Cate_Id: '',
            nom: '',
            quantite: '',
            prix: '',
            descreption: '',
            image: ''
          },
          commande: {
            id_com: '',
            Client_Id: '',
            date: '',
            statut: '',
            quantite_com: '',
            prix_totale: '',
            produit_Id: '',
          },
          token : localStorage.getItem('token'),
          id_client: '',
        }
    },
    beforeMount(){
      this.securepage();
    },
    methods:{
     securepage(){
        let checklocal = localStorage.getItem('token');
        if(!checklocal){
          this.$router.push('/LoginView');
        }
     },
      increment () {
        if(this.poterie.quantite < this.quantite){
          this.poterie.quantite++;
        }
      },
      decrement () {
        if(this.poterie.quantite > 0){
          if(this.poterie.quantite > 1){
            this.poterie.quantite--;
          }
        }
      },
      getOnepoterie(id){
        axios.get('http://localhost/Fakhar/Poterie/get_produit/'+ id)
        .then(response => {
          this.poterie = response.data;
          this.quantite = this.poterie.quantite;
        })
        .catch(error => {
            console.log(error);
        });
      },
      getIdtoken(){
        axios.post('http://localhost/Fakhar/Utilisateur/get_id_token', {
          token: this.token
        })
        .then(response => {
          this.id_client = response.data.id;
        })
        .catch(error => {
          console.log(error);
        })
      },
      update_quantite(){
        axios.put('http://localhost/Fakhar/Commande/update_quantite_poterie',{
          token: this.token,
          id_produit: this.poterie.id_produit,
          quantite: this.quantite - this.poterie.quantite,
        })
        .then((response) => {
          console.log(this.quantite)
          console.log(this.poterie.quantite)
          console.log(response.data)
        })
        .catch(error => {
          console.log(error);
        })
      },
      commander(){
        axios.post('http://localhost/Fakhar/Commande/create_commande',{
          token: this.token,
          Client_Id : this.id_client,
          statut: 'en cours',
          quantite_com: this.poterie.quantite,
          prix_totale: this.poterie.quantite * this.poterie.prix + 2,
          produit_Id : this.poterie.id_produit,
        })
        .then(response => {
          if(response){
            swal({
              title: "Commande effectuée avec succès",
              text: "Votre commande sera traitée dans les plus brefs délais",
              icon: "success",
              button: "Continuer",
            });
            this.$router.push('/Magasin/BoutiqueView');
            console.log(response);
          }
        })
        .catch(error => {
            console.log(error);
        });
      }
    },
    mounted(){
      this.getIdtoken();
      this.getOnepoterie(localStorage.getItem('id_produit'));
      localStorage.removeItem('id_produit');
    }
}
</script>

<style scoped lang="scss">
@import "@/sass/_mixin.scss";
.wrapper {
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 30px 20px;
  display: flex;
  @media screen and (max-width: 768px) {
    height: auto;
    min-height: 100vh;
    padding-top: 100px;
  }
  @include tablet {
    overflow-x: hidden;
  }
  @include mobile {
    overflow-x: hidden;
  }
  .profile-card {
    width: 100%;
    min-height: 460px;
    margin: auto;
    box-shadow: 0px 8px 60px -10px rgba(13,28,39,0.6);
    background: #fff;
    border-radius: 12px;
    max-width: 900px;
    position: relative;
    margin-top: 90px;
    margin-bottom: 10px;
    &.active {
      .profile-card__cnt {
          filter: blur(6px);
      }
      .profile-card-message,
      .profile-card__overlay {
        opacity: 1;
        pointer-events: auto;
        transition-delay: .1s;
      }
      .profile-card-form {
        transform: none;
        transition-delay: .1s;
      }
    }
    .content {
      width: 100%;
      height: 100%;
      .content_detaille {
      display: flex;
      justify-content: center;
      align-items: center;
      @include tablet {
        flex-direction: column;
      }
      @include mobile {
        flex-direction: column;
      }
      .image_poterie {
        width: 100%;
        height: 100%;
        img {
          max-width: 100%;
          margin-left: 25px;
          margin-top: 25px;
          border-radius: 5px;
        @include tablet {
          margin-top: 0px;
          margin-left: 0px;
        }
        @include mobile {
          margin-top: 0px;
          margin-left: 0px;
          width: 100%;
          max-width: none;
        }
        }
      }
      .detaille_poterie {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        margin-left: 66px;
        gap: 25px;
        .quantite {
          margin-bottom: 20px;
        }
        .prix_totale {
          margin-top: 20px;
        }
        .increment {
          .counter{
              width: 10%;
              padding-block: 5px;
              margin-inline: 10px;
              background-color: white;
              border: 1px solid black;
              border-radius: 3px;
          }
          .click {
            padding: 7px 15px;
            background-color: $main-color;
            border-radius: 5px;
            border: 1px solid white;
            color: white;
            cursor: pointer;
          }
        }
      }
      }
      .description {
        margin-top: 30px;
        margin-left: 30px;
        h4 {
          padding-bottom: 15px;
          @include mobile{
            font-size: 11px;
          }
        }
        p {
          @include mobile{
            font-size: 10px;
          }
        }
        button {
          padding: 10px 25px;  
          background-color: $main-color;
          border-radius: 5px;
          border: 1px solid white;
          color: white;
          font-size: 16px;
          font-weight: bold;
          margin-top: 30px;
          margin-bottom: 30px;
          cursor: pointer;    
          @include mobile{
          padding: 6px 8px;  
            font-size: 12px;
          }  
        }
      }
    }
  }
}
</style>