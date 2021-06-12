<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SPASetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'createSPAENV';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'set up for creating SPA using laravel-ui, Vue and Vue Router';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Setting up of the SPA development environment has begun.');
        // install the enviroment for creating SPA

        exec('composer require laravel/ui'); 
        exec('php artisan ui vue');
        exec('npm install && npm install vue-router');

        $file = 'resources\js\\router.js';
        $data = 'import Vue from "vue";
import VueRouter from "vue-router";
         
Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: []
});

export default router;';

        //creating router.js for Vue router
        try{
            file_put_contents($file, $data);
        }catch(\Exception $e){
            $this->info($e->getMessage());
        }


        $file = 'routes\\web.php';
        $data = '<?php

use Illuminate\Support\Facades\Route;
        
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
        
Route::get("{any}", function () {
    return view("index");
})->where("any", ".*");';

        //set up web.php for SPA 
        try{
            file_put_contents($file, $data);
        }catch(\Exception $e){
            $this->info($e->getMessage());
        }

        $file = 'resources\js\\app.js';
        $data = 'require("./bootstrap");

window.Vue = require("vue");
         
import Vue from "vue";
import router from "./router";
         
const app = new Vue({
    el: "#app",
    router: router
});';
        //set up app.js for SPA
        try{
            file_put_contents($file, $data);
        }catch(\Exception $e){
            $this->info($e->getMessage());
        }

       
        $file = 'webpack.mix.js';
        $data = 'const mix = require("laravel-mix");

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
*/

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/router.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [
         //
    ]);';
        //set up webpack.mix js
        try{
            file_put_contents($file, $data);
        }catch(\Exception $e){
            $this->info($e->getMessage());
        }

        $this->info('Setting up the SPA development environment was successful ');
    }
}
