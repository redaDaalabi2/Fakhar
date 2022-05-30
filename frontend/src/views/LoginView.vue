<template>
    <!-- Login form -->
    <section class="login">
        <div class="login-form">
            <div class="content-form" >
            <h2 class="form-title">Login</h2>
            <form method="POST" class="login-form" id="login-form">
                <div class="form-group">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="pass"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" name="motdepasse" placeholder="Mot de passe">
                </div>
                <div class="form-button">
                    <input type="submit" name="login" id="login" class="form-submit" value="Login"/>
                </div>
                <div class="form-group">
                    <router-link to="/RegisterView" class="login-image-link">créer un compte</router-link>
                    <router-link to="/LoginAdminView" class="login-image-link">connectez-vous en tant que admin</router-link>
                </div>
            </form>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "Log-in",
}
</script>

<style lang="scss" scoped>
@import "../sass/_mixin.scss";
.login {
    width: 100%;
    min-height: 100vh;
    background: url('../assets/header-page-contact.jpg') no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding-top: 28vh;
    .login-form {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        padding-block: 5vh;
        .form-title {
            text-align: center;
            margin-top: 10px;
        }
        .form-group{
            width: 100%;
            padding: 6px 10px;
            display: flex;
            justify-content: space-between;
            input{
                width: 100%;
                display: block;
                border: none;
                border-bottom: 1px solid #999;
                background-color: #f6f5f5;
                padding: 0px 30px;
                outline: none;
                &:focus{
                    outline: none;
                }
            }
            label{
                font-size: 1.2rem;
                color: #000;
                font-weight: bold;
                margin-bottom: 4px;
            }
            .login-image-link {
                color: #000;
                font-weight: bold;
                margin-bottom: 4px;
                text-decoration: none;
                margin-top: 10px;
                &:hover {
                    color: $main-color;
                    text-decoration: underline;
                }
                @include tablet {
                    font-size: 14px;
                }
                @include mobile {
                    font-size: 10px;
                }
            }
        }
        .form-button{
            input[type=submit]{
                display: inline-block;
                background: $main-color;
                border: 1px solid white;
                color: white;
                border-radius: 5px;
                cursor: pointer;
                font-weight: bold;
                padding: 15px 20px;
                margin-top: 10px;
                &:hover {
                    background-color: white;
                    border: 1px solid $main-color;
                    color: $main-color;
                    cursor: pointer;
                }
            }
        }
        .content-form{
            background-color: #f6f5f5;
            width: 45%;
            height:auto;
            padding:10px 10px;
            box-shadow: 0px 15px 16.83px 0.17px rgb(0 0 0 / 5%);
            border-radius: 5px;
            @include tablet {
                width: 65%;
            }
            @include mobile {
                width: 80%;
            }
        }
    }
}
</style>