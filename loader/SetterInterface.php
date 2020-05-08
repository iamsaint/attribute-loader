<?php

namespace Loader;

interface SetterInterface {
    /**
     * @param Object $source
     * @param Object $target
     * @param string $property
     */
    public function set(Object &$source, Object &$target, string $property): void;
}