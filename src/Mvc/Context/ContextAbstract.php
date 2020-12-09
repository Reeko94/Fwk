<?php

namespace Fwk\Mvc\Context;

/**
 * Class ContextAbstract
 */
abstract class ContextAbstract
{
    /**
     * @var array
     */
    protected array $contexts = [];

    /**
     * ContextAbstract constructor.
     * @param array $contexts
     */
    public function __construct(array $contexts = [])
    {
        foreach ($contexts as $name => $context) {
            $this->setContext($name, $context);
        }
    }

    /**
     * @param $name
     * @param $context
     * @return $this
     */
    protected function setContext($name, $context): ContextAbstract
    {
        if (!array_key_exists($name, $this->contexts))
            throw new RuntimeException('The context is not defined');

        $this->contexts[$name] = $context;

        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (!array_key_exists($name, $this->contexts)) {
            throw new RuntimeException('The context is not defined');
        }

        return $this->contexts[$name];
    }

}



















