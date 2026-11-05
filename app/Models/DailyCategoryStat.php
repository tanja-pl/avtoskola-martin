<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyCategoryStat extends Model
{
    protected $fillable = [
        'visited_on',
        'category',
        'visits',
    ];

    protected function casts(): array
    {
        return [
            'visited_on' => 'date:Y-m-d',
            'visits' => 'integer',
        ];
    }
}
