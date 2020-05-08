<?php

namespace Loader\Setters;

use Loader\SetterInterface;

class SimpleSetter implements SetterInterface
{
    /**
     * @param Object|array $source
     * @param Object $target
     * @param string $property
     */
    public function set($source, Object &$target, string $property): void
    {
        $setter = 'set' . ucfirst($property);

        if (method_exists($target, $setter)) {
            if (is_array($source) && array_key_exists($property, $source)) {
                $target->$setter($source[$property]);
            }

            if (is_object($source)) {
                $getter = 'get' . ucfirst($property);

                if (method_exists($source, $getter)) {
                    $target->$setter($source->$getter());
                }
            }
        }
    }
}