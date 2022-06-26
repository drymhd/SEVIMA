<template>
  <main>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">{{datatugas.nama_tugas}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="white-space: pre-line">
        {{datatugas.isi_tugas}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="container" >
      <h1>Materi</h1>
      <div class="card">
        <h5 class="card-header">{{ data.nama_materi }}</h5>
        <div class="card-body">
          <h5 class="card-title">Isi Materi</h5>
          <p class="card-text" style="white-space: pre-line">
            {{ data.isi_materi }}
          </p>
          <button
        type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            v-if="data.tugas != null"
            class="btn btn-primary"
            @click.prevent="getdetail(data.tugas.id)"
            >lihat tugas</button
          >
          <a
            href="javascript:void(0);"
            v-if="data.tugas != null && data.jawaban.find(e => e.siswa_id == $auth.user().id) == undefined"
            class="btn btn-primary"
            @click.prevent="show = true; form = {}"
            >Jawab Tugas</a
          >
          <a
            href="javascript:void(0);"
            v-if="data.tugas != null && data.jawaban.find(e => e.siswa_id == $auth.user().id) != undefined"
            class="btn btn-primary"
            @click.prevent="show = true; type = 'edit'; form = data.jawaban[data.jawaban.findIndex(e => e.siswa_id == $auth.user().id)]"
            >Edit Tugas</a
          >
        </div>
      </div>
      <div class="card" v-if="show">
        <h5 class="card-header">Jawab Tugas</h5>
        <div class="card-body">
          <form autocomplete="off" @submit.prevent="tambah">
            <div class="form-group">
              <label for="name">Isi Jawaban</label>
              <textarea
                class="form-control"
                aria-label="With textarea"
                v-model="form.isi_jawaban"
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
</div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      form: {},
      type: "tambah",
      show: false,
      data: { jawaban: []},
      datatugas: {}
    };
  },
  methods: {
    index() {
      var app = this;
      var id = app.$route.params.id;

      app.$http.get("guru/materi/index/" + id).then((res) => {
          app.data = res.data.data;
      });
    },
    getdetail(id){
        var app = this;
        
        app.$http.get('guru/materi/tugas/'+id).then((res) => {
            app.datatugas = res.data.data;
        })

    },
    tambah(){
        var app = this;
        var id = app.$route.params.id;

if(app.type == 'tambah'){
    app.$http.post("siswa/materi/jawabtugas/" + id, {data: app.form}).then((res) => {
        app.index();
            app.show = false;
            app.form = {};
        }).catch((err) => {
            toastr.error('error sesuatu error terjadi', 'error')
        });
            } else {
                app.$http.post("siswa/materi/edittugas", {data: app.form}).then((res) => {
                    app.index();
                        app.show = false;
                        app.form = {};
                    }).catch((err) => {
                        toastr.error('error sesuatu error terjadi', 'error')
                    });

            }

    }
  },
  mounted() {
    var app = this;
    app.index();
  },
};
</script>