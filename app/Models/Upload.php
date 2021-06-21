<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_modified' => 'datetime:Y-m-d',
    ];

    public function upload_by_f()
    {
        return $this->belongsTo(User::class, 'upload_by', 'id');
    }

    public function import_by_f()
    {
        return $this->belongsTo(User::class, 'import_by', 'id');
    }



    public function empty_cells()
    {
        return $this->hasMany(EmptyCellLog::class);
    }

    public function empty_cells_sku_group()
    {
        return $this->hasMany(EmptyCellLog::class)->where('category', 'sku_group');
    }
    public function empty_cells_customer_item()
    {
        return $this->hasMany(EmptyCellLog::class)->where('category', 'customer_item');
    }

    public function import_duration()
    {
        if (is_null($this->import_start)) {
            return '';
        }
        $startTime = Carbon::parse($this->import_start);
        $endTime = Carbon::parse($this->import_end);

        $totalDuration =  $startTime->diff($endTime)->format('%I:%S') . " mins";


        return $totalDuration;
    }

    public function size()
    {
        $bytes = $this->size;
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
