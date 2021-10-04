<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListContent extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = [
        'product_list_id','product_id'
    ];

    public function productList()
    {
        return $this->belongsTo(ProductList::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
