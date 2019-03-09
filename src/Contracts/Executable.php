<?php

namespace Sentinel\Services\Contracts;

interface Executable
{
    /**
     * The data injected into the method is the corresponding data model.
     *
     * @param $data
     *
     * @return array
     */
    public function execute($data): array;
}
