<template>
    <div class="container">
        <button type="button" class="btn btn-primary" id="liveToastBtn">Show livedsssasasassasassasassasaassasasasasasasasasa tsasasdsoast</button>dasasasda
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.saxsa
  </div>
</div>
    </div>
</template>

<script>
import auth from '../../auth';

export default {
    data(){
    },
    mounted(){
        var app = this;
        if(app.$auth.check() == true){
          app.$router.push({name: 'redirect'});
        }
    }
}
</script>