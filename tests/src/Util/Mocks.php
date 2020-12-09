<?php

namespace Fwk\Util;

/**
 * @return mixed
 */
function hash_algos()
{
    return $GLOBALS['function']['has_algos'];
}

/**
 * @return mixed
 */
function get_cfg_var()
{
    return $GLOBALS['function']['get_cfg_var'];
}

/**
 * @return mixed
 */
function apache_get_modules()
{
    return $GLOBALS['function']['apache_get_modules'];
}

/**
 * @param $setting
 * @return mixed
 */
function ini_get($setting)
{
    return $GLOBALS['function']['ini_get'][$setting];
}

/**
 * @param $extension
 * @return mixed
 */
function extension_loaded($extension)
{
    return $GLOBALS['extension_loaded'][$extension];
}

/**
 * @param $function
 * @return mixed
 */
function function_exists($function)
{
    return $GLOBALS['function_exists'][$function];
}

/**
 * @param $context
 * @param $result
 */
function definedMock($context, $result)
{
    $GLOBALS['defined'][$context] = $result;
}

/**
 * @param $constant
 * @return bool
 */
function defined($constant): bool
{
    if (!isset($GLOBALS['defined'][$constant])) {
        return false;
    }

    return $GLOBALS['defined'][$constant];
}

/**
 * @param $env
 * @param $result
 */
function getenvMock($env, $result)
{
    $GLOBALS['getenv'][$env] = $result;
}


/**
 * @param $env
 * @return false|mixed
 */
function getenv($env)
{
    if (!isset($GLOBALS['getenv'][$env])){
        return false;
    }
    return $GLOBALS['getenv'][$env];
}

/**
 * @param $constant
 * @param $result
 */
function defineMock($constant, $result)
{
    $GLOBALS['define'][$constant] = $result;
}

/**
 * @param $constant
 * @param $value
 */
function define($constant, $value)
{
    $GLOBALS['define'][$constant] = $value;
}

/**
 * @param $constant
 * @return mixed
 */
function constant($constant)
{
    return $GLOBALS['define'][$constant];
}