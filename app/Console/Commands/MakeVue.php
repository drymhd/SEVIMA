<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeVue extends Command
{
    protected $signature = 'make:vue {file : Lokasi view yang akan dibuat}';

    protected $description = 'Untuk membuat view dengan php artisan';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    public function handle()
    {
        if(is_file(app_path().'/../resources/js/pages/'.$this->argument('file').'.vue')){
            return $this->error("File sudah ada!");
        }
        $this->info("Membuat Vue JS File ...");

       
            $script = "<template>
</template>

<script>


    export default {
        data() {
            return {
                
            }
        },
        methods: {

        },
        mounted() {
            
        }
    }
</script>";

        


        $path = explode('/', app_path().'/../resources/js/pages/'.$this->argument('file').'.vue');

        array_pop($path);

        $path = implode('/', $path);

        $filename = app_path().'/../resources/js/pages/'.$this->argument('file').'.vue';

        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        file_put_contents($filename, $script);

        return $this->info("Berhasil!");
    }

}
