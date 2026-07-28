<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests\Support;

/**
 * Stub tag enum declared outside {@see \UIAwesome\Html\Interop} exercising the by-value tag matching of setters that
 * accept any {@see \BackedEnum}.
 */
enum ForeignTag: string
{
    /**
     * Anchor tag, sharing the backed value of `Inline::A` without sharing its identity.
     */
    case A = 'a';
}
