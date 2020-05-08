<?php

namespace Loader\Setters;

use Loader\SetterInterface;

class SimpleSetter implements SetterInterface
{
    /**
     * @param Object $source
     * @param Object $target
     * @param string $property
     */
    public function set(Object &$source, Object &$target, string $property): void
    {
        $getter = 'get' . ucfirst($property);
        $setter = 'set' . ucfirst($property);

        if (method_exists($source, $getter) && method_exists($target, $setter)) {
            $target->$setter($source->$getter());
        }
    }
}