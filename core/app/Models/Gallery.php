<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Gallery extends Model
    {
        public $timestamps = false;
        protected $fillable = ['item_id', 'photo'];


    }
