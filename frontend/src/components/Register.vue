<template>
    <br><br><br><br><br><br>
    <section class="parent">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Register</h2>
                    <form method="" class="register-form">
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="nom" placeholder="Nom">
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="prenom" placeholder="Prenom">
                        </div>
                        <i class="fa-solid fa-venus-mars label-select"></i>
                        <select class="form-group">
                            <option class="option-select" value="">Sélectionnez le genre</option>
                            <option class="option-select" value="">Homme</option>
                            <option class="option-select" value="">Femme</option>
                        </select>
                        <div class="form-group">
                            <label for="Telephone"><i class="fa-solid fa-phone"></i></label>
                            <input type="phone" name="Telephone" placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <label for="adresse"><i class="fa-solid fa-address-book"></i></label>
                            <input type="text" name="adresse" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i></label>
                            <input type="email" name="email" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="motdepasse" placeholder="Mot de passe">
                        </div>
                        <div class="form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register">
                        </div>
                        <div class="form-link">
                            <router-link to="/">je suis déjà membre</router-link>
                        </div>
                    </form>
                </div>
                <!-- <div class="signup-image">
                    <figure><img src="@/assets/signup-image.jpg" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">je suis déjà membre</a>
                </div> -->
            </div>
        </div>
    </section>
    <br><br>
</template>

<script>

export default {
    name: "Reg-ister",
}
</script>


<style lang="scss" scoped>
@import "../sass/_mixin.scss";
.parent {
    margin-inline: 40vh;
    // margin-block: 100vh;
    .container {
        background: #fff;
        margin: 0px auto;
        box-shadow: 0px 15px 16.83px 0.17px rgb(0 0 0 / 5%);
        border-radius: 20px;
        @include desktop {
            width: calc( 100% - 30px);
            max-width: 100%;
        }
        .signup-content {
            display: flex;
            padding: 75px 0px;
            .signup-form {
                margin-left: 75px;
                margin-right: 75px;
                padding-left: 34px;
                width: 100%;
                overflow: hidden;
                .form-title {
                    margin-bottom: 33px;
                    line-height: 1.66;
                    margin: 0;
                    padding: 0;
                    font-weight: bold;
                    font-size: 36px;
                    margin-bottom: 25px;
                }
                .register-form {
                    width: 100%;
                    .form-group {
                            position: relative;
                            margin-bottom: 25px;
                            overflow: hidden;
                            label {
                                position: absolute;
                                left: 0;
                                top: 12%;
                            }
                            input {
                                width: 100%;
                                display: block;
                                border: none;
                                border-bottom: 1px solid #999;
                                padding: 6px 30px;
                                outline: none;
                            }
                            .form-group:last-child {
                                margin-bottom: 0px;
                            }
                            .option-select {
                                padding-block: 10px;
                            }
                        }
                        .label-select {
                            position: absolute;
                            top: 64vh;
                            z-index: 1;
                        }
                        select {
                            width: 100%;
                            display: block;
                            border: none;
                            border-bottom: 1px solid #999;
                            padding: 6px 30px;
                            outline: none;
                            position: relative;
                            margin-bottom: 25px;
                            overflow: hidden;
                        }
                    .form-button {
                        width: 100%;
                        border: none;
                        .form-submit {
                            display: inline-block;
                            background: $main-color;
                            border: 1px solid white;
                            color: white;
                            padding: 15px 39px;
                            border-radius: 5px;
                            cursor: pointer;
                            font-weight: bold;
                            width: 30%;
                            &:hover {
                                background-color: white;
                                border: 1px solid $main-color;
                                color: $main-color;
                                cursor: pointer;
                            }
                        }
                    }
                    .form-link {
                        padding-top: 25px;
                    }
                }
                .signup-image {
                    margin-top: 45px;
                    margin: 0 55px;
                    width: 50%;
                    overflow: hidden;
                    figure {
                        margin: 0px;
                        margin-bottom: 50px;
                        text-align: center; 
                    }
                    .signup-image-link {
                        font-size: 14px;
                        display: block;
                        text-align: center;
                        color: black;
                    }
                }
            }
        }
    }
}
</style>
