<template>
    <main class="container">

      <div class="card" v-if="show">
  <h5 class="card-header">Tambah Guru</h5>
  <div class="card-body">
   <form autocomplete="off" @submit.prevent="tambah">
                <div class="form-group">
                    <label for="name">Nama Panjang</label>
                    <input type="text" id="name" class="form-control" placeholder="Nama" required v-model="form.name">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="email" id="name" class="form-control" placeholder="Email" required v-model="form.email">
                </div>
                <div class="form-group" v-if="type == 'tambah'">
                    <label for="name">Password</label>
                    <input type="password" id="name" class="form-control" placeholder="" required v-model="form.password">
                </div>
                    <div class="form-group col-md-4">
      <label for="inputState">Kelas</label>
      <select id="inputState" class="form-control" v-model="form.mapel_id">
        <option v-for="data in datakelas" :value="data.id">{{data.nama_mapel}}</option>
      </select>
    </div>

                <div class="form-group">
                    <label for="name">nip</label>
                    <input type="text" id="name" class="form-control" placeholder="nip" oninput="this.value = this.value.replace(/\D/g, '')" required v-model="form.nip">
                </div>
                <div class="form-group">
                    <label for="name">Alamat</label>
                    <input type="text" id="name" class="form-control" placeholder="Alamat" required v-model="form.alamat">
                </div>
                <div class="form-group">
                    <label for="name">Deskripsi</label>
  <textarea class="form-control" aria-label="With textarea" v-model="form.deskripsi"></textarea>
</div>
                <br>
                <button type="submit" class="btn btn-primary" >{{type}}</button> <button type="button" class="btn btn-danger" @click.prevent="show = false" >Batal</button>
            </form>
  </div>
</div>

<button class="btn btn-primary btn-lg" @click.prevent="show = true; type = 'tambah'" v-if="!show">Tambah</button>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nama Guru</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody v-if="datasiswa.length != 0">
    <tr v-for="data in datasiswa">
      <td style="width: 35%">{{data.name}}</td>
      <td style="width: 35%">{{data.email}}</td>
      <td v-html="data.action"></td>
    </tr>
  </tbody>
  <tbody v-else>
    <td colspan="2" class="text-center">Tidak ada data</td>
  </tbody>
</table>
    </main>

</template>

<style>
.form-group{
    margin-top: 10px;
}
</style>

<script>



    export default {
        data() {
            return {
              type: 'tambah',
              show: false,
                datasiswa: [],
                datakelas: [],
                form: {}
            }
        },
        methods: {

        },
        mounted() {
            this.index();
            this.loadtable();
        },
       methods: {
         tambah(){
          var app = this;
          if(app.type != 'tambah'){
            app.$http.post('admin/guru/edit', {data: app.form}).then((res) => {
              toastr.success('sukses megedit data', 'sukses');
              app.index();
                          app.show = false;
                          app.form = {}
            }).catch((err) => {
              toastr.error('gagal mengedit data', 'gagal');
            });
          } else 
          app.$http.post('admin/guru/tambah', {data: app.form}).then((res) => {
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

            app.$http.get('admin/guru/index').then((res) => {
                app.datasiswa = res.data.data;
            }).catch((err) => {
                Swal.fire('Error');
            })

            app.$http.get('admin/guru/indexkelas').then((res) => {
                app.datakelas = res.data.data;
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
          app.$http.get('admin/guru/get/'+id).then((res) => {
            app.form = res.data.data;
          }).catch((err) => {
            toastr.error('sesuatu error terjadi', 'error');
          })
        },
        hapus(id){
          var app = this;
          app.$http.get("admin/guru/hapus/"+id).then((res) => {
            toastr.success('sukses menghapus data', 'sukses');
            app.index();

          }).catch((err) => {
            toastr.success('sukses menghapus data', 'sukses');
          })
        }
       }
    }
</script>