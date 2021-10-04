<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;

    public $timestamps=false;

    protected $fillable = [
        'name','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function listContent()
    {
        return $this->hasMany(ListContent::class);
    }

}
