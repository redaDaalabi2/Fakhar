<template>
  <div>
    <div class="wrapper">
      <div class="profile-card">
        <div class="profile-card__img">
          <img src="https://fsts.um6ss.ma/wp-content/uploads/2021/05/depositphotos_39258143-stock-illustration-businessman-avatar-profile-picture.jpg" alt="profile card">
        </div>
        <div class="titre">
          <span>INFORMATIONS PERSONELLES</span>
          <div class="line"></div>
        </div>
        <div class="information">
          <div class="information__item">
            <span>Nom : Reda</span>
            <span>Prenom : DAALABI</span>
            <span>Telephone : 0691520892</span>
            <span>Genre : Homme</span>
            <span>Email : daalabireda@gmail.com</span>
            <span>Address : 20 RUE OUALILI QU 01 LEBIAR SAFI</span>
          </div>
          <div class="information__item">
            <button>Modifier</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "ProfileView",
  components: {
    
  },
  methods: {

  },
};
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";

.wrapper {
  width: 100%;
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 50px 20px;
  padding-top: 100px;
  display: flex;
  display: flex;
  @media screen and (max-width: 768px) {
    height: auto;
    min-height: 100vh;
    padding-top: 100px;
  }
}
.profile-card {
  width: 100%;
  min-height: 460px;
  margin: auto;
  box-shadow: 0px 8px 60px -10px rgba(13,28,39,0.6);
  background: #fff;
  border-radius: 12px;
  max-width: 700px;
  position: relative;
  margin-top: 90px;
  margin-bottom: 10px;
  &.active {
    .profile-card__cnt {
      filter: blur(6px);
    }

    .profile-card-message,
    .profile-card__overlay {
      opacity: 1;
      pointer-events: auto;
      transition-delay: .1s;
    }

    .profile-card-form {
      transform: none;
      transition-delay: .1s;
    }
  }

  &__img {
    width: 150px;
    height: 150px;
    margin-left: auto;
    margin-right: auto;
    transform: translateY(-50%);
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    z-index: 4;
    @media screen and (max-width: 576px) {
      width: 120px;
      height: 120px;
    }

    img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
  }
  .titre {
    font-size: 1rem;
    font-weight: bold;
    color: #000;
    text-align: center;
    margin-bottom: 30px;
    @include mobile {
      font-size: 12px;
    }
    .line {
    height: 3px;
    background-color: $alt-color;
    width: 36%;
    margin-left: auto;
    margin-right: auto;
    @include mobile {
      display: none;
    }
  }
  }
  .information {
    .information__item {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      gap: 20px;
      font-weight: 700;
      @include mobile {
        font-size: 12px;
      }
      button {
        padding: 10px 25px;  
        background-color: $main-color;
        border-radius: 5px;
        border: 1px solid white;
        color: white;
        font-size: 16px;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom: 30px;
        cursor: pointer;
        // &:hover {
        //     background-color: white;
        //     border: 1px solid $main-color;
        //     color: $main-color;
        //     cursor: pointer;
        //     margin: 0px;
        // }
      }
    }
  }
}
</style>
