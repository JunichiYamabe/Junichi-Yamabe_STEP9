<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['company_name', 'product_id', 'sale_id'];
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'company_id');
    }
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'company_id');
    }
}
