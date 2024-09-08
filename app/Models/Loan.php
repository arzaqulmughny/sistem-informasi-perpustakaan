<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Loan extends Model
{
    use HasFactory;

    // Define unfillable columns
    protected $guarded = ['id'];

    /**
     * Define hasOne relationship for book copy
     */
    public function copy(): HasOne
    {
        return $this->hasOne(BookCopy::class, 'id', 'copy_id');
    }

    /**
     * Define hasOneTrough relationship for book
     */
    public function book(): HasOneThrough
    {
        return $this->hasOneThrough(Book::class, BookCopy::class, 'id', 'id', 'copy_id', 'book_id');
    }
}
