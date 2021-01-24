<?php

namespace App\Modules;

use \Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

    /**
     * Will make sure that the required modules have been fully loaded
     * @return void
     */
    public function boot() {
        // For each of the registered modules, include their routes and Views
        $modules = config("module.modules");

        foreach($modules as $module) {

            // Load the routes api for each of the modules
            if (file_exists(__DIR__ . '/' . $module . '/Routes/api.php')) {
                $this->loadRoutesFrom(__DIR__ . '/' . $module . '/Routes/api.php');
            }
            // Load the routes api for each of the modules
            if (file_exists(__DIR__ . '/' . $module . '/Routes/ws.php')) {
                $this->loadRoutesFrom(__DIR__ . '/' . $module . '/Routes/ws.php');
            }

            // Load the views
            if (is_dir(__DIR__ . '/' . $module . '/Views')) {
                $this->loadViewsFrom(__DIR__ . '/' . $module . '/Views', $module);
            }
        }
    }

    public function register() {

    }

}
