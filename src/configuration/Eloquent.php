<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace configuration;

use Illuminate\Database\Capsule\Manager as DB;

/**
 * Description of Eloquent
 *
 * @author root
 */
class Eloquent {
    
    public static function init($file){
        $db = new DB();
        $db->addConnection(parse_ini_file($file));
        $db->setAsGlobal();
        $db->bootEloquent();
    }
}
