<template>
    <NavBar />
    <!-- Login Admin form -->
    <section class="login">
        <div class="login-form">
            <div class="content-form" >
            <h2 class="form-title">Admin login</h2>
            <form @submit.prevent="login_admin" class="login-form" id="login-form">
                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" v-model="email" name="email" placeholder="E-mail ou N° de Téléphone">
                </div>
                <div class="form-group">
                    <label for="pass"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" v-model="motdepasse" name="motdepasse" placeholder="Mot de passe">
                </div>
                <div class="form-button">
                    <input type="submit" name="login" id="login" class="form-submit" value="Login"/>
                </div>
            </form>
            </div>
        </div>
    </section>
    <Footer />
</template>

<script>
import swal from "sweetalert";
import axios from "axios";
import NavBar from "@/components/GlobalComponent/NavBar.vue";
import Footer from "@/components/GlobalComponent/Footer.vue";
export default {
    name: "Log-in",
    components: {
        NavBar,
        Footer
    },
    data() {
        return {
            email: '',
            motdepasse: ''
        }
    },
    methods: {
        login_admin() {
            if (this.email != '' && this.motdepasse != '') {
                axios.post('http://localhost/Fakhar/Utilisateur/login', {
                        email: this.email,
                        motdepasse: this.motdepasse,
                    })
                    .then(response => {
                        if (response.data.state == true) {
                            if(response.data.role == 'admin'){
                                console.log(response.data);
                                localStorage.setItem("token", response.data.token);
                                localStorage.setItem("role", response.data.role);
                                this.$router.push('/Dashboard/AnalyseAdminView');
                            }else if(response.data.role != 'admin'){
                                swal({
                                    title: "Erreur",
                                    text: "Vous n'êtes pas un administrateur",
                                    icon: "error",
                                    button: "Ok",
                                });
                            }
                        } else {
                            swal({
                                title: "Erreur",
                                text: "Email ou mot de passe incorrect",
                                icon: "error",
                                button: "Ok",
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else {
                swal({
                    title: "Erreur",
                    text: "Veuillez remplir tous les champs",
                    icon: "error",
                    button: "Ok",
                });
            }
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../sass/_mixin.scss";
.login {
    width: 100%;
    min-height: 100vh;
    background: url('../assets/header-page-contact.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding-top: 28vh;
    .login-form {
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
                background-color: #f6f5f5;
                padding: 0px 30px;
                outline: none;
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