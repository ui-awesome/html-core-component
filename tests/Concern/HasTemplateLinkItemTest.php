<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasTemplateLinkItem;

final class HasTemplateLinkItemTest extends \PHPUnit\Framework\TestCase
{
    public function testImmutability(): void
    {
        $instance = new class () {
            use HasTemplateLinkItem;
        };

        $this->assertNotSame($instance, $instance->templateLinkItem(''));
    }
}
