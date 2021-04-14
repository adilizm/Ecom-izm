<template>
 <sliders/>
 <homeprudects/>

</template>

<script>
import { inject } from 'vue';
import sliders from '../components/sliders.vue'
import homeprudects from '../components/home_products.vue'
export default {
  components:{sliders,homeprudects},
 setup() {
    const store = inject('store')
    return { store };
    }
}
</script>

<style>

</style>