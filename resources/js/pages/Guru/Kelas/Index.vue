<template>
    <main class="container">

          <div class="card">
  <h5 class="card-header">Tambah Kelas Mapel</h5>
  <div class="card-body">
   <form autocomplete="off">
                <div class="form-check" v-for="data in datamapel">
  <input class="form-check-input" @change="klikmapel(form.id, data.id)" :checked="form.guru_kelas.find(e => e.id == data.id) == undefined ? false : true" type="checkbox" :value="data.id" id="flexCheckDefault" />
  <label class="form-check-label" for="flexCheckDefault">{{data.nama_kelas}}</label>
</div>
            </form>
            <button class="btn btn-md btn-block btn-danger" @click.prevent="$router.push({name: 'redirect'})">tutup</button>
  </div>
</div>
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
                    guru_kelas: []
                }
            }
        },
        methods: {

        },
        mounted() {
            this.index();
        },
       methods: {
        index(){
          var app = this;

            app.$http.get('guru/kelas/index').then((res) => {
                app.form = res.data.data;
            }).catch((err) => {
                Swal.fire('Error');
            })
            app.$http.get('guru/kelas/indexkelas').then((res) => {
                app.datamapel = res.data.data;
            }).catch((err) => {
                Swal.fire('Error');
            })
        },
        klikmapel(kelas_id, mapel_id){
            var app = this;
            app.$http.get('guru/kelas/klik/'+kelas_id+"/"+mapel_id).then((res) => {
                if(res.data){
                    toastr.success('sukses menambah mapel', 'sukses')
                } else {
                    toastr.error('sukses menghapus mapel', 'sukses')
                }
            })
        },
       }
    }
</script>