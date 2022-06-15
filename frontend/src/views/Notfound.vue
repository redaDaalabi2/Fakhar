<template>
    <div>
        <div class="notfound">
            <h1>Error 404</h1>
            <h2>Page non trouvée</h2>
            <img src="https://img.freepik.com/vecteurs-libre/erreur-404-perdue-dans-illustration-du-concept-espace_114360-7891.jpg?w=2000" alt="">
        </div>
    </div>
</template>

<script>
export default {
    name: "Not-found",
    data(){
        return{

        }
    },
}
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";
.notfound {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-bottom: 6vh;
    margin-top: 13vh;
    padding-top: 4vh;
    img {
        width: 300px;
        margin-top: 5vh;
        border-radius: 50%;
        height: 300px;
    }
}
</style>