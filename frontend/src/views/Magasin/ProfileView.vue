<template>
  <div>
    <div class="wrapper">
      <div class="profile-card">
        <div class="profile-card__img">
          <img src="https://fsts.um6ss.ma/wp-content/uploads/2021/05/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" alt="profile card">
        </div>
        <div class="titre">
          <span>INFORMATIONS PERSONELLES</span>
          <div class="line"></div>
        </div>
        <div class="information">
          <div class="information__item">
            <span>Nom : {{ clients.nom }}</span>
            <span>Prenom : {{ clients.prenom }}</span>
            <span>Telephone : {{ clients.Telephone }}</span>
            <span>Genre : {{ clients.genre }}</span>
            <span>Email : {{ clients.email }}</span>
            <span>Address : {{ clients.adresse }}</span>
          </div>
          <div class="information__item">
            <div @click="getinfooneclient">
              <button @click="showModal=true">Modifier</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="close-div" v-if="showModal"  @click="showModal=false;"></div>
      <form class="popup-all" v-if="showModal" >
        <h2>Modifier Les information<a  v-if="showModal=true" @click="showModal=false;"><i class="fa fa-times close" aria-hidden="true"></i></a></h2>
        <label for="">Nom</label>
        <input type="text" v-model="clients.nom" placeholder="Nom" class="input-pop">
        <label for="">Prenom</label>
        <input type="text" v-model="clients.prenom" placeholder="Prenom" class="input-pop">
        <label for="">Telephone</label>
        <input type="phone" v-model="clients.Telephone" placeholder="Telephone" class="input-pop">
        <label for="">Genre</label>
        <select class="input-pop" v-model="clients.genre">
            <option class="select-pop" selected disabled>Sélectionez un genre</option>
            <option>Homme</option>
            <option>Femme</option>
        </select>
        <label for="">E-mail</label>
        <input type="email" v-model="clients.email" placeholder="E-mail" class="input-pop">
        <label for="">Adresse</label>
        <input type="adrese" v-model="clients.adresse" placeholder="Address" class="input-pop">
        <input type="submit" @click.prevent="updateclient(clients.id)" value="Valider" class="submit-pop">
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import swal from 'sweetalert';
export default {
  name: "ProfileView",
  data(){
    return{
      showModal : false,
      clients: [],
      client: {
        id: '',
        nom: '',
        prenom: '',
        Telephone: '',
        genre: '',
        email: '',
        adresse: '',
      },
      token : localStorage.getItem('token'),
    }
  },
  components: {
    
  },
  mounted(){
    this.getinfoclient();
  },
  methods: {
    getinfoclient(){
      axios.post('http://localhost/Fakhar/Utilisateur/get_info_client_token', {
        token: this.token
      })
      .then(response => {
        this.clients = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    },
    getinfooneclient(){
      axios.post('http://localhost/Fakhar/Utilisateur/get_info_client_token', {
        token: this.token
      })
      .then(response => {
        this.clients = response.data;
      })
      .catch(error => {
        console.log(error);
      })
    },
    updateclient(){
      axios.put('http://localhost/Fakhar/Utilisateur/update_client_info', {
        token: this.token,
        id: this.clients.id,
        nom: this.clients.nom,
        prenom: this.clients.prenom,
        Telephone: this.clients.Telephone,
        genre: this.clients.genre,
        email: this.clients.email,
        adresse: this.clients.adresse,
      })
      .then((response) => {
        console.log(this.clients.id);
        this.showModal = false
        if(response){
          swal({
            title: "Modification effectué avec succès",
            icon: "success",
            button: "OK",
          });
        }
        else{
          swal({
            title: "Modification échoué",
            icon: "error",
            button: "OK",
          });
        }
      })
      .catch(error => {
        console.log(error);
      })
    }
  },
  beforeMount(){
    let checklocal = localStorage.getItem('token');
    if(!checklocal){
      this.$router.push('/LoginView');
    }
  }
};
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";

.wrapper {
  width: 100%;
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 50px 20px;
  padding-top: 100px;
  display: flex;
  display: flex;
  @media screen and (max-width: 768px) {
    height: auto;
    min-height: 100vh;
    padding-top: 100px;
  }
}
.profile-card {
  width: 100%;
  min-height: 460px;
  margin: auto;
  box-shadow: 0px 8px 60px -10px rgba(13,28,39,0.6);
  background: #fff;
  border-radius: 12px;
  max-width: 800px;
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

  &__img {
    width: 150px;
    height: 150px;
    margin-left: auto;
    margin-right: auto;
    transform: translateY(-50%);
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    z-index: 4;
    @media screen and (max-width: 576px) {
      width: 120px;
      height: 120px;
    }

    img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
  }
  .titre {
    font-size: 1rem;
    font-weight: bold;
    color: #000;
    text-align: center;
    margin-bottom: 30px;
    @include mobile {
      font-size: 12px;
    }
    .line {
    height: 3px;
    background-color: $alt-color;
    width: 31%;
    margin-left: auto;
    margin-right: auto;
    @include mobile {
      display: none;
    }
  }
  }
  .information {
    .information__item {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 20px;
      font-weight: 700;
      @include mobile {
        font-size: 12px;
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
        // &:hover {
        //     background-color: white;
        //     border: 1px solid $main-color;
        //     color: $main-color;
        //     cursor: pointer;
        //     margin: 0px;
        // }
      }
    }
  }
}
.submit-pop {
    display: flex;
    margin: 0 auto;
    background-color: $main-color;
    border: 1px solid white;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    padding: 15px 40px;
    margin-top: 10px;
    &:hover {
        background-color: white;
        border: 1px solid $main-color;
        color: $main-color;
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
    top: 20%;
    right: 21%;
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
</style>
