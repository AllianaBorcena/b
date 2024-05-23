<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
//**Make relationship so we just don't call the product ID */
    function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    function productImages(): HasMany{
        return $this->hasMany(ProductGallery::class);
    }

    function productIcing(): HasMany{
        return $this->hasMany(ProductIcing::class);
    }

    function productOption():HasMany{
        return $this->hasMany(ProductOption::class);
    }




}
