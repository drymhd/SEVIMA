<template>
<main>
    <div class="card-body">
        <paginate id="myTable" ref="myTable" classx="table table-bordered table-striped table-hover rounded" :columns="columns" url="/siswa/daftarkelas/index" :callback="callback" :useCard="true"></paginate>
        </div>

</main>
</template>

<script>


    export default {
        data() {
            return {
                columns: [
					{name: 'Nama Ruangan', data: 'nama_room'},
					{name: 'Aksi', data: 'action', style: 'width: 175px'}
				],

            }
        },
        methods: {

        },
        mounted() {
            
        }
    }
</script>