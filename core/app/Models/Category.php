<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Category extends Model
    {
        public $timestamps = false;
        protected $fillable = ['name', 'slug', 'photo', 'status', 'is_feature', 'meta_keywords', 'meta_descriptions', 'serial'];

        public function items()
        {
//            return $this->hasMany(Item::class)->take(5);
            return $this->hasMany(Item::class, 'category_id', 'id');
        }

        public function subcategory()
        {
            return $this->hasMany('App\Models\Subcategory');
        }

    }
