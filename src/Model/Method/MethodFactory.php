<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Model\Method;

interface MethodFactory
{
    /**
     * @param array<string,string> $data
     */
    public function create(array $data): Method;

    /**
     * @param array<array<string,string>> $data
     */
    public function createCollection(array $data): MethodCollection;
}
