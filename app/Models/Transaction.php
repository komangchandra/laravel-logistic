<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    protected $with = ['unit', 'station'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    // ✅ Accessor untuk shift otomatis
    public function getShiftAttribute()
    {
        $hour = \Carbon\Carbon::parse($this->transaction_time)->format('H');

        return ($hour >= 6 && $hour < 18) ? 'Shift Siang' : 'Shift Malam';
    }

    // ✅ Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->transaction_date)->format('d/m/Y');
    }

    // ✅ Accessor untuk format waktu
    public function getFormattedTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->transaction_time)->format('H:i');
    }

    // ✅ Boot method untuk generate custom ID
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Jika primary key belum di-set, generate ID custom
            if (empty($model->{$model->getKeyName()})) {
                // Angka random 10 digit (bisa disesuaikan)
                $randomNumber = random_int(1000000000, 9999999999);

                $model->{$model->getKeyName()} = 'GPU-' . $randomNumber;
            }
        });
    }
}
