<template>
  <div class="container" v-for="p in store.state.product" :key="p.slug">
    <div>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <div class="main_image">
            <img id="Main_image" :src="p.image1" class="w-100" :class="{ show: image1 ,hide: !image1}"  alt="" />
          </div>
          <div class="main_image">
            <img id="Main_image" :src="p.image2" class="w-100" :class="{ show: image2 ,hide: !image2 }" alt="" />
          </div>
          <div class="main_image">
            <img id="Main_image" :src="p.image3" class="w-100" :class="{ show: image3 ,hide: !image3 }"  />
          </div>
          <div class="d-flex justify-content-center">
            <img @click="Make_image_main(1)" :src="p.image1" width="100" height="100" alt="" />
            <img  @click="Make_image_main(2)" :src="p.image2"  width="100" height="100" alt=""/>
            <img @click="Make_image_main(3)" :src="p.image3" width="100" height="100" alt="" />
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 py-4">
          <h1 class="">{{ p.name }}</h1>
          <div class="d-flex rate"> <i class="material-icons">star</i> <i class="material-icons">star_rate</i> <i class="material-icons">star</i> <i class="material-icons">star</i> <i class="material-icons">star_half</i></div>
          <div class="d-flex"><h3 class="prix"> {{p.price}} Dhs </h3></div>
          <div>
            <h4>Selet Qty :</h4>
            <div class="container">
              <div class="row">
            <input class="form-control qty col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mx-md-4 mx-0 mx-sm-0 mx-lg-4 mx-xl-4 my-2"  v-model="store.state.Quantity" @keyup="check_qty"  max="20" min="1" type="number" name="" id="">
            <button @click="store.methodes.add_prodect_to_cart_with_qty(p, store.state.Quantity)" class="btn btn-primary col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mx-md-4 mx-0 mx-sm-0 mx-lg-4 mx-xl-4 my-2" >Add to cart</button>
            </div>
            </div> 
          </div>
          <div class="description" v-html="p.description"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { inject, ref } from 'vue';
export default {
    props:['slug'],
    setup(props) {
    const store = inject('store')
    store.methodes.getprodectwithslug(props.slug)
    const image1 = ref(true)
    const image2 = ref(false)
    const image3 = ref(false)
    const qty = ref(1)
    const Make_image_main=(number)=>{ 
          if(number==1){
            image1.value=true
            image2.value=false
            image3.value=false
         }else if(number==2){
            image1.value=false
            image2.value=true
            image3.value=false
          }else if(number==3){
             image1.value=false
            image2.value=false
            image3.value=true
    }
        }
        const check_qty=()=>{
            if(store.state.Quantity>20){
              store.state.Quantity=20;
            }
            if(store.state.Quantity<0){
              store.state.Quantity=1
            }
        }
    return { store,Make_image_main ,image1,image2,image3,check_qty }
    }
}
</script>

<style>
.hide{
    display: none;
}
.prix{
  font-family: 'Changa';
  color: coral;
}
.rate{
  color: rgb(255, 239, 15);
}
.qty{
  font-size: 1.5rem;
}
</style>