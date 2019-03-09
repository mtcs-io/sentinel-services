<?php

namespace Sentinel\Services\Models;

use Illuminate\Database\Eloquent\Model;

abstract class DataModel extends Model
{
    protected $guarded = [];

    public function service()
    {
        return $this->morphOne(Service::class, 'data');
    }
}
