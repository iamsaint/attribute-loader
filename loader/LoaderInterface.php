<?php

namespace Loader;

interface LoaderInterface
{
    /**
     * @param Object $source
     * @return LoaderInterface
     */
    public function source(Object &$source): LoaderInterface;

    /**
     * @param Object $target
     * @return LoaderInterface
     */
    public function target(Object &$target): LoaderInterface;

    public function setters(array $setters): LoaderInterface;

    public function protected(array $protected): LoaderInterface;

    /**
     * @throws \Exception
     */
    public function load(): void;
}