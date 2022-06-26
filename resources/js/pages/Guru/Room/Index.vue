<template>
  <main>
    <div class="container">
      <h1 class="text-center">{{ data.nama_room }}</h1>
      <div v-if="data.materi.length != 0">
        <div
          class="card text-center"
          v-for="data in data.materi"
          style="margin-top: 10px"
        >
          <div class="card-header">
            <h5 class="card-title">{{ data.nama_materi }}</h5>
          </div>
          <div class="card-body">
            <p style="white-space: pre-line" class="card-text">
              {{ data.isi_materi }}
            </p>
            <a href="#" class="btn btn-primary" @click.prevent="$router.push({name: 'guru.materi', params: {id: data.id}})">Lihat</a>
          </div>
          <div class="card-footer text-muted">{{ data.created_at }}</div>
        </div>
      </div>
      <div v-else>
        <div class="card">
          <div class="card-body">Tidak ada data</div>
        </div>
      </div>
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
                v-model="form.nama_materi"
                required
              />
            </div>
            <div class="form-group">
              <label for="name">Isi Materi</label>
              <textarea
                class="form-control"
                aria-label="With textarea"
                v-model="form.isi_materi"
              ></textarea>
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
      <button
        class="btn btn-block btn-success"
        style="margin-top: 30px"
        @click.prevent="show = true"
      >
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
      form: {},
      type: "tambah",
      data: {
        materi: [],
      },
    };
  },
  methods: {
    index() {
      var app = this;
      var id = app.$route.params.id;
      app.$http
        .get("guru/roommateri/index/" + id)
        .then((res) => {
          app.data = res.data.data;
        })
        .catch((err) => {
          toastr.error("sesuatu error terjadi", "error");
        });
    },
    tambah() {
      var app = this;
      var id = app.$route.params.id;

      app.$http
        .post("guru/roommateri/tambah/" + id, { data: app.form })
        .then((res) => {
          app.show = false;
          app.form = {};
          app.index();
          toastr.success("sukses menambah materi", "sukses");
        })
        .catch((err) => {
          toastr.error("gagal menambah materi", "gagal");
        });
    },
  },
  mounted() {
    var app = this;
    if (app.$auth.user().level != "guru") {
      app.$router.push({ name: "notfound" });
    }
    app.index();
  },
};
</script>