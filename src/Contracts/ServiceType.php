<?php

namespace Sentinel\Services\Contracts;

interface ServiceType
{
    /**
     * the key should be lowercase and without spaces.
     *
     * @return string
     */
    public function getKey(): string;

    /**
     * the display name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * the description of the service.
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * the corresponding data model for the service.
     *
     * @return string
     */
    public function getDataModel(): string;

    /**
     * the field rules used for validation. Each database column needs a rule.
     *
     * @return array
     */
    public function getRules(): array;

    /**
     * Definition of the Endpoints.
     *
     * @return array
     */
    public function getEndpoints(): array;

    /**
     * Definition of the Endpoints which are globally accessible.
     * This means these endpoints can be called without having the
     * service saved on a project.
     *
     * @return array
     */
    public function getGlobalEndpoints(): array;
}
