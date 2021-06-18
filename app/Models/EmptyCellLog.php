<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmptyCellLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function filex()
    {
        return $this->belongsTo(Upload::class);
    }

    public function test()
    {
        return 'test';
    }

    public function badge_class()
    {
        $num = rand(1, 8);
        if ($num == 1) {
            return 'bg-primary';
        } elseif ($num == 2) {
            return 'bg-secondary';
        } elseif ($num == 3) {
            return 'bg-success';
        } elseif ($num == 4) {
            return 'bg-danger';
        } elseif ($num == 5) {
            return 'bg-warning text-dark';
        } elseif ($num == 6) {
            return 'bg-info text-dark';
        } elseif ($num == 7) {
            return 'bg-light text-dark';
        } elseif ($num == 8) {
            return 'bg-dark';
        }

        return '';
    }
}
