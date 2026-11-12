<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Values;

/**
 * Represents the structural variants this package defines for the {@see \UIAwesome\Html\Core\Component\Dropdown}
 * component context.
 *
 * Pass the backing value as the context variant of {@see ComponentName::DROPDOWN}.
 */
enum DropdownVariant: string
{
    /**
     * `language` — Dropdown that selects the interface language.
     */
    case LANGUAGE = 'language';
}
