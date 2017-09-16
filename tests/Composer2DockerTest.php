<?php

namespace Composer2Docker\Tests;

use Composer2Docker\Composer2Docker;
use PHPUnit\Framework\TestCase;

class Composer2DockerTest extends TestCase
{
    public function testPackagistPackageWithSuccess()
    {
        $generator = new Composer2Docker();
        $generator->composerLock(
            __DIR__.'/../composer.lock',
            __DIR__.'/../composer.json'
        );
        $this->assertEquals(
            file_get_contents(__DIR__.'/../Dockerfile'),
            $generator->dockerfile()
        );
    }
}
