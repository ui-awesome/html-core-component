<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

use UIAwesome\Html\Contracts\RenderableInterface;

/**
 * HTML fragment counting render calls to detect duplicate rendering.
 */
final class RenderableValue implements RenderableInterface
{
    public int $renders = 0;

    public function __construct(private readonly string $html) {}

    public function __toString(): string
    {
        return $this->render();
    }

    public function render(): string
    {
        $this->renders++;

        return $this->html;
    }
}
