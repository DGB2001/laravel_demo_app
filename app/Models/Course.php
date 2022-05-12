<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => date('d/m/Y H:i:s', strtotime($attributes['created_at'])).' ('.Carbon::parse($attributes['created_at'])->diffForHumans().')',
        );
    }
}
