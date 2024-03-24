<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Item;

use UIAwesome\Html\Core\Component\Item;

/**
 * Test the exceptions of the Item component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testListItemTagWithValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value "span". The list item tag must be one of: "li".');

        Item::widget()->label('value')->link('/')->listItemTag('span')->render();
    }
}
