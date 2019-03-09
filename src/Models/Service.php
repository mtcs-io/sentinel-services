<?php

namespace Sentinel\Services\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function data()
    {
        return $this->morphTo();
    }
}
