<?php

namespace Sentinel\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\NotIn;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Project extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($entry) {
            $entry->services->each(function ($service) {
                $service->delete();
            });
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @param string $type
     * @param array  $data
     *
     * @throws ValidationException
     *
     * @return Service
     */
    public function addService($type, $data)
    {
        $validator = Validator::make(['type' => $type], [
            'type' => [new NotIn($this->services->pluck('type')->toArray())],
        ], ['not_in' => 'the service type must be unique per project']);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
        $serviceType = app('services')->find($type);
        $serviceData = $serviceType->getDataModel()::create($data);

        return $serviceData->service()->create([
            'type'       => $type,
            'project_id' => $this->id,
        ]);
    }

    public function getService(string $type)
    {
        return $this->services->first(function ($service) use ($type) {
            return $service->type === $type;
        });
    }
}
