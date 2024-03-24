<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Test\Concern;

use UIAwesome\Html\Core\Component\Concern\HasIconCollection;

final class HasIconCollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testAttributes(): void
    {
        $instance = new class () {
            use HasIconCollection;
        };

        $instance = $instance->iconAttributes(['class' => 'value']);
        $instance = $instance->iconAttributes(['disabled' => true]);

        $this->assertSame(['class' => 'value', 'disabled' => true], $instance->getIconAttributes());
    }

    public function testClass(): void
    {
        $instance = new class () {
            use HasIconCollection;

            public function getIconClass(): string
            {
                return $this->iconAttributes['class'] ?? '';
            }
        };

        $this->assertEmpty($instance->getIconClass());

        $instance = $instance->iconClass('class');

        $this->assertSame('class', $instance->getIconClass());

        $instance = $instance->iconClass('class-1');

        $this->assertSame('class class-1', $instance->getIconClass());

        $instance = $instance->iconClass('override-class', true);

        $this->assertSame('override-class', $instance->getIconClass());
    }

    public function testImmutability(): void
    {
        $instance = new class () {
            use HasIconCollection;
        };

        $this->assertNotSame($instance, $instance->iconAttributes([]));
        $this->assertNotSame($instance, $instance->iconClass(''));
        $this->assertNotSame($instance, $instance->iconContent(''));
        $this->assertNotSame($instance, $instance->iconFilePath(''));
        $this->assertNotSame($instance, $instance->iconTag(false));
    }

    public function testTagExceptionWithEmptyValue(): void
    {
        $instance = new class () {
            use HasIconCollection;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must not be empty. The valid values are: "i", "span", "svg".');

        $instance->iconTag('');
    }

    public function testTagExceptionWithInvalidValue(): void
    {
        $instance = new class () {
            use HasIconCollection;
        };

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Invalid value "value" for the icon tag method. Allowed values are: "i", "span", "svg".'
        );

        $instance->iconTag('value');
    }
}
