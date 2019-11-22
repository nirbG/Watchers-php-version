<?php

namespace watchers\models;
/**
 * Created by PhpStorm.
 * User: User
 * Date: 13/11/2017
 * Time: 12:53
 */
class Note extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'note';
    protected $primaryKey = 'idUser,ISBN';
    public $timestamps = false;


    function moy($isbn){
        $note=Note::where("ISBN","=",$isbn)->avg('note');
        if($note==null){
            $note=0;
        }
        return $note;
    }

    function countNote($isbn){
        $cnt=Note::where("ISBN","=",$isbn)->count();
        if($cnt==null){
            $cnt=0;
        }
        return $cnt;
    }
}