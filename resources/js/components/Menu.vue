<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      
      <router-link :to="{name: 'redirect'}" class="navbar-brand  mr-4">E-Learning</router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto" v-if="$auth.check()">
          <li class="nav-item" v-for="(route, key) in routes[$auth.user().level]" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="!$auth.check()">
          <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link">{{route.name}}</router-link>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto" v-if="$auth.check()">
        <li class="nav-item">
          <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
</template>
<script>
import {useAuth  } from '@websanova/vue-auth/src/v3.js';
    import useAuthComp from '../routeAuth.js';
  export default {
    setup(){
            const auth = useAuth();
            
    },
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            { name: 'Register', path: 'register' },
            { name: 'Login', path: 'login'}
          ],
          // LOGGED USER
          user: [
            { name: 'Dashboard', path: 'user' }
          ],
          // LOGGED ADMIN
          admin: [
            { name: 'Dashboard', path: 'admin' }
          ]
        }
      }
    },
    mounted() {
      setTimeout(() => {
        
        console.log(this.$auth.user())
      }, 1000);
    }
  }
</script>

<style>
.navbar {
  margin-bottom: 30px;
}
</style>