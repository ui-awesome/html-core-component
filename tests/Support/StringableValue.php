<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use Stringable;

/**
 * Stub value object exercising the {@see Stringable} branch of separator setters.
 */
final readonly class StringableValue implements Stringable
{
    public function __construct(private string $value) {}

    public function __toString(): string
    {
        return $this->value;
    }
}
