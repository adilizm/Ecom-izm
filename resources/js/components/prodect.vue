<template>

  <div class="card my-2">
    <router-link :to="{name:'one-product' , params:{slug:product.slug}}" >
    <img :src="product.image1"  style="width: 100% ; max-height:300px;"/>
    <h1>{{product.name}}</h1>
    </router-link>
    <p class="price">${{product.price}}</p>
    <p> {{product.description}} </p>
    <p><button @click.self="store.methodes.add_prodect_to_cart(product,1)"> Add to cart</button></p>
  </div>
  
</template>

<script>
import { inject } from 'vue';

export default {
  props:['product'],
  setup() {
    const store = inject('store')
    store.methodes.getprodects()
   
    return { store };
    }
}
</script>

<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
}

.price {
  color: grey;
  font-size: 22px;
}

.card button {
  border: none;
  outline: 0;
  padding: 12px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.card button:hover {
  opacity: 0.7;
}
</style>