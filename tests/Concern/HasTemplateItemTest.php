<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasTemplateItem;

final class HasTemplateItemTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasTemplateItem;
        };

        $this->assertNotSame($instance, $instance->templateItem(''));
    }
}
