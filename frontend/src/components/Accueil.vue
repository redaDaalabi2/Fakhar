<template>
    <section class="main-back">
        <div class="back-container">
            <div class="caro-back"></div>
            <div class="desc-back">
                <h1>Le 100% fait-main</h1>
                <h1 class="desc-one">La qualité est notre engagement</h1>
                <h1>Livraison à domicile</h1>
                <a class="butt-one">
                    <router-link class="Achetez-butt" to="/">Achetez maintenant</router-link>
                </a>
            </div>
        </div>
    </section>
    <section class="main-pro">
        <center class="titre-one">Les produits les plus populaires</center>
        <div class="line-one"></div>
        <div class="content">
            <div class="card">
                <h3 class="card-titre">Soupiére Arabesque</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/arabesque.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
            <div class="card">
                <h3 class="card-titre">Kerra</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/kerra.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
            <div class="card">
                <h3 class="card-titre">Théières Beldi</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/berrad-beldi.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
            <div class="card">
                <h3 class="card-titre">Carafes Traditionnelles</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/ghoraf-siala.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
            <div class="card">
                <h3 class="card-titre">Plats Berbères</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/tatoue-berbere.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
            <div class="card">
                <h3 class="card-titre">Verres Beldi en Or</h3>
                <div class="card-line"></div>
                <img src="../assets/produit/tradi.jpg" alt="">
                <a class="card-butt">
                    <router-link class="Voir" to="/">Voir plus</router-link>
                </a>
            </div>
        </div>
    </section>
    <section class="main-decovrez">
        <center class="decov-titre">découvrez notre magasin</center>
        <div class="decov-line"></div>
        <div class="decov-content">
            <div class="decov-desc">
                <h2 class="desc-decov decov-font">Le 100% fait-main</h2>
                <h2 class="desc-decov-two decov-font">La qualité est notre engagement</h2>
                <h2 class="desc-decov decov-font">Livraison à domicile</h2>
            </div>
            <div class="decov-img">
                <img src="../assets/magazin.jpg" alt="">
            </div>
        </div>
    </section>
    <section class="main-trouver">
        <center class="trouver-titre">Trouver nous</center>
        <div class="trouver-line"></div>
        <div class="trouver-iframe">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3373.473849751967!2d-9.253276785617206!3d32.27223591686002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdac2714f2593415%3A0x9c42ca37df4ee3d1!2z2YLYsdmK2Kkg2KfZhNiu2LLZgdmK2YY!5e0!3m2!1sfr!2sma!4v1650981469928!5m2!1sfr!2sma" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</template>

<script>

export default {
    name: "Acc-ueil",
}
</script>

<style scoped lang="scss">

@import "../sass/_mixin.scss";
.main-back {
    width: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: url('../assets/870x489_gettyimages-88528910.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    margin-top: 78px;
    position: relative;
    .back-container {
        display: flex;
        justify-content: flex-end;
        width: 100%;
    }
    .desc-back {
        display: flex;
        flex-direction: column;
        color: white;
        font-size: 18px;
        font-style: italic;
        padding-right: 70px;
        @include tablet {
            font-size: 14px;
        }
        @include mobile {
            font-size: 10px;
        }
        .desc-one {
            padding: 50px 0px 50px 0px;
        }
        .butt-one {
            padding: 20px;  
            background-color: $main-color;
            margin-top: 50px;
            border-radius: 5px;
            border: none;
            font-style: normal;
            font-size: 16px;
            width: 47%;
            @include tablet {
                font-size: 13px;
                width: 48%;
                padding: 15px;
            }
            @include mobile {
                font-size: 10px;
                width: 50%;
                padding: 10px;
            }
            .Achetez-butt {
                text-decoration: none;
                font-weight: bold;
                color: white;
                &:hover {
                    background-color: white;
                    border: 1px solid $main-color;
                    color: $main-color;
                    // cursor: pointer;
                    // margin: 0px;
                }
            }
        }
    }
    .caro-back {
        position: absolute;
        top: 30px;
        bottom: 30px;
        left: 30px;
        right: 30px;
        margin: auto;
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 20px;
    }
}
.titre-one {
    color: $alt-color;
    margin: 25px 0px 5px 0px;
    font-size: 25px;
    font-weight: bold;
    @include tablet {
        font-size: 20px;
    }
    @include mobile {
        font-size: 14px;
    }
}
.line-one {
    width: 64vh;
    height: 3px;
    background-color: $main-color;
    margin-bottom: 2rem;
    margin-left: auto;
    margin-right: auto;
    @include tablet {
        width: 51vh;
    }
    @include mobile {
        width: 35.5vh;
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
        padding: 25px 0px 25px 0px;
        margin: 15px;
        transition: 0.7s ease;
        .card-titre {
            text-align: center;
            color: $alt-color;
            font-weight: 400;
        }
        .card-line {
            width: 60%;
            height: 3px;
            background-color: $main-color;
            margin-bottom: 1.25rem;
            margin-left: auto;
            margin-right: auto;
        }
        img {
            width: 100%;
        }
        .card-butt {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 15px;
            .Voir {
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
                    // font-weight: bold;
                    margin: 0px;
                }
            }
        }
    }
}
.main-decovrez {
    padding: 0px 40px 0px 40px;
}
.decov-titre {
    color: $alt-color;
    margin: 25px 0px 5px 0px;
    font-size: 25px;
    font-weight: bold;
    @include tablet {
        font-size: 20px;
    }
    @include mobile {
        font-size: 14px;
    }
}
.decov-line {
    width: 50vh;
    height: 3px;
    background-color: $main-color;
    margin-bottom: 2rem;
    margin-left: auto;
    margin-right: auto;
    @include tablet {
        width: 40vh;
    }
    @include mobile {
        width: 28vh;
    }
}
.decov-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0px 40px 0px 40px;
    margin-bottom: 2rem;
    .decov-desc {
        justify-content: flex-start;
        width: 100%;
        @include mobile {
            display: none;
        }
        .desc-decov-two {
            padding: 40px 0px 40px 0px;
        }
        @include tablet {
            .decov-font {
                font-size: 14px;
            }
        }
        @include mobile {
            .decov-font {
                font-size: 6px;
            }
        }
    }
    .decov-img {
        justify-content: flex-end;
        img {
            width: 100%;
            border-radius: 5px;
        }
    }
}
.main-trouver {

    .trouver-titre {
        color: $alt-color;
        margin: 25px 0px 5px 0px;
        font-size: 25px;
        font-weight: bold;
        @include tablet {
            font-size: 20px;
        }
        @include mobile {
            font-size: 14px;
        }
    }
    .trouver-line {
        width: 26vh;
        height: 3px;
        background-color: $main-color;
        margin-bottom: 2rem;
        margin-left: auto;
        margin-right: auto;
        @include tablet {
            width: 21vh;
        }
        @include mobile {
            width: 14vh;
        }
    }
    .trouver-iframe {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 2rem;
        width: 100%;
        iframe {
            border-radius: 5px;
        }
    }
}

</style>