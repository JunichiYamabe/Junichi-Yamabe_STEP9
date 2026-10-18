<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'phone', 'email', 'website'];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'company_id');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'company_id');
    }
}
