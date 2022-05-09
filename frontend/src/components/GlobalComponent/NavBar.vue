<template>
    <nav class="navigation">
        <img src="@/assets/Fakhar-Safilogo.png" alt="logo">
        <div class="mainmenu" @click="showMenu">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <ul class="navbar" id="navbarId">
            <li>
                <router-link class="routenav" to="/">Accueil</router-link>
            </li>
            <li>
                <router-link class="routenav" to="/">Magasin</router-link>
            </li>
            <li>
                <router-link class="routenav" to="/ContactView">Contact</router-link>
            </li>
            <li>
                <router-link class="routenav" to="/">
                    Compte
                    <i class="fa-solid fa-caret-down"></i>
                </router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Nav-bar",
    data() {
        return {
            
        };
    },
    methods: {
        showMenu(){
            document.getElementById("navbarId").classList.toggle("active")
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
    img {
        width: 6rem;
    }
.navbar {
        display: flex ;
        align-items: center;
        justify-content: flex-end;
        @include mobile{
            display: none;
        }
        .routenav {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            position: relative;
            color: black;
            padding: 0 30px;
            overflow: hidden;
        }
        i {
            margin-left: 4px;
        }
    }
}
.mainmenu div{
    width: 60px;
    height: 10px;
    background-color: black;
    margin-block: 12px;
    display: none;
    @include mobile{
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
    gap: 2rem;
    padding-block: 10px;
}
</style>