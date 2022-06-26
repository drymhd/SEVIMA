<template>
    <main class="container">

          <div class="card" v-if="show">
  <h5 class="card-header">Tambah Kelas Mapel</h5>
  <div class="card-body">
   <form autocomplete="off">
                <div class="form-check" v-for="data in datamapel">
  <input class="form-check-input" @change="klikmapel(form.id, data.id)" :checked="form.kelasmapel.find(e => e.id == data.id) == undefined ? false : true" type="checkbox" :value="data.id" id="flexCheckDefault" />
  <label class="form-check-label" for="flexCheckDefault">{{data.nama_mapel}}</label>
</div>
            </form>
            <button class="btn btn-md btn-block btn-danger" @click.prevent="show = false; form = {kelasmapel : []}">tutup</button>
  </div>
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nama Kelas</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody v-if="datakelas.length != 0">
    <tr v-for="data in datakelas">
      <td style="width: 70%">{{data.nama_kelas}}</td>
      <td v-html="data.action"></td>
    </tr>
  </tbody>
  <tbody v-else>
    <td colspan="2" class="text-center">Tidak ada data</td>
  </tbody>
</table>
    </main>

</template>

<script>



    export default {
        data() {
            return {
              type: 'tambah',
              show: false,
                datakelas: [],
                datamapel: [],
                form: {
                    kelasmapel: []
                }
            }
        },
        methods: {

        },
        mounted() {
          var app = this;
    if (app.$auth.user().level != "admin") {
      app.$router.push({ name: "notfound" });
    }

            this.index();
            this.loadtable();
        },
       methods: {
         tambah(){
          var app = this;
          if(app.type != 'tambah'){
            app.$http.post('admin/kelasmapel/edit', {data: app.form}).then((res) => {
              toastr.success('sukses megedit data', 'sukses');
              app.index();
                          app.show = false;
                          app.form = {}
            }).catch((err) => {
              toastr.error('gagal mengedit data', 'gagal');
            });
          } else 
          app.$http.post('admin/kelasmapel/tambah', {data: app.form}).then((res) => {
            toastr.success('sukses menambah data', 'sukses');
            app.index();
                        app.show = false;
                        app.form = {}
          }).catch((err) => {
            toastr.error('gagal menambah data', 'gagal');
          });
         
        },
        index(){
          var app = this;

            app.$http.get('admin/kelasmapel/index').then((res) => {
                app.datakelas = res.data.data;
            }).catch((err) => {
                Swal.fire('Error');
            })
            app.$http.get('admin/kelasmapel/indexmapel').then((res) => {
                app.datamapel = res.data.data;
            }).catch((err) => {
                Swal.fire('Error');
            })
        },
        loadtable(){
          var app = this;
          $('table').on('click', '.hapus', function(e){
            var id = $(this).data('id');
            app.hapus(id);
          });
          $('table').on('click', '.edit', function(e){
            var id = $(this).data('id');
            app.edit(id);
          });
        },
        edit(id){
          var app = this;
          app.show = true;
          app.type = 'edit';
          app.$http.get('admin/kelasmapel/get/'+id).then((res) => {
            app.form = res.data.data;
          }).catch((err) => {
            toastr.error('sesuatu error terjadi', 'error');
          })
        },
        klikmapel(kelas_id, mapel_id){
            var app = this;
            app.$http.get('admin/kelasmapel/klik/'+kelas_id+"/"+mapel_id).then((res) => {
                if(res.data){
                    toastr.success('sukses menambah mapel', 'sukses')
                } else {
                    toastr.error('sukses menghapus mapel', 'sukses')
                }
            })
        },
        hapus(id){
          var app = this;
          app.$http.get("admin/kelasmapel/hapus/"+id).then((res) => {
            toastr.success('sukses menghapus data', 'sukses');
            app.index();

          }).catch((err) => {
            toastr.success('sukses menghapus data', 'sukses');
          })
        },
       }
    }
</script>