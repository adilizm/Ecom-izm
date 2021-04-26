<template>
  <div class="container">
    <div class="row" v-if="!store.state.ordred">
      <div class="col-12 col-lg-7 col-xl-7">
        <div class="mx-2 d-flex justify-content-between shop">
          <h1>Shopping Cart</h1>
          <span> {{ store.state.number_prodects_in_cart }} Items</span>
        </div>
        <hr />
        <div>
          <table style="width: 100%">
            <thead>
              <th>PRODUCT DETAILS</th>
              <th>Quantity</th>
              <th>PRICE</th>
              <th>TOTAL</th>
            </thead>
            <tbody>
              <tr v-for="p in store.state.prodects_in_cart" :key="p.id">
                <td>
                  <div class="d-flex my-2">
                    <img
                      class="d-none d-md-block d-lg-block d-xl-block main-product-image-cart"
                      :src="p.product.image1"
                      width="100"
                      height="100"
                      alt=""
                    />
                    <div class="name_remove">
                      <router-link
                        style="
                          font-variant: all-small-caps;
                          color: black;
                          text-align: center;
                          font-size: 20px;
                          font-weight: 700;
                        "
                        :to="{
                          name: 'selected_product',
                          params: { product_name: p.product.name },
                        }"
                        >{{ p.product.name }}</router-link
                      >
                      <div style="text-align: center">
                        <span
                          style="
                            color: #9f9f9f;
                            font-weight: 900;
                            font-variant: all-small-caps;
                            font-size: larger;
                          "
                          v-for="(variant, index) in p.selected_variant"
                          :key="variant"
                          >{{
                            p.variants_values[index][
                              p.selected_variant[index][1]
                            ]
                          }}
                          -
                        </span>
                      </div>
                      <button
                        class="btn btn-sm"
                        @click="
                          store.methodes.remove_product_from_cart(p.product)
                        "
                      >
                        remove
                      </button>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <button
                      class="btn btn-sm px-2 mx-1"
                      @click="store.methodes.decrease_Quantity(p.product)"
                    >
                      -
                    </button>
                    <input
                      style="max-width: 40px"
                      type="number"
                      id="qtyd"
                      :value="p.qty"
                      readonly
                    />
                    <button
                      class="btn btn-sm px-2 mx-1"
                      @click="store.methodes.increase_Quantity(p.product)"
                    >
                      +
                    </button>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    {{ p.product.price }}
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    {{ p.product.price * p.qty }}
                  </div>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <td></td>
              <td></td>

              <td colspan="2">
                Total :
                <span class="price_total"
                  >{{ store.state.total_to_pay }} Dhs</span
                >
              </td>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="col-12 col-lg-5 col-xl-5">
        <div class="mx-2 d-flex justify-content-between shop">
          <h1>Personal info</h1>
        </div>
        <hr />
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="firstname">First name</label>
            <input
              type="text"
              class="form-control"
              id="firstname"
              v-model="store.state.Firstname"
              required
            />
          </div>
          <div class="col-md-6 mb-3">
            <label for="Lastname">Last name</label>
            <input
              type="text"
              class="form-control"
              id="Lastname"
              v-model="store.state.Lastname"
              required
            />
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="Telephone">Telephone :</label>
            <input
              type="text"
              id="Telephone"
              class="form-control"
              placeholder="06-xx-xx-xx-xx"
              v-model="store.state.Telephone"
              required
            />
          </div>
          <div class="col-md-6 mb-3">
            <label>Email :(optional)</label>
            <input
              type="email"
              class="form-control"
              id="validationDefault02"
              v-model="store.state.Email"
              placeholder="Example@email.com"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="Ville">City</label>
          <input
            class="form-control"
            id="Ville"
            type="text"
            placeholder="Casablanca"
            v-model="store.state.Ville"
            required
          />
        </div>
        <div class="form-group">
          <label for="Address">Address</label>
          <textarea
            class="form-control"
            id="Address"
            name="addres"
            cols="30"
            rows="3"
            v-model="store.state.Addres"
            required
          ></textarea>
        </div>

        <div ref="paypal"></div>

        <button
          class="btn btn-primary float-right w-100"
          @click="store.methodes.SubmiteOrder"
          type="button"
        >
          Cash on delivery
        </button>
      </div>
    </div>
    <div v-else>
      <div class="container">
        <div class="row justify-content-center">
          <img
            src="/images/Order-completed.png"
            alt="order-completed"
            width="300"
          />
        </div>
        <div class="row justify-content-center">
          <h4>Order accepted we'll connect you soon</h4>
        </div>
      </div>
      <div class="justify-content-center"><h6>back to shop</h6></div>
    </div>
  </div>
</template>

<script>
import { inject, onMounted, ref } from "vue";
export default {
 
  setup() {
    const store = inject("store");
    const paypal = ref(null);
    let loaded = ref(false);
    let paidFor = ref(false);

    const product = {
      price: 15.22,
      description: "leg lamp from that one movie",
      img: "./assets/lamp.jpg",
    };

     onMounted(() => {
      const script = document.createElement("script");
      script.setAttribute("data-namespace", "paypal_sdk");
      script.src =
        "https://www.paypal.com/sdk/js?client-id=AXDJPmFjXpXm9HMXK4uZcW3l9XrCL36AxEeWBa4rhV2-xFcVYJrGKvNowY-xf2PitTSkStVNjabZaihe";
      script.addEventListener("load",  ()=>{
          loaded = true;
       console.log('hello adil');
      paypal_sdk
        .Buttons({
          createOrder: (data, actions) => { 
            return actions.order.create({
              purchase_units: [
                {
                  description: 'this is product description',
                  amount: {
                    currency_code: "USD",
                    value: store.state.total_to_pay,
                  },
                },
              ],
            });
          },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();
            this.data;
            this.paidFor = true;
            console.log(order);
          },
          onError: (err) => {
            console.log(err);
          },
        })
        .render(paypal.value);
      });  
      document.body.appendChild(script);
        } 
      )
    return { store ,paypal};
  
}}
</script>

<style scoped>
.shop {
  align-items: center;
}
.name_remove {
  display: grid;
  width: 100%;
}
.name {
  place-self: center;
  padding: 0 20px;
  font-weight: 700;
}
td {
  padding: 2px 10px;
}
.price_total {
  font-size: 20px;
  font-weight: 800;
}
.needed {
  border-color: red;
  box-shadow: 0 0 0 0.2rem rgb(255 0 0 / 25%);
}
.main-product-image-cart {
  border-radius: 10px;
}
</style>