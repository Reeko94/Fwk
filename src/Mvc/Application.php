<?php

namespace Fwk\Mvc;

use Fwk\Mvc\Context\RouteContext;
use Fwk\Service\ServiceManager;

/**
 * Class Application
 * @package Fwk\Mvc
 * @property RouteContext $route Contexte de route
 * @property HttpContext $http Contexte HTTP : requete, repsosne session
 */
class Application extends ServiceManager
{

}