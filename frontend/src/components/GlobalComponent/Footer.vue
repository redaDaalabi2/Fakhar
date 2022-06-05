<template>
    <footer>
        <div class="container">
            <!-- <div class="top-menu">
                <ul>
                    <li><router-link class="navli" to="/">Accueil</router-link></li>
                    <li><router-link class="navli" to="/">Magasin</router-link></li>
                    <li><router-link class="navli" to="/ContactView">Contact</router-link></li>
                    <li><router-link class="navli" to="/">Compte</router-link></li>
                </ul>
            </div> -->
            <div class="center-menu">
                <hr class="hrone">
                <div class="row">
                    <div class="row-one">
                        <span class="span-one">Logo</span>
                        <img src="@/assets/Fakhar-Safilogo.png" alt="">
                    </div>
                    <hr>
                    <div class="row-two">
                        <span class="span-two">Contact-nous</span>
                        <span>+212 (0) 664 65 41 29</span>
                        <span> +212 (0) 661 63 07 58</span>
                    </div>
                    <hr>
                    <div class="row-tree">
                        <span class="span-tree">Réseaux-sociaux</span>
                        <div class="icons">
                            <i class="fa-brands fa-linkedin-in"></i>
                            <i class="fa-brands fa-facebook"></i>
                            <i class="fa-brands fa-whatsapp"></i>
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                    </div>
                </div>
                <hr class="lasthr">
            </div>
            <div class="last-menu">
                <p>&copy; 2022 <span>Fakhar-Safi</span> All right reserved</p>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Foo-ter",
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

footer {
    background-color: white;
    color: black;
    padding-left: 40px;
    padding-right: 40px;
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        // .top-menu {
        //     width: 100%;
        //     margin-top: 3vh;
        //     ul {
        //         display: flex;
        //         flex-direction: row;
        //         justify-content: space-evenly;
        //         li {
        //             .navli {
        //                 color: black;
        //                 font-weight: bold;
        //                 text-decoration: none;
        //             }
        //         }
        //     }
        // }
        .center-menu {
            width: 100%;
            margin-block: 3vh;
            .row {
                display: flex;
                justify-content: space-evenly;
                @include mobile {
                    flex-direction: column;
                }
                .row-one {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    flex-direction: column;
                    @include mobile {
                        padding-block: 10px;
                    }
                    .span-one {
                        font-weight: bold;
                        padding-bottom: 5px;
                        color: $alt-color;
                    }
                    img {
                        width: 80px;
                        height: auto;
                    }
                }
                .row-two {
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
                    @include mobile {
                        padding-block: 10px;
                    }
                    .span-two {
                        font-weight: bold;
                        color: $alt-color;
                    }
                }
                .row-tree {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    flex-direction: column;
                    gap: 1rem;
                    @include mobile {
                        padding-block: 10px;
                    }
                    .span-tree {
                        font-weight: bold;
                        color: $alt-color;
                    }
                    .icons {
                        display: flex;
                        gap: 1rem;
                        i {
                            border: 1px solid black;
                            border-radius: 5px;
                            padding: 2px;
                            &:hover {
                                background-color: black;
                                color: white;
                                cursor: pointer;
                            }
                        }
                    }
                }
            }
            .hrone {
                margin-bottom: 3vh;
            }
            .lasthr {
                margin-top: 3vh;
            }
        }
        .last-menu {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: 3vh;
            p {
                font-size: 20px;
                font-weight: 500;
                span {
                    font-weight: bold;
                    color: $alt-color;
                }
                @include tablet {
                    font-size: 18px;
                }
                @include mobile {
                    font-size: 14px;
                }
            }
        }
    }
}
</style>