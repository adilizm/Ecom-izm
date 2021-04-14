<template>
  <div class="container">
      <div class="row">
         
              <prodect v-for="product in store.state.products" :key="product.id" :product="product" />
            <!--  <prodect v-for="product in store.state.products" :key="product.id" :product_name="product.name" :product_description="product.description" :product_price="product.price" :product_id="product.id" :product_image1="product.image1" :product_slug="product.slug"  />-->
          
      </div>
  </div>
</template>
<script>
import { inject } from 'vue';
import prodect from '../components/prodect.vue'
export default {
    components:{ prodect },
    setup() {
    const store = inject('store')
    store.methodes.getprodects()
    
    return { store };
    }
}
</script>

<style>

</style>