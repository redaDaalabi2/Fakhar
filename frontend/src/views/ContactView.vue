<template>
    <NavBar />
    <section>
        <div class="backcontact">
        <center class="titre">Contact</center>
        <div class="line"></div>
        <form action="" class="form-group">
            <div class="groupeone">
                <div class="formone">
                    <input type="text" class="form-control" placeholder="Nom *" v-model="nom">
                    <input type="text" class="form-control" placeholder="Prenom *" v-model="prenom">
                    <input type="email" class="form-control" placeholder="E-mail *" v-model="email">
                    <input type="phone" class="form-control" placeholder="Telephone *" v-model="telephone">
                </div>
                <div class="formtwo">
                    <textarea type="text" class="form-control" placeholder="Message *" id="" cols="22" rows="12.5" v-model="message"></textarea>
                </div>
            </div>
            <div class="groupetwo">
                <input class="formtree" type="submit" value="Envoyer" @click.prevent="contacter">
            </div>
        </form>
        </div>
    </section>
    <Footer />
</template>

<script>
import NavBar from "@/components/GlobalComponent/NavBar.vue";
import Footer from "@/components/GlobalComponent/Footer.vue";
import axios from "axios";
import swal from 'sweetalert';
export default {
    name: "Cont-act",
    components: {
        NavBar,
        Footer
    },
    data() {
        return {
            nom: "",
            prenom : "",
            email : "",
            telephone : "",
            message : ""
        };
    },
    methods : {
        contacter() {
            if(this.nom != "" && this.prenom != "" && this.email != "" && this.telephone != "" && this.message != ""){
                axios.post('http://localhost/Fakhar/Contacte/contacter', {
                    nom: this.nom,
                    prenom: this.prenom,
                    email: this.email,
                    telephone: this.telephone,
                    message: this.message
                })
                .then(() => {
                    swal({
                        title: "contacte Successfuly",
                        text: "Plz visiter le magasin pour découvrez les dernier poterie",
                        icon: "success",
                        button: "ok",
                    });
                })
                this.$router.push('/');
            }
            {
                swal({
                    title: "Something Wrong",
                    text  : "plz remplir tous les champs",
                    icon: "error",
                    button: "ok",
                });
            }
        }
    }
}
</script>

<style scoped lang="scss">
@import "../sass/_mixin.scss";
section {
    width: 100%;
    min-height: 100vh;
    background: url('../assets/header-page-contact.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    margin-top: 13vh;
    padding-top: 12vh;
    padding-left: 40px;
    padding-right: 40px;
    @include mobile {
        margin-top: 0px;
    }
    .titre {
        color: white;
        margin: 25px 0px 5px 0px;
        font-size: 25px;
        font-weight: bold;
        padding-top: 25px;
        @include tablet {
            font-size: 20px;
        }
        @include mobile {
            font-size: 14px;
        }
    }
    .line {
        width: 16vh;
        height: 3px;
        background-color: $main-color;
        margin-bottom: 2rem;
        margin-left: auto;
        margin-right: auto;
        @include tablet {
            width: 13vh;
        }
        @include mobile {
            width: 9vh;
        }
    }
    .form-group {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 2rem;
        .groupeone {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6rem;
            @include mobile {
                flex-direction: column;
                gap: 3rem;
            }
            .formone {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                gap: 2rem;
                .form-control {
                    border: 1px solid $main-color !important;
                    outline: none;
                    width: 100%;
                    padding: 8px 15px;
                    font-weight: 600;
                    font-style: italic;
                    font-size: 14.9px;
                    border-radius: 0;
                }
            }
            .formtwo {
                .form-control {
                    border: 1px solid $main-color !important;
                    outline: none;
                    width: 100%;
                    padding: 8px 15px;
                    font-weight: 600;
                    font-style: italic;
                    font-size: 14.9px;
                    border-radius: 0;
                    max-width: 220px;
                    max-height: 240px;
                    min-width: 220px;
                    min-height: 240px;
                }
            }
        }
        .groupetwo {
            margin-bottom: 25px;
            .formtree {
                padding: 10px 25px;  
                background-color: $main-color;
                border-radius: 5px;
                border: 1px solid white;
                color: white;
                font-size: 16px;
                font-weight: bold;
                width: 100%;
                &:hover {
                    background-color: white;
                    border: 1px solid $main-color;
                    color: $main-color;
                    cursor: pointer;
                    margin: 0px;
                }
            }
        }
    }
}
</style>