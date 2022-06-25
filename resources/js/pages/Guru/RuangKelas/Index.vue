<template>
  <main>
    <div class="container">
      <h1>Ruang Kelas</h1>
    <div class="card" v-if="show">
      <h5 class="card-header">Tambah Kelas</h5>
      <div class="card-body">
        <form autocomplete="off" @submit.prevent="tambah">
          <div class="form-group">
            <label for="name">Nama Kelas</label>
            <input
              type="text"
              id="name"
              class="form-control"
              placeholder="Nama Kelas"
              v-model="form.nama_kelas"
              required
            />
          </div>
          <div class="form-group col-md-4">
      <label for="inputState">Kelas</label>
      <select id="inputState" class="form-control" v-model="form.kelas_id">
        <option v-for="data in kelas" :value="data.kelas_id">{{data.kelas.nama_kelas}}</option>
      </select>
    </div>
          <br />
          <button type="submit" class="btn btn-primary">{{ type }}</button>
          <button
            type="button"
            class="btn btn-danger"
            @click.prevent="show = false"
          >
            Batal
          </button>
        </form>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="custom_heading-container">
        <h3 class="">Daftar Kelas</h3>
      </div>
      <div class="card1 col-md-3" v-if="room.length != 0" v-for="data in room">
        <div class="box">
          <div class="content">
            <h3>{{data.nama_room}}</h3>
            <router-link :to="{ name: 'guru.daftarkelas' }">Klik</router-link>
          </div>
        </div>
      </div>
      <div class="row" v-else>
        <div class="text-center" style="margin-top: 30px">
          <h1>Tidak ada data</h1>
        </div>
      </div>
    </div>
    <div class="container">
      <button class="col-md-12 btn btn-primary btn-block" @click.prevent="show = true" v-if="!show">
        tambah
      </button>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
        show: false,
      room: [],
      kelas: [],
      form: {},
      type: "tambah",
    };
  },
  methods: {
    index() {
      var app = this;
      app.$http
        .get("guru/room/index")
        .then((res) => {
          console.log(res);
          app.room = res.data.data;
        })
        .catch((err) => {
          toastr.error("sesuatu error terjadi", "error");
        });
      app.$http
        .get("guru/room/indexkelas")
        .then((res) => {
          console.log(res);
          app.kelas = res.data.data;
        })
        .catch((err) => {
          toastr.error("sesuatu error terjadi", "error");
        });
    },
    tambah(){
        var app = this;
        app.$http.post('guru/room/tambah', {data: app.form}).then((res) => {
            console.log(res)
        });
    }
  },
  mounted() {
    var app = this;
    app.index();
  },
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

main .card1 {
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

main .card1 .box {
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

main .card1 .box:hover {
  transform: translateY(-50px);
}

main .card1 .box:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 50%;
  height: 100%;
  background: rgba(255, 255, 255, 0.03);
}

main .card1 .box .content {
  padding: 20px;
  text-align: center;
}

main .card1 .box .content h2 {
  position: absolute;
  top: -10px;
  right: 30px;
  font-size: 8rem;
  color: rgba(255, 255, 255, 0.1);
}

main .card1 .box .content h3 {
  font-size: 1.8rem;
  color: #fff;
  z-index: 1;
  transition: 0.5s;
  margin-bottom: 15px;
}

main .card1 .box .content p {
  font-size: 1rem;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.9);
  z-index: 1;
  transition: 0.5s;
}

main .card1 .box .content a {
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
main .card1 .box .content a:hover {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.6);
  background: #fff;
  color: #000;
}
</style>