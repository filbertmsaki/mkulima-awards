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
    public function categories()
    {
        return $this->belongsToMany(AwardCategory::class, 'nominee_categories', 'nominee_id', 'category_id');
    }

    public function award_categories()
    {
        return $this->hasMany(NomineeCategory::class, 'nominee_id');
    }
    public function getCategoriesNameAttribute()
    {
        return $this->award_categories()->with('category')->get()->pluck('category.name')->implode(',');
    }
    public function getCategoriesIdsAttribute()
    {
        return $this->award_categories()->with('category')->get()->pluck('category.id')->toArray();
    }
}
