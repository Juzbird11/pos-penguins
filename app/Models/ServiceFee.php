<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFee extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['description', 'fees'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
