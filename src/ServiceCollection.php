<?php

namespace Sentinel\Services;

use Illuminate\Support\Collection;
use Sentinel\Services\Contracts\ServiceType;

class ServiceCollection extends Collection
{
    public function exists(string $key): bool
    {
        return (bool) $this->first(function (ServiceType $service) use ($key) {
            return $service->getKey() === $key;
        });
    }

    public function find(string $key)
    {
        return $this->first(function (ServiceType $service) use ($key) {
            return $service->getKey() === $key;
        });
    }

    public function getRulesFor(?string $key)
    {
        if (!$key) {
            return [];
        }

        $service = $this->first(function (ServiceType $service) use ($key) {
            return $service->getKey() === $key;
        });

        return $service ? $service->getRules() : [];
    }

    public function getInfo($key = null)
    {
        return $this->map(function (ServiceType $service) {
            return [
                'key'         => $service->getKey(),
                'name'        => $service->getName(),
                'description' => $service->getDescription(),
            ];
        });
    }

    public function getDetailedInfo(string $key)
    {
        /** @var ServiceType $service */
        $service = $this->find($key);

        return [
            'key'         => $service->getKey(),
            'name'        => $service->getName(),
            'description' => $service->getDescription(),
            'field_rules' => $service->getRules(),
            'endpoints'   => collect($service->getEndpoints())->keys(),
        ];
    }
}
