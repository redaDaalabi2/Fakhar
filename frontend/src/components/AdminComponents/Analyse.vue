<template>
    <div>
        <h1 class="titre">Analyse</h1>
            <div class="content">
                <div class="col-div-3">
                <div class="box">
                    <p>0<br/><span>Nombre de commande effectuée</span></p>
                    <i class="fa-brands fa-first-order"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p>0<br/><span>Nombre de commandes livrées</span></p>
                    <i class="fa-brands fa-first-order-alt"></i>
                </div>
            </div>
            <div class="col-div-3">
                <div class="box">
                    <p>0<br/><span>Nombre d'inscription</span></p>
                    <i class="fa fa-users box-icon"></i>
                </div>
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
body{
	overflow: hidden;
}
.content {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-direction: column;
    padding-block: 50px;
    width: 100%;
    padding-left: 100px;
    .col-div-3{
        width: 100%;
        float: left;
    }
    .box{     
        margin-right: 30px;
        margin-bottom: 30px;
        height: 100px;
        background-color: #272c4a;
        margin-left: 10px;
        padding:10px;
        p {
            font-size: 35px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            margin-top: 20px;
            display: inline-block;
            span{
                font-size: 20px;
                font-weight: 400;
                color: white;
                @include tablet {
                    font-size: 14px;
                }
                @include mobile {
                    font-size: 10px;
                }
            }
        }
        i{
            font-size: 40px!important;
            float: right;
            margin-top: 35px!important;
            color: white;
            padding-right: 10px;
            @include mobile {
                color: $dash-color;
            }
        }
    }
}
</style>