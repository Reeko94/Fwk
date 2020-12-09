<?php

namespace Fwk\Mvc\Context;

/**
 * Class RouteContext
 * @property array $current // ['module' => ...,'controller' => ...,'action' => ...]
 * @property array $params
 * @property array $default
 */
class RouteContext extends ContextAbstract
{

    protected array $contexts = [
        'current' => [],
        'params' => [],
        'default' => []
    ];

    public function setParams(array $params)
    {
        $this->setContext('params', $params);

        return $this;
    }

    public function setCurrent(array $route)
    {
        $this->setContext('current', $route);

        return $this;
    }

    public function getParam($key, $default = null)
    {
        if(array_key_exists($key,$this->params)) {
            return $this->params[$key];
        }

        return $default;
    }

}