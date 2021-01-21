<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = "categories";
	protected $primaryKey = "id";
	protected $fillable = ['name', 'icon_name','categories_id'];

	public function categories()
    {
        return $this->hasMany(Category::class,'categories_id','id');
    }

    public function childrenCategories()
{
    return $this->hasMany(Category::class,'categories_id','id')->with('categories');
}

}
