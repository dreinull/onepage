<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.10.2016
 * Time: 14:05
 */

namespace Onepage\Boot;

use Illuminate\Database\Capsule\Manager as Capsule;

class Start {
    public function getThisPartyStarted() {
        // Everything important to boot is here
        $steps = [
            'loadHelpers',
            'defineConstants',
            'connectToDatabase',
            'checkForInstall',
            'loadSections',
        ];
        // Fires all of the functions and stops if FALSE is returned
        foreach ($steps as $step) {
            if($this->$step() === false) {
                die();
            }
        }       
    }
    
    public function loadHelpers() {
        include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'helpers.php';
    }

    public function defineConstants() {
        define('root_path', createPath(__DIR__, '..', '..'));
        define('onepage_path', createPath(root_path, 'onepage'));
        define('config_path', createPath(root_path, 'config'));
        define('database_path', createPath(onepage_path, 'database'));
        define('template_path', createPath(root_path, 'template'));
        define('section_path', createPath(template_path, 'sections'));
        define('database_file', createPath(database_path, 'database.sqlite'));
        define('install_file', createPath(config_path, '.install'));
        define('admin_template_path', createPath(template_path, 'admin'));
        define('component_path', createPath(root_path, 'components'));
        define('app_style', createPath(component_path, 'css', 'main.css'));
        define('home_url', str_replace('index.php', '', $_SERVER['PHP_SELF']));
        return true;
    }

    public function connectToDatabase() {
        $settings = getConfig('database');
        
        $capsule = new Capsule;
        $capsule->addConnection($settings);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        //$results = Capsule::select('select * from users where id = ?', array(1));
        return true;
    }
    
    public function checkForInstall() {
        if(file_exists(install_file)) {
            echo 'Installation';
            Installer::start();
            return false;
            
        }
    }

    public function loadSections() {

    }

}