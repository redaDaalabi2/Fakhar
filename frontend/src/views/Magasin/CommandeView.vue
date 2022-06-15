<template>
    <div>
        <!-- <div class="wrapper">
          <div class="profile-card">
            <div class="content">
              <div class="image_poterie">
                <img src="@/assets/produit/kerra.jpg" alt="">
              </div>
              <div class="detaille_poterie">
                <h4 class="mt-lg-0  mt-4">nom de poterie</h4>
                <h4  class="mt-lg-0  mt-4 ">Catégorie : <span></span></h4>
                <h4  class=" mt-lg-0  mt-4">Prix : <span id="price"> 00.00 MAD</span></h4>
                <div class="row mt-lg-0  mt-4">
                  <h4 class="col-4">Quantité</h4>
                  <div class="col-3 secondary-border secondary-raduis d-flex p-0 ">
                    <button id="subtract" class="col-3 mybtn secondary-border secondary-raduis">-</button>
                    <input  type="number" class="col-6 border-0 text-center" readonly id="input_counter_quantity" value="1" min="1">
                    <button id="add" class="col-3 mybtn  secondary-border secondary-raduis">+</button>
                  </div>
              </div>
            </div>
            <div class="description">

            </div>
          </div>
          </div>
        </div> -->
        <div class="container p-lg-5 p-4 mt-5 mb-5 secondary-border primary-raduis  shadow_card" id="card-container-product">
      <div class="row m-0  col-12" id="card-container-product-column">
        <div id="div-img"
          class="col-lg-4 col-md-10 col-12 p-0 me-lg-3  secondary-border primary-raduis  d-flex justify-content-center shadow_card">
          <img class=" primary-raduis " id="img" src="" alt="">
        </div>
        <div class="col-lg-7 col-12 d-flex flex-column justify-content-between m-lg-3  ">
          <h4 id="name" class="mt-lg-0  mt-4 ">product name</h4>
          <h4  class="mt-lg-0  mt-4 ">Catégorie : <span id="category"></span></h4>
          <h4  class=" mt-lg-0  mt-4">Prix : <span id="price"> 00.00 MAD</span></h4>
          <div class="row mt-lg-0  mt-4">
            <h4 class="col-4">Quantité</h4>
            <div class="col-3 secondary-border secondary-raduis d-flex p-0 ">
              <button id="subtract" class="col-3 mybtn secondary-border secondary-raduis">-</button>
              <input  type="number" class="col-6 border-0 text-center" readonly id="input_counter_quantity" value="1" min="1">
              <button id="add" class="col-3 mybtn  secondary-border secondary-raduis">+</button>
            </div>
          </div>
          <button onclick="get_id_product_for_create_order()" class="mybtn size-btn primary-border secondary-raduis mt-lg-0  mt-4">Ajouter au panier</button>
        </div>
      </div>
      <div class="row me-0  col-12 m-0 mt-4">
        <h4>Description</h4>
        <div  class=" primary-raduis secondary-border shadow_card" id="description-aria-product">
        <p id="description" class="fw-normal">Lorem ipsum dolor Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt ipsum, consequatur illo reiciendis beatae excepturi numquam omnis pariatur dolores magnam magni tenetur odio ad suscipit quasi voluptatem saepe cum obcaecati. sit amet sed vitae animi.</p>
        </div>
      </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "CommandeView",
    data(){
        return{

        }
    },
    beforeMount(){
        let checklocal = localStorage.getItem('token');
        if(!checklocal){
        this.$router.push('/LoginView');
        }
    }
}
</script>

<style lang="scss" scoped>
@import "@/sass/_mixin.scss";
.wrapper {
  width: 100%;
  height: auto;
  min-height: 100vh;
  padding: 50px 20px;
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
  max-width: 900px;
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
  .content {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    .detaille_poterie {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      .image_poterie {
        width: 100%;
        height: 100%;
        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }
    }
  }
}

</style>