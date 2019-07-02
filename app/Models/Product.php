<?php

namespace App\Models;

use function GuzzleHttp\Psr7\str;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Product extends Model implements HasMedia
{
    //use media
    use HasMediaTrait;

    protected $guarded=[];


//    static slug data include create
protected static function boot()
{
 parent::boot();

 static::creating(function ($product){
     $product->slug=str_slug($product->title);
 });
}


    public function category():\Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class);
    }
}
