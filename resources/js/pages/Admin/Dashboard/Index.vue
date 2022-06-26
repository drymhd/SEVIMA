<template>
  <main>
        
    <div class="container">
      <h1>Dashboard Admin</h1>
    </div>

    <div class="row">
      <div class="custom_heading-container">
        <h3 class="">Menu untuk E-Learning</h3>
      </div>
      <div class="card col-md-3">
        <div class="box">
          <div class="content">
            <h3>guru</h3>
            <router-link :to="{ name: 'admin.guru' }">Klik</router-link>
          </div>
        </div>
      </div>
      <div class="card col-md-3">
        <div class="box">
          <div class="content">
            <h3>Siswa</h3>
            <router-link :to="{ name: 'admin.siswa' }">Klik</router-link>
          </div>
        </div>
      </div>
      <div class="card col-md-3">
        <div class="box">
          <div class="content">
            <h3>Kelas</h3>
            <router-link :to="{ name: 'admin.kelas' }">Klik</router-link>
          </div>
        </div>
      </div>
      <div class="card col-md-3">
        <div class="box">
          <div class="content">
            <h3>Mapel</h3>
            <router-link :to="{ name: 'admin.mapel' }">Klik</router-link>
          </div>
        </div>
      </div>
      <div class="card col-md-3">
        <div class="box">
          <div class="content">
            <h3>Kelas Mapel</h3>
            <router-link :to="{ name: 'admin.kelasmapel' }">Klik</router-link>
          </div>
        </div>
      </div>
      
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {},
  mounted() {},
};
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;800&display=swap");

.custom_heading-container {
  display: flex;
  justify-content: center;
}

.custom_heading-container h3 {
  color: black;
  position: relative;
}
.custom_heading-container h3:before {
  content: "";
  position: absolute;
  bottom: -7px;
  left: 50%;
  width: 50px;
  height: 7px;
  transform: translateX(-50%);
  background-color: rgb(169, 65, 8);
  border-radius: 15px;
}

main .card {
  position: relative;
  min-width: 320px;
  height: 200px;
  margin-top: 20px;
  box-shadow: inset 5px 5px 5px rgba(0, 0, 0, 0.2),
    inset -5px -5px 15px rgba(255, 255, 255, 0.1),
    5px 5px 15px rgba(0, 0, 0, 0.3), -5px -5px 15px rgba(255, 255, 255, 0.1);
  border-radius: 15px;
  transition: 0.5s;
}

main .card:nth-child(1) .box .content a {
  background: #2196f3;
}

main .card:nth-child(2) .box .content a {
  background: #e91e63;
}

main .card:nth-child(3) .box .content a {
  background: #23c186;
}

main .card .box {
  position: absolute;
  top: 20px;
  left: 20px;
  right: 20px;
  bottom: 20px;
  background: #2a2b2f;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  transition: 0.5s;
}

main .card .box:hover {
  transform: translateY(-50px);
}

main .card .box:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 50%;
  height: 100%;
  background: rgba(255, 255, 255, 0.03);
}

main .card .box .content {
  padding: 20px;
  text-align: center;
}

main .card .box .content h2 {
  position: absolute;
  top: -10px;
  right: 30px;
  font-size: 8rem;
  color: rgba(255, 255, 255, 0.1);
}

main .card .box .content h3 {
  font-size: 1.8rem;
  color: #fff;
  z-index: 1;
  transition: 0.5s;
  margin-bottom: 15px;
}

main .card .box .content p {
  font-size: 1rem;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.9);
  z-index: 1;
  transition: 0.5s;
}

main .card .box .content a {
  position: relative;
  display: inline-block;
  padding: 8px 20px;
  background: black;
  border-radius: 5px;
  text-decoration: none;
  color: white;
  margin-top: 20px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  transition: 0.5s;
}
main .card .box .content a:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
  background: #fff;
  color: #000;
}
</style>