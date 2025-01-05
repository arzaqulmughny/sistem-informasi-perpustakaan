<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get member details
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }
}
