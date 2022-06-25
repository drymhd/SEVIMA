<template>
    <div id="main">
        <header id="header">
            <Menu></Menu>
        </header>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
  import Menu from './components/Menu.vue'
  export default {
    data() {
      return {
        //
      }
    },
    methods: {
      middleware(level, levels=[]) {
                var app = this;
                if(levels.length != 0){
                    if(levels.includes(app.$auth.user().level)){
                        return
                    }else{
                        app.$router.push({name: 'notfound'});
                    }
                }else{
                    if(app.$auth.user().level == level || level == 'all') {
                        return;
                    }else{
                        app.$router.push({name: 'notfound'});
                    }
                }
            },

    },
    components: {
      Menu: Menu
    }
  }
</script>

<style>
.header{
  position: relative;
    background-color: #def7ff;
}
</style>