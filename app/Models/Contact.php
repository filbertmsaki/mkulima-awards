<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'subject',
        'message',
        'agent',
        'ip',
        'status',
        'seen',
    ];
    public $incrementing = false;
    protected $casts = [
        'status' => StatusEnum::class,
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
