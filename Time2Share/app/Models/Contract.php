<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'lender_id',
        'borrower_id',
        'start_date',
        'end_date',
        'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    public function borrower()
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }
}
