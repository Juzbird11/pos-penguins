<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['customer', 'invoice_no', 'total'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['qty', 'price'])->withTimestamps();
    }

    public function serviceFees()
    {
        return $this->hasMany(ServiceFee::class);
    }

    public function scopeDate($query, $date)
    {
        $date = $date ? Carbon::parse($date) : now();
        return $query->whereDate('updated_at', $date);
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('updated_at', [ now()->startOfWeek(), now()->endOfWeek()]);
    }
}
