<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Vote extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent',
        'nominee_id',
        'category_id',
    ];
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
        static::updating(function ($model) {
        });
    }

    public function category()  {
        return $this->belongsTo(AwardCategory::class,'category_id');
    }
    public function nominee()  {
        return $this->belongsTo(Nominee::class,'nominee_id');
    }
}
