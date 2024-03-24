<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasLinkActiveTag;

final class HasLinkActiveTagTest extends \PHPUnit\Framework\TestCase
{
    public function testTagExceptionWithEmptyValue(): void
    {
        $instance = new class () {
            use HasLinkActiveTag;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The tag name for the link container element for active links cannot be empty.');

        $instance->linkActiveTag('');
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasLinkActiveTag;
        };

        $this->assertNotSame($instance, $instance->linkActiveTag('div'));
    }
}
