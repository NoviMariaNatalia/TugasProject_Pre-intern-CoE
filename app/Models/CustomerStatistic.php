<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
        'week_1',
        'week_2',
        'week_3',
        'total'
    ];

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total, 0, ',', '.');
    }
}