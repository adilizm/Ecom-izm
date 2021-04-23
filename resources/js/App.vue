<template>

<navbar/>
<div class="content">
 <router-view/>
 </div>
<Footer0 />
</template>

<script>
import store from './store'
import { provide } from 'vue'
import Footer0 from './components/Footer0.vue'
import navbar from './components/navbar.vue'

export default { 
    components:{ navbar ,Footer0}
    ,setup(){
        provide('store', store)
    }
}
</script>

<style>
.content {
  padding: 20px;
  min-height: 78.5vh;
  margin: 0 auto 5px;
}
</style>