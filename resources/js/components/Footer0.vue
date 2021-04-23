<template>
<div class="mt-3 justify-content-center align-items-center text-center footer">
      <h3>Follow us on </h3>
      <div class="d-flex justify-content-center text-center align-items-center">
          <span id="social_span" class="m-3 social"><img src="/images/001-instagram.png" id="socaial" alt="" width="40" height="40"></span>
          <span id="social_span" class="m-3 social"><img src="/images/002-facebook.png" id="socaial" alt="" width="40" height="40"></span>
          <span id="social_span" class="m-3 social"><img src="/images/003-twitter.png" id="socaial" alt="" width="40" height="40"></span>
      </div>
      <div class="adil"><p>made with love by ADIL IZM </p></div>
</div>
</template>

<script>
export default {
setup(){
   console.log('okokokokokok')
}
}
</script>

<style>
.social{
    cursor: pointer;
}
#socaial:hover img{
    transform: scale(1.5);
}
.footer{
    background-color: rgb(185, 216, 232);
    width: 100vw;

}

.adil{
    background-color: rgb(228, 228, 228);
    position: absolute;
    width: 100%;
    justify-content: center;
    display: flex;
    font-variant: all-petite-caps;
    height: 30px;
 
}
html, body {
  height: 100%;
  margin: 0;
}
.footer{
    
      position:relative;
}
</style>