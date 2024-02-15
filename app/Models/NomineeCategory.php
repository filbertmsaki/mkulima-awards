<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class NomineeCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id', 'nominee_id', 'year'
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
    public function category()
    {
        return $this->belongsTo(AwardCategory::class, 'category_id');
    }
    public function nominee()
    {
        return $this->belongsTo(Nominee::class, 'nominee_id');
    }
}
