<template>
</template>

<script>


    export default {
        mounted() {
            var app = this;
            console.log(app.$auth.check());
            if(app.$auth.check()){
                this.$router.push({name: this.$auth.user().level});
            } else {
                this.$router.push({name: 'home'});
            }
        }
    }
</script>