<template>
    <section>
        <center class="titre">Contact</center>
        <div class="line"></div>
        <form action="" class="form-group">
            <div class="groupeone">
                <div class="formone">
                    <input required type="text" class="form-control" placeholder="Nom">
                    <input required type="text" class="form-control" placeholder="Prenom">
                    <input required type="email" class="form-control" placeholder="E-mail">
                    <input required type="phone" class="form-control" placeholder="Telephone">
                </div>
                <div class="formtwo">
                    <textarea name="" class="form-control" placeholder="Message" id="" cols="22" rows="12.5"></textarea>
                </div>
            </div>
            <div class="groupetwo">
                <input class="formtree" type="submit" value="Envoyer">
            </div>
        </form>
    </section>
</template>

<script>

export default {
    name: "Con-tact",
}
</script>


<style lang="scss" scoped>
@import "../sass/_mixin.scss";
section {
    margin-block: 13vh;
    padding-block: 7vh;
    padding-left: 40px;
    padding-right: 40px;
    .titre {
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
                    border: 1px solid #f0f0ee !important;
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
                    border: 1px solid #f0f0ee!important;
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
