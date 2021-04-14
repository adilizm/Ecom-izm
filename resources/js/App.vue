<template>
<navbar/>



 <router-view/>
</template>

<script>
import store from './store'
import { provide } from 'vue'

import navbar from './components/navbar.vue'
import sliders from './components/sliders.vue' 

export default { 
    components:{ navbar,sliders }
    ,setup(){
        provide('store', store)
    }
}
</script>

<style>

</style>