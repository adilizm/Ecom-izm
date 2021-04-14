<template>
 <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
 
  <div class="carousel-inner">
    <div v-for="(slider,index) in store.state.sliders" :key="slider.id"  class="carousel-item " :class="{'active':index===0}">
      <img :src="slider.image_url" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>{{slider.title}}</h5>
        <p>{{slider.description}}</p>
      </div>
    </div>
   
   
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</template>

<script>
import { inject } from 'vue'
export default {
  setup(){

    const store = inject('store')
    store.methodes.getSliders()
    return{store}
  }

}
</script>

<style>

</style>