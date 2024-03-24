<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Menu;

use UIAwesome\Html\Core\Component\{Item, Menu};

/**
 * Test the exceptions of the Menu component.
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testListItamTagWithEmptyValue(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value "span". The list item tag must be one of: "li".');

        Menu::widget()
            ->items(
                Item::widget()->label('Home')->link('/'),
                Item::widget()->label('About')->link('/about'),
                Item::widget()->label('Contact')->link('/contact')
            )
            ->listItemTag('span')
            ->render();
    }
}
