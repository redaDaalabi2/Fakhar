<template>
    <div>
        <h1 class="titre">Analyse</h1>
        <div class="content">
            <div class="container">
                <div class="one">
                    <h4>Nombre de commande effectuée</h4>
                    <h4>0</h4>
                </div>
                <div class="two">
                    <h4>Nombre de commandes livrées</h4>
                    <h4>0</h4>
                </div>
            </div>
            <div class="tree">
                <h4>Nombre d'inscription</h4>
                <h4>0</h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Anal-yse",
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
.titre {
    padding-block: 20px;
    text-align: center;
    font-size: 2em;
    color: white;
    font-weight: bold;
    box-shadow: 0 0 10px #ddd;
    background-color: $dash-color;
    @include tablet {
        font-size: 1.5em;
    }
    @include mobile {   
        font-size: 1.2em;
    }
}
.content {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding-block: 72px;
    flex-direction: column;
    width: 100%;
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-inline: 20px;
        margin-block: 20px;
        width: 100%;
        .one {
            height: 150px;
            background-color: white;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
            border-radius: 15px;
            width: 40%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            h4{
                text-align: center;
                @include tablet {
                    font-size: 11px;
                }
                @include mobile {
                    font-size: 9px;
                }
            }
            @include tablet {
                font-size: 11px;
            }
            @include mobile {
                font-size: 9px;
            }
        }
        .two {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: white;
            width: 40%;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
            height: 150px;
            border-radius: 15px;
            @include tablet {
                font-size: 11px;
            }
            @include mobile {
                font-size: 9px;
            }
            h4{
                text-align: center;
                @include tablet {
                    font-size: 11px;
                }
                @include mobile {
                    font-size: 9px;
                }
            }
        }
    }
    .tree {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-block: 20px;
        height: 150px;
        width: 83%;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
        background-color: white;
        border-radius: 15px;
        @include tablet {
            font-size: 11px;
        }
        @include mobile {
            font-size: 9px;
        }
        h4{
            text-align: center;
            @include tablet {
                font-size: 11px;
            }
            @include mobile {
                font-size: 9px;
            }
        }
    }
}
</style>