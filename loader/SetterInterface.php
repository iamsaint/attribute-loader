<?php

namespace Loader;

interface SetterInterface
{
    /**
     * @param Object|array $source
     * @param Object $target
     * @param string $property
     */
    public function set($source, Object &$target, string $property): void;
}