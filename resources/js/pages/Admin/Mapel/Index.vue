<template>
    <main class="container">

      <div class="card" v-if="show">
  <h5 class="card-header">Tambah Mata Pelajaran</h5>
  <div class="card-body">
   <form autocomplete="off" @submit.prevent="tambah">
                <div class="form-group">
                    <label for="name">Nama Mapel</label>
                    <input type="text" id="name" class="form-control" placeholder="Nama Mapel" required v-model="form.nama_mapel">
                </div>
                <br>
                <button type="submit" class="btn btn-primary" >{{type}}</button> <button type="button" class="btn btn-danger" @click.prevent="show = false" >Batal</button>
            </form>
  </div>
</div>

<button class="btn btn-primary btn-lg" @click.prevent="show = true; type = 'tambah'" v-if="!show">Tambah</button>

<div class="card-body">
        <paginate id="myTable" ref="myTable" classx="table table-bordered table-striped table-hover rounded" :columns="columns" url="/admin/mapel/index" :callback="callback" :useCard="true"></paginate>
        </div>
    </main>

</template>

<script>



    export default {
        data() {
            return {
              type: 'tambah',
              show: false,
                datamapel: [],
                columns: [
					{name: 'Nama Kelas', data: 'nama_mapel'},
					{name: 'Aksi', data: 'action', style: 'width: 175px'}
				],
                form: {}
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
            app.$http.post('admin/mapel/edit', {data: app.form}).then((res) => {
              toastr.success('sukses megedit data', 'sukses');
              app.index();
                          app.show = false;
                          app.form = {}
            }).catch((err) => {
              toastr.error('gagal mengedit data', 'gagal');
            });
          } else 
          app.$http.post('admin/mapel/tambah', {data: app.form}).then((res) => {
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

          app.$refs.myTable.reload();
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
          app.$http.get('admin/mapel/get/'+id).then((res) => {
            app.form = res.data.data;
          }).catch((err) => {
            toastr.error('sesuatu error terjadi', 'error');
          })
        },
        hapus(id){
          var app = this;
          app.$http.get("admin/mapel/hapus/"+id).then((res) => {
            toastr.success('sukses menghapus data', 'sukses');
            app.index();

          }).catch((err) => {
            toastr.success('sukses menghapus data', 'sukses');
          })
        }
       }
    }
</script>