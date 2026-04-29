<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'price',
        'currency',
        'language',
        'format',
        'pages',
        'isbn',
        'publication_year',
        'stock',
        'status',
        'inventory_value',
        'image_filename',
        'description',
    ];

    /**
     * @return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Cover image URL: local file from catalog if present, else Open Library by ISBN, else placeholder.
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->image_filename !== null && $this->image_filename !== '') {
            $local = public_path('images/books/'.$this->image_filename);
            if (is_file($local)) {
                return asset('images/books/'.$this->image_filename);
            }
        }
        $digits = preg_replace('/\D/', '', $this->isbn ?? '');
        if (strlen($digits) >= 10) {
            return 'https://covers.openlibrary.org/b/isbn/'.$digits.'-M.jpg?default=false';
        }
        return asset('images/books/placeholder.svg');
    }

    /**
     * Format price in colones for display.
     */
    public function getFormattedPriceAttribute(): string
    {
        $amount = number_format($this->price, 0, ',', ' ');
        return $this->currency === 'CRC' ? '₡ '.$amount : $amount.' '.$this->currency;
    }
}
