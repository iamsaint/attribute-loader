<?php

namespace Loader;

class Loader {
    private $source;
    private $target;

    public function source(Object &$obj) {
        $this->source = $obj;
        return $this;
    }

    public function target(Object &$obj) {
        $this->target = $obj;
        return $this;
    }

    public function load() {
        $properties = $this->properties();
        foreach ($properties as $property) {
            $setter = 'set'.ucfirst($property->name);
            $getter = 'get'.ucfirst($property->name);
            if(method_exists($this->source, $getter) && method_exists($this->target, $setter)) {
                $this->target->$setter($this->source->$getter());
            }
        }
    }

    private function properties() {
        $reflection = new \ReflectionClass($this->source);
        return $reflection->getProperties();
    }
}