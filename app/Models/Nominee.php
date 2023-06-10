<?php

namespace App\Models;

use App\Enums\EntryEnum;
use App\Enums\VerifiedEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Nominee extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'entry',
        'service_name',
        'company_phone',
        'company_email',
        'contact_person_name',
        'contact_person_phone',
        'contact_person_email',
        'address',
        'description',
        'verified'
    ];
    public $incrementing = false;
    protected $casts = [
        'entry' => EntryEnum::class,
        'verified' => VerifiedEnum::class,
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
            $model->service_name = capitalize($model->service_name);
            $model->contact_person_name = capitalize($model->contact_person_name);
            $model->address = capitalize($model->address);
            $model->description = capitalize($model->description);
        });
        static::updating(function ($model) {
            $model->service_name = capitalize($model->service_name);
            $model->contact_person_name = capitalize($model->contact_person_name);
            $model->address = capitalize($model->address);
            $model->description = capitalize($model->description);
        });
    }
    public function category()
    {
        return $this->belongsTo(AwardCategory::class, 'category_id');
    }
}
