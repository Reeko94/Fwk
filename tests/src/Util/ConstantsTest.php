<?php


namespace Fwk\src\Util;


use Fwk\Util\Constants;
use PHPUnit\Framework\TestCase;
use function Fwk\Util\definedMock;
use function Fwk\Util\defineMock;
use function Fwk\Util\getenvMock;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Mocks.php';

class ConstantsTest extends TestCase
{

    protected function setUp(): void
    {
        $GLOBALS['defined'] = [];
        $GLOBALS['getenv'] = [];
        $GLOBALS['define'] = [];
    }

    protected function tearDown(): void
    {
        $GLOBALS['defined'] = [];
        $GLOBALS['getenv'] = [];
        $GLOBALS['define'] = [];
    }

    public function testDefineMainDoNothingIfAlreadySet()
    {
        definedMock('DATA_DIR', true);
        definedMock('APP_ENV', true);

        Constants::defineMain();

        $this->assertArrayNotHasKey('DATA_DIR', $GLOBALS['define']);
        $this->assertArrayNotHasKey('APP_ENV', $GLOBALS['define']);
    }

    public function testDefineMainDefineIfEnvIsSet()
    {

        definedMock('DATA_DIR', false);
        definedMock('APP_ENV', false);
        getenvMock('DATA_DIR', 'path' . DIRECTORY_SEPARATOR . 'to' . DIRECTORY_SEPARATOR . 'data');
        getenvMock('APP_ENV', 'somewhere');

        Constants::defineMain();


        $this->assertArrayHasKey('DATA_DIR', $GLOBALS['define']);
        $this->assertSame('path' . DIRECTORY_SEPARATOR . 'to' . DIRECTORY_SEPARATOR . 'data', $GLOBALS['define']['DATA_DIR']);
        $this->assertArrayHasKey('APP_ENV', $GLOBALS['define']);
        $this->assertSame('somewhere', $GLOBALS['define']['APP_ENV']);
    }

    public function testDefineMainDefineDefaultDataDir()
    {
        definedMock('DATA_DIR', false);
        definedMock('APP_ENV', true);
        getenvMock('DATA_DIR', false);
        if (!defined('APP_ROOT')) {
            defineMock('APP_ROOT', 'path' . DIRECTORY_SEPARATOR . 'to');
        } else {
            defineMock('APP_ROOT', APP_ROOT);
        }

        Constants::defineMain();

        if (!defined('APP_ROOT')) {
            $this->assertSame('path' . DIRECTORY_SEPARATOR . 'to' . DIRECTORY_SEPARATOR . 'data', $GLOBALS['define']['DATA_DIR']);
        } else {
            $this->assertSame(APP_ROOT . DIRECTORY_SEPARATOR . 'data', $GLOBALS['define']['DATA_DIR']);
        }
    }

    public function testDefineOther()
    {
        defineMock('DATA_DIR', 'data');
        if (!defined('APP_ROOT')) {
            defineMock('APP_ROOT', 'approot');
        } else {
            defineMock('APP_ROOT', APP_ROOT);
        }

        Constants::defineOthers();

        $this->assertSame('data' . DIRECTORY_SEPARATOR . 'tmp', $GLOBALS['define']['TEMP_DIR']);
        $this->assertSame('data' . DIRECTORY_SEPARATOR . 'logs', $GLOBALS['define']['LOG_DIR']);
        $this->assertSame('data' . DIRECTORY_SEPARATOR . 'cache', $GLOBALS['define']['CACHE_DIR']);
        $this->assertSame('app', $GLOBALS['define']['CACHE_SUFFIX']);
        $this->assertSame('data' . DIRECTORY_SEPARATOR . 'upload', $GLOBALS['define']['UPLOAD_DIR']);

        if (!defined('APP_ROOT')) {
            $this->assertSame('approot' . DIRECTORY_SEPARATOR . 'public', $GLOBALS['define']['PUBLIC_DIR']);
        } else {
            $this->assertSame(APP_ROOT . DIRECTORY_SEPARATOR . 'public', $GLOBALS['define']['PUBLIC_DIR']);
        }

        $this->assertSame(DIRECTORY_SEPARATOR, $GLOBALS['define']['DS']);
        $this->assertSame(PATH_SEPARATOR, $GLOBALS['define']['PS']);
    }
}