<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class AwardCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'description',
        'created_by',
    ];
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->slug = unique_slug($model->name);
            $model->name = capitalize($model->name);
            $model->created_by = $model->created_by ?? auth()->user()->id;
        });
        static::updating(function ($model) {
            $model->slug = unique_slug($model->name);
            $model->name = capitalize($model->name);
        });
    }
}
