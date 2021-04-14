<template>
    <div class="container my-4">
        <div class="row">
            <div v-for="p in store.state.home_products" :key="p.id" class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                <product class="mt-2" :product="p"/>
            </div>
        </div>
    </div>

</template>

<script>
import { inject } from 'vue'
import product from './prodect.vue'
export default {
components:{product},
setup(){
    const store =inject('store')
    store.methodes.get_home_products()
    return{ store}
}
}
</script>

<style>

</style>