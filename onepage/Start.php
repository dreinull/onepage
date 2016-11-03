<?php
/**
 * Created by PhpStorm.
 * User: jasch
 * Date: 03.10.2016
 * Time: 14:05
 */

namespace Onepage;

use Onepage\Help;
use Illuminate\Database\Capsule\Manager as Capsule;

class Start {
    public function getThisPartyStarted() {
        // Everything important to boot is here
        $steps = [
            'defineConstants',
            'loadHelpers',
            'connectToDatabase',
            'checkForInstall',
        ];
        // Fires all of the functions and stops if FALSE is returned
        foreach ($steps as $step) {
            if($this->$step() === false) {
                die();
            }
        }       
    }
    
    public function defineConstants() {
        define('root_path', Help::createPath(__DIR__, '..'));
        define('config_path', Help::createPath(root_path, 'config'));
        define('database_path', Help::createPath(root_path, 'onepage', 'database'));
        define('template_path', Help::createPath(root_path, 'onepage', 'template'));
        define('database_file', database_path . DIRECTORY_SEPARATOR . 'database.sqlite');
        define('install_file', config_path . DIRECTORY_SEPARATOR . '.install');
        define('reset_file', config_path . DIRECTORY_SEPARATOR . '.reset');
        define('admin_template_path', Help::createPath(root_path, 'onepage', 'admin', 'templates'));
        define('helper_template_path', Help::createPath(root_path, 'onepage', 'view', 'helpers'));
        return true;
    }

    public function loadHelpers() {
        include __DIR__ . DIRECTORY_SEPARATOR . 'helpers.php';
    }

    public function connectToDatabase() {
        $settings = Help::getConfig('database');
        
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
            \Onepage\Installer::start();
            return false;
            
        }
    }

}