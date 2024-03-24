<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasCurrentPath;

final class HasCurrentPathTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasCurrentPath;
        };

        $this->assertNotSame($instance, $instance->currentPath(''));
    }
}
