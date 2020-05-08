<?php

namespace Loader;

use Loader\Setters\SimpleSetter;
use Yiisoft\Arrays\ArrayHelper;

class Loader implements LoaderInterface
{
    private Object $source;
    private Object $target;
    private array $setters = [];
    private array $protected = [];

    public string $undefinedSetter = 'Undefined setter class';
    public string $undefinedSource = 'Source object is not defined';
    public string $undefinedTarget = 'Target object is not defined';

    public function source(Object &$source): LoaderInterface
    {
        $this->source = $source;
        return $this;
    }

    public function target(Object &$target): LoaderInterface
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function load(): void
    {
        if (!isset($this->source)) {
            throw new \Exception($this->undefinedSource);
        }

        if (!isset($this->target)) {
            throw new \Exception($this->undefinedTarget);
        }

        $properties = $this->properties();
        foreach ($properties as $property) {
            if (in_array($property->name, $this->protected, true)) {
                continue;
            }

            $setter = $this->getSetter($property->name);
            $setter->set($this->source, $this->target, $property->name);
        }
    }

    /**
     * @param $property
     * @return SetterInterface
     * @throws \Exception
     */
    private function getSetter(string $property): SetterInterface
    {
        if (!$class = $this->setters[$property]) {
            $class = SimpleSetter::class;
        }

        if (!class_exists($class)) {
            throw new \Exception($this->undefinedSetter);
        }

        return new $class();
    }

    private function properties()
    {
        $reflection = new \ReflectionClass($this->source);
        return $reflection->getProperties();
    }

    public function setters(array $setters): LoaderInterface
    {
        $this->setters = ArrayHelper::merge($this->setters, $setters);
        return $this;
    }

    public function protected(array $protected): LoaderInterface
    {
        $this->protected = $protected;
        return $this;
    }
}
