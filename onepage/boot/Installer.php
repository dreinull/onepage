<?php

namespace Onepage\Boot;

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
            ->createOptions()
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
        
        if(!$this->schema->hasTable('sections')) {
            $this->schema->create('sections', function($table) {
                $table->increments('id');
                $table->integer('page_id');
                $table->boolean('visible');
                $table->tinyInteger('order')->unsigned();
                $table->string('template');
                $table->string('name');
                $table->timestamps();
            });
            echo 'Section-Tabelle erstellt.';
        } else {
            echo 'Section-Tabelle bereits vorhanden';
        }
        
        if(!$this->schema->hasTable('pages')) {
            $this->schema->create('pages', function($table) {
                $table->increments('id');
                $table->integer('parent_id')->nullable();
                $table->boolean('visible');
                $table->tinyInteger('order')->unsigned()->nullable();
                $table->boolean('default');
                $table->string('name');
                $table->string('slug');
                $table->timestamps();
            });
            echo 'Page-Tabelle erstellt.';
        } else {
            echo 'Page-Tabelle bereits vorhanden';
        }
        
        if(!$this->schema->hasTable('contents_string')) {
            $this->schema->create('contents_string', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Strings erstellt.';
        } else {
            echo 'Content-Tabelle für Strings bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_text')) {
            $this->schema->create('contents_text', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->text('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Texte erstellt.';
        } else {
            echo 'Content-Tabelle für Texte bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_date')) {
            $this->schema->create('contents_date', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->date('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Dates erstellt.';
        } else {
            echo 'Content-Tabelle für Dates bereits vorhanden';
        }
        
        if(!$this->schema->hasTable('contents_timestamp')) {
            $this->schema->create('contents_timestamp', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->timestamp('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Timestamps erstellt.';
        } else {
            echo 'Content-Tabelle für Timpestamps bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_integer')) {
            $this->schema->create('contents_integer', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->integer('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Integer erstellt.';
        } else {
            echo 'Content-Tabelle für Integer bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_float')) {
            $this->schema->create('contents_float', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->float('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Float erstellt.';
        } else {
            echo 'Content-Tabelle für Float bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_boolean')) {
            $this->schema->create('contents_boolean', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->boolean('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Boolean erstellt.';
        } else {
            echo 'Content-Tabelle für Boolean bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_image')) {
            $this->schema->create('contents_image', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Bilder erstellt.';
        } else {
            echo 'Content-Tabelle für Bilder bereits vorhanden';
        }

        if(!$this->schema->hasTable('contents_file')) {
            $this->schema->create('contents_file', function($table) {
                $table->increments('id');
                $table->integer('section_id')->unsigned();
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
            echo 'Content-Tabelle für Downloads erstellt.';
        } else {
            echo 'Content-Tabelle für Downloads bereits vorhanden';
        }

        if(!$this->schema->hasTable('images')) {
            $this->schema->create('images', function($table) {
                $table->increments('id');
                $table->string('filename');
                $table->string('title')->nullable();
                $table->string('alt')->nullable();
                $table->timestamps();
            });
            echo 'Bilder-Tabelle erstellt.';
        } else {
            echo 'Bilder-Tabelle bereits vorhanden';
        }

        if(!$this->schema->hasTable('options')) {
            $this->schema->create('options', function($table) {
                $table->increments('id');
                $table->string('key');
                $table->string('value');
                $table->timestamps();
            });
            echo 'Options-Tabelle für Boolean erstellt.';
        } else {
            echo 'Options-Tabelle für Boolean bereits vorhanden';
        }

        if(!$this->schema->hasTable('users')) {
            $this->schema->create('users', function($table) {
                $table->increments('ID');
                $table->string('Username');
                $table->string('Password');
                $table->string('Email');
                $table->boolean('Activated')->default(0);
                $table->string('Confirmation')->default('');
                $table->integer('RegDate');
                $table->integer('LastLogin')->default(0);
                $table->integer('GroupID')->default(1);
                
            });
            echo 'Benutzer-Tabelle erstellt';
        } else {
            echo 'Benutzer-Tabelle wurde bereits erstellt.';
        }

        return $this;
    }

    public function createOptions() {
        Capsule::table('options')->insert([
            'key' => 'homeUrl',
            'value' => 'homeUrl',
        ]);
        return $this;
    }
    
    public function createUser() {
        Capsule::table('users')->insert([
            'Username' => 'jascha',
            'Password' => 'ca87eecfadce09b01a716ff621d11b1655eeac60',
            'email' => 'jascha.gerles@gmail.com',
            'activated' => 1,
            'GroupID' => 1,
            'RegDate' => '1480011917',
        ]);
        return $this;
    }
    
    public function createDefaultContent() {
        Capsule::table('pages')->insert([
            'visible' => 1,
            'default' => 1,
            'name' => 'Start',
            'slug' => 'start'
        ]);
        Capsule::table('sections')->insert([
            'page_id' => 1,
            'order' => 1,
            'visible' => 1,
            'template' => 'example',
            'name' => 'Bereich 1',
        ]);
        Capsule::table('contents_string')->insert([
            'section_id' => '1',
            'key' => 'head',
            'value' => 'Meine Überschrift',
        ]);
        Capsule::table('contents_text')->insert([
            'section_id' => '1',
            'key' => 'body',
            'value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nec ullamcorper sapien. Sed et nulla mattis, facilisis enim eu, fermentum neque. Vestibulum non odio vestibulum, aliquet ligula at, sagittis tellus. Aliquam lacus erat, eleifend in justo ut, feugiat aliquam purus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris nec tortor laoreet, interdum quam vitae, vestibulum purus. Vivamus erat dolor, sagittis condimentum metus a, commodo vehicula tellus. Donec venenatis, nunc id commodo bibendum, quam ligula scelerisque massa, eget mollis quam nisi nec mi. Sed eu elit aliquam, pharetra purus vel, lacinia ex.',
        ]);
        return $this;
    }
    
    public function deleteInstallFile() {
        if(file_exists(install_file)) {
            unlink(install_file);
        }
    }
}