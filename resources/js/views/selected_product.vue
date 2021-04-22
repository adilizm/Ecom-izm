<template>
  <div class="container" v-for="p in store.state.product" :key="p.product">
    <div>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="main_image">
            <img
              id="Main_image"
              :src="p.product.image1"
              class="w-100"
              :class="{ show: image1, hide: !image1 }"
              alt=""
            />
          </div>
          <div class="main_image">
            <img
              id="Main_image"
              :src="p.product.image2"
              class="w-100"
              :class="{ show: image2, hide: !image2 }"
              alt=""
            />
          </div>
          <div class="main_image">
            <img
              id="Main_image"
              :src="p.product.image3"
              class="w-100"
              :class="{ show: image3, hide: !image3 }"
            />
          </div>
          <div class="d-flex justify-content-center">
            <img
              @click="Make_image_main(1)"
              :src="p.product.image1"
              width="100"
              height="100"
              alt=""
            />
            <img
              @click="Make_image_main(2)"
              :src="p.product.image2"
              width="100"
              height="100"
              alt=""
            />
            <img
              @click="Make_image_main(3)"
              :src="p.product.image3"
              width="100"
              height="100"
              alt=""
            />
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 py-4">
          <h1 class="">{{ p.product.name }}</h1>
          <div class="d-flex rate">
            <i class="material-icons">star</i>
            <i class="material-icons">star_rate</i>
            <i class="material-icons">star</i>
            <i class="material-icons">star</i>
            <i class="material-icons">star_half</i>
          </div>
          <div class="d-flex">
            <h3 class="prix">{{ p.product.price }} Dhs</h3>
          </div>
          <div>
            <div class="container">
              <div class="row">
                <div class="d-flex align-items-center">
                  <h4 style="width: 200px; font-size: 0.9em">
                    Selet Quantity :
                  </h4>
                  <input
                    class="form-control mt-1 d-flex align-items-center"
                    style="width: auto"
                    v-model="store.state.Quantity"
                    @keyup="check_qty"
                    max="20"
                    min="1"
                    type="number"
                    name=""
                    id=""
                  />
                </div>

                 <div  class="dropdown mt-1 d-flex align-items-center"
                  style="width: -webkit-fill-available" v-for="(variant, index) in p.selected_variant"
                  :key="variant">
                  <h4 style="width: 200px; font-size: 16px">
                    Select {{ variant[0] }}
                  </h4>
                  <button
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    style="width: inherit;"
                    id="dropdownMenuButton"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                  >
                    {{ p.variants_values[index][p.selected_variant[index][1]] }}
                  </button>
                  <div
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <a  v-for="(value, index) in p.variants_values[index]"
                      :key="value" @click="store.methodes.callme(variant[0],index)"  class="dropdown-item" >{{ value }}</a>
                
                  </div>
                </div>

                <button
                  @click="
                    store.methodes.add_prodect_to_cart_with_qty(
                      p,
                      store.state.Quantity
                    )
                  "
                  class="btn btn-primary col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mx-md-4 mx-0 mx-sm-0 mx-lg-4 mx-xl-4 my-2"
                >
                  Add to cart
                </button>
              </div>
            </div>
          </div>
          <div class="description" v-html="p.product.description"></div>
          {{ Object.keys(JSON.parse(p.product.variants))[3] }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { inject, ref } from "vue";
export default {
  props: ["product_name"],
  setup(props) {
    const store = inject("store");
    console.log('product_name =',props.product_name)
    store.methodes.select_prodect_from_cart(props.product_name);
    const image1 = ref(true);
    const image2 = ref(false);
    const image3 = ref(false);
    const qty = ref(1);
    const Make_image_main = (number) => {
      if (number == 1) {
        image1.value = true;
        image2.value = false;
        image3.value = false;
      } else if (number == 2) {
        image1.value = false;
        image2.value = true;
        image3.value = false;
      } else if (number == 3) {
        image1.value = false;
        image2.value = false;
        image3.value = true;
      }
    };
    const check_qty = () => {
      if (store.state.Quantity > 20) {
        store.state.Quantity = 20;
      }
      if (store.state.Quantity < 0) {
        store.state.Quantity = 1;
      }
    };

  
    return { store, Make_image_main, image1, image2, image3, check_qty };
  },
};
</script>

<style>
.hide {
  display: none;
}
.prix {
  font-family: "Changa";
  color: coral;
}
.rate {
  color: rgb(255, 239, 15);
}
.qty {
  font-size: 1.5rem;
}
</style>