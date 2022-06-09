<template>
    <nav class="navigation">
        <img src="@/assets/Fakhar-Safilogo.png" alt="logo">
        <div class="mainmenu" @click="showMenu">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul class="navbar" id="navbarId">
            <li v-if="!showings">
                <router-link class="routenav" to="/">Accueil</router-link>
            </li>
            <li>
                <router-link class="routenav" to="/Magasin/BoutiqueView">Magasin</router-link>
            </li>
            <li v-if="!showings">
                <router-link class="routenav" to="/ContactView">Contact</router-link>
            </li>
            <li>
                <router-link class="routenav" to="/"><i class="fa-solid fa-basket-shopping"></i></router-link>
            </li>
            <li v-if="!showings">
                <router-link class="routenav registernav" to="/RegisterView">Register</router-link>
            </li>
            <li v-if="!showings">
                <router-link class="routenav loginnav" to="/LoginView">Login</router-link>
            </li>
            <li v-if="showings">
                <router-link @click="logout_client" class="routenav loginnav" to="/LoginView">Logout</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Nav-bar",
    props: ["setvr", "showings"],
    data() {
        return {
            
        };
    },
    methods: {
        showMenu(){
            document.getElementById("navbarId").classList.toggle("active")
        },
        logout_client() {
            localStorage.clear();
            this.setvr(false);
            this.$router.push('/LoginView');
        },
    },
    mounted(){
        if (window.localStorage.getItem("token") != null && window.localStorage.getItem("role") != "admin") {
            this.setvr(true);
        }
    }
}
</script>

<style lang="scss">
@import "@/sass/mixin.scss";
nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    padding-left: 40px;
    padding-right: 40px;
    background-color: white;
    position: fixed;
    z-index: 999;
    top: 0;
    width: 100%;
    box-shadow: 0 0 10px #ddd;
    img {
        width: 6rem;
    }
.navbar {
        display: flex ;
        @media (max-width: 900px){
            display: none;
        }
        .routenav {
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60px;
            position: relative;
            color: black;
            padding: 0 30px;
            transition: $--main-transition;
            overflow: hidden;
            margin-right: 10px;
            &::before {
                content: " ";
                position: absolute;
                width: 100%;
                height: 4px;
                background-color: $main-color;
                top: 0;
                left: -100%;
                transition: $--main-transition;
            }
            &:hover {
                color: $main-color;
                background-color: #fafafa;
                font-weight: 500;
            }
            &:hover::before {
                left: 0;
            }
            @media (max-width: 900px) {
                margin-block: 10px;
                margin-right: 0px;
            }
        }
        .registernav {
            background-color: $main-color;
            border-radius: 5px;
            margin-right: 10px;
            @media (max-width: 900px) {
                margin-block: 10px;
                margin-right: 0px;
                padding-inline: 28px;
            } 
        }
        .loginnav {
            background-color: $main-color;
            border-radius: 5px;
            @media (max-width: 900px) {
                padding-inline: 38px;
            } 
        }
    }
}
.mainmenu div{
    width: 50px;
    height: 5px;
    background-color: black;
    margin-block: 10px;
    display: none;
    @media (max-width: 900px){
        display: block;
        cursor: pointer;
    }
}
.active{
    display: flex !important;
    align-items: center;
    flex-direction: column;
    width: 100%;
    z-index: 1111;
}
</style>