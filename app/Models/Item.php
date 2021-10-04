<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = [
        'name', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function list_content()
    {
        return $this->hasMany(ListContent::class);
    }
}
