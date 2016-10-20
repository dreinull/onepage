<?php

namespace Onepage;

use Illuminate\Database\Capsule\Manager as Capsule;

class Installer {
    
    private $schema;
    
    private function __construct() {
        $this->schema = Capsule::schema();
    }
    
    public static function start() {
        $installer = new Installer();
        $installer
            ->resetDatabase()
            ->installTables()
            ->createUser()
            ->createDefaultContent()
            ->deleteInstallFile();
        echo 'Installation abgeschlossen';
        
    }

    public function resetDatabase() {
        file_put_contents(database_file, '');
        return $this;
    }
    
    public function installTables() {
        if(!$this->schema->hasTable('users')) {
            $this->schema->create('users', function($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->timestamps();
            });
            echo 'Benutzer-Tabelle erstellt.';
        } else {
            echo 'Benutzer-Tabelle bereits vorhanden';
        }
        
        if(!$this->schema->hasTable('sections')) {
            $this->schema->create('sections', function($table) {
                $table->increments('id');
                $table->integer('page_id')->nullable();
                $table->boolean('visible');
                $table->tinyInteger('order')->unsigned();
                $table->string('template');
                $table->string('name');
                $table->string('head')->nullable();
                $table->text('body')->nullable();
                $table->timestamps();
            });
            echo 'Section-Tabelle erstellt.';
        } else {
            echo 'Section-Tabelle bereits vorhanden';
        }
        
        if(!$this->schema->hasTable('contents')) {
            $this->schema->create('contents', function($table) {
                $table->increments('id');
                $table->integer('section_id');
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle erstellt.';
        } else {
            echo 'Content-Tabelle bereits vorhanden';
        }
        return $this;
    }
    
    public function createUser() {
        Capsule::table('users')->insert([
            'email' => 'jascha.gerles@gmail.com'
        ]);
        return $this;
    }
    
    public function createDefaultContent() {
        Capsule::table('sections')->insert([
            'order' => '1',
            'visible' => 1,
            'template' => 'example',
            'name' => 'Bereich 1',
            'head' => 'Eine erste Überschrift',
            'body' => 'Ein schöner Inhalt. Er gefällt mir sehr.',
        ]);
        Capsule::table('contents')->insert([
            'section_id' => '1',
            'key' => 'Datum',
            'value' => '03.10.2016',
        ]);
        return $this;
    }
    
    public function deleteInstallFile() {
        if(file_exists(install_file)) {
            unlink(install_file);
        }
    }
}