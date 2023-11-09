<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Observers\ProjectObserver;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected static function boot()
    {
        parent::boot();

        static::observe(ProjectObserver::class);
    }
}