<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'barcode', 'name', 'qty', 'min_qty', 'price', 'baseprice'];

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot(['price', 'qty'])->withTimestamps();
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function($query) use($search) {
            $query->where('barcode', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        });
    }
}
