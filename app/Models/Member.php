<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Define unfillable columns
    protected $guarded = ['id'];

    /**
     * Check is user already visited
     */
    public function getHasVisitedAttribute()
    {
        return Visit::where('member_id', $this->id)->whereDate('created_at', now()->toDateString())
            ->exists();
    }
}
