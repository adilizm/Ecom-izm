<template>
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-7 col-xl-7">
        <div class="mx-2 d-flex justify-content-between shop">
          <h1>Shopping Cart</h1>
          <span> {{ store.state.number_prodects_in_cart }} Items</span>
        </div>
        <hr />
        <div>
          <table style="width:100%">
            <thead>
              <th>PRODUCT DETAILS</th>
              <th>Quantity</th>
              <th>PRICE</th>
              <th>TOTAL</th>
            </thead>
            <tbody>
              <tr  v-for="product in store.state.prodects_in_cart" :key="product.id">
                  <td>
                    <div class="d-flex my-2">
                       <img class="d-none d-md-block d-lg-block d-xl-block " :src="product.product.image1" width="100" height="100" alt="">
                        <div class="name_remove">
                            <span class="name">{{product.product.name}}</span>
                            <button class="btn btn-sm" @click="store.methodes.remove_product_from_cart(product.product)">remove</button>
                        </div>
                    </div>
                  </td>
                  <td>
                      <div class="d-flex">
                      <button class="btn btn-sm px-2 mx-1" @click="store.methodes.decrease_Quantity(product.product)"  >-</button>
                      <input style="max-width:40px;" type="number" id="qtyd" :value="product.qty" readonly >
                      <button class="btn btn-sm px-2 mx-1" @click="store.methodes.increase_Quantity(product.product)" >+</button>
                      </div>
                  </td>
                     <td>
                      <div class="d-flex">
                       {{product.product.price}}
                      </div>
                  </td>
                    <td>
                      <div class="d-flex">
                       {{product.product.price * product.qty}}
                      </div>
                  </td>
              </tr>
            </tbody>
            <tfoot>
              <td></td>
              <td></td>
            
              
              <td colspan="2"> Total : <span class="price_total">{{store.state.total_to_pay}} Dhs</span></td>
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
      <input type="text" class="form-control" id="firstname" v-model="store.state.Firstname"  required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="Lastname">Last name</label>
      <input type="text" class="form-control" id="Lastname" v-model="store.state.Lastname"    required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="Telephone">Telephone :</label>
      <input type="text" id="Telephone" class="form-control" placeholder="06-xx-xx-xx-xx" v-model="store.state.Telephone"   required>
    </div>
    <div class="col-md-6 mb-3">
      <label >Email :(optional)</label>
      <input type="email" class="form-control" id="validationDefault02" v-model="store.state.Email"   placeholder="Example@email.com" >
    </div>
  </div>
  <div class="form-group">
      <label for="Ville">City</label>
      <input  class="form-control" id="Ville"  type="text" placeholder="Casablanca" v-model="store.state.Ville"   required>
  </div>
  <div class="form-group">
      <label for="Address">Address</label>
      <textarea class="form-control" id="Address" name="addres" cols="30" rows="3" v-model="store.state.Addres"   required ></textarea>
  </div>
  <button class="btn btn-primary float-right" @click="store.methodes.SubmiteOrder" type="button">Make the order</button>

      </div>
    </div>
  </div>
</template>

<script>
import { inject } from 'vue';
export default {
    setup(){
        const store = inject('store')
        console.log(store.state.prodects_in_cart)
        return{ store }
    }
};
</script>

<style scoped>
.shop {
  align-items: center;
}
.name_remove{
    display: grid;
}
.name{
    place-self: center;
    padding: 0 20px;
    font-weight: 700;
}
td{
    padding: 2px 10px;
}
.price_total{
      font-size: 20px;
    font-weight: 800;
}
.needed{
  border-color: red;
  box-shadow: 0 0 0 0.2rem rgb(255 0 0 / 25%);
}
</style>