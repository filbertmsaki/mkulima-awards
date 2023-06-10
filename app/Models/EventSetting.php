<?php

namespace App\Models;

use App\Enums\EventStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class EventSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'value','status','start_date','end_date'
    ];
    public $incrementing = false;

    protected $casts = [
        'status' => EventStatusEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();

        });
        static::updating(function ($model) {

        });
    }
}
