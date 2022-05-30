<template>
    <!-- Register form -->
    <section class="register">
        <div class="register-form">
            <div class="content-form" >
            <h2 class="form-title">Register</h2>
            <form @submit.prevent="register_client" class="register-form" id="register-form">
                <div class="form-group">
                    <label for="name"><i class="fa-solid fa-user"></i></label>
                    <input required type="text" name="nom" placeholder="Nom" v-model="nom">
                </div>
                <div class="form-group">
                    <label for="name"><i class="fa-solid fa-user"></i></label>
                    <input required type="text" name="prenom" placeholder="Prenom" v-model="prenom">
                </div>
                <div class="form-group">
                    <i class="fa-solid fa-venus-mars label-select" style="margin-top: 6px;"></i>
                <select v-model="genre">
                    <option class="option-select" disabled value="">Sélectionnez le genre</option>
                    <option class="option-select" value="">Homme</option>
                    <option class="option-select" value="">Femme</option>
                </select>
                </div>
                <div class="form-group">
                    <label for="Telephone"><i class="fa-solid fa-phone"></i></label>
                    <input required type="phone" name="Telephone" placeholder="Telephone" v-model="Telephone">
                </div>
                <div class="form-group">
                    <label for="adresse"><i class="fa-solid fa-address-book"></i></label>
                    <input required type="text" name="adresse" placeholder="Address" v-model="adresse">
                </div>
                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input required type="email" name="email" placeholder="E-mail" v-model="email">
                </div>
                <div class="form-group">
                    <label for="pass"><i class="fa-solid fa-lock"></i></label>
                    <input required type="password" name="motdepasse" placeholder="Mot de passe" v-model="motdepasse">
                </div>
                <div class="form-button">
                    <input type="submit" name="register" id="register" class="form-submit" value="Register"/>
                </div>
                <div class="form-group">
                    <router-link to="/LoginView" class="register-image-link">je suis déjà membre</router-link>
                </div>
            </form>
            </div>
        </div>
    </section>
</template>

<script>
import swal from 'sweetalert';
import axios from "axios";
export default {
    name: "Regi-ster",
    data(){
        return {
            client: {
                nom: '',
                prenom: '',
                genre: '',
                Telephone: '',
                adresse: '',
                email: '',
                motdepasse: '',
            }
        };
    },
    methods: {
        register_client(){
            if(this.nom != '' && this.prenom != '' && this.genre != '' && this.Telephone != '' && this.adresse != '' && this.email != '' && this.motdepasse != ''){
                axios.post('http://localhost/Fakhar/Utilisateur/register_client', this.client)
                .then(response => {
                    if(response.data.success){
                        swal({
                            title: "Success",
                            text: "Votre compte a été créé avec succès",
                            icon: "success",
                            button: "OK",
                        });
                        this.$router.push('/LoginView');
                    }else{
                        swal({
                            title: "Error",
                            text: "Votre compte n'a pas été créé",
                            icon: "error",
                            button: "OK",
                        });
                    }
                })
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../sass/_mixin.scss";
.register {
    width: 100%;
    min-height: 100vh;
    background: url('../assets/header-page-contact.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding-top: 15vh;
    .register-form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding-block: 5vh;
        .form-title {
            text-align: center;
            margin-top: 10px;
        }
        .form-group{
            width: 100%;
            padding: 6px 10px;
            display: flex;
            justify-content: space-between;
            input{
                width: 100%;
                display: block;
                border: none;
                border-bottom: 1px solid #999;
                padding: 0px 30px;
                outline: none;
                background-color: #f6f5f5;
                &:focus{
                    outline: none;
                }
            }
            label{
                font-size: 1.2rem;
                color: #000;
                font-weight: bold;
                margin-bottom: 4px;
            }
            select{
                width: 100%;
                display: block;
                border: none;
                border-bottom: 1px solid #999;
                background-color: #f6f5f5;
                padding: 6px 10px;
                outline: none;
                position: relative;
                padding-left: 24px;
                &:focus{
                    outline: none;
                }
            }
            .register-image-link {
                color: #000;
                font-weight: bold;
                margin-bottom: 4px;
                text-decoration: none;
                margin-top: 10px;
                &:hover {
                    color: $main-color;
                    text-decoration: underline;
                }
            }
        }
        .form-button{
            input[type=submit]{
                display: inline-block;
                background: $main-color;
                border: 1px solid white;
                color: white;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                padding: 15px 20px;
                margin-top: 10px;
                &:hover {
                    background-color: white;
                    border: 1px solid $main-color;
                    color: $main-color;
                    cursor: pointer;
                }
            }
        }
        .content-form{
            background-color: #f6f5f5;
            width: 45%;
            height:auto;
            padding:10px 10px;
            box-shadow: 0px 15px 16.83px 0.17px rgb(0 0 0 / 5%);
            border-radius: 5px;
            @include tablet {
                width: 65%;
            }
            @include mobile {
                width: 80%;
            }
        }
    }
}
</style>