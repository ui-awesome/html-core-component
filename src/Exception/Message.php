<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Exception;

use function sprintf;

/**
 * Represents error message templates for library exceptions.
 *
 * Use {@see Message::getMessage()} to format the template with `sprintf()` arguments.
 */
enum Message: string
{
    /**
     * Error when the tag name for the active link is an empty string.
     *
     * Format: 'The tag name for the link container element for active links cannot be empty.'
     */
    case LINK_ACTIVE_TAG_CANNOT_BE_EMPTY = 'The tag name for the link container element for active links cannot be '
        . 'empty.';

    /**
     * Error when a list or list-item tag is an empty string instead of a tag name or `false`.
     *
     * Format: "The '%s' value cannot be empty; use 'false' to skip the wrapper."
     */
    case TAG_CANNOT_BE_EMPTY = "The '%s' value cannot be empty; use 'false' to skip the wrapper.";

    /**
     * Error when a component tag name does not resolve to an `Inline` or `Block` enum case.
     *
     * Format: "%s tag '%s' must resolve to an 'Inline' or 'Block' enum case."
     */
    case TAG_MUST_RESOLVE_TO_INLINE_OR_BLOCK = "%s tag '%s' must resolve to an 'Inline' or 'Block' enum case.";

    /**
     * Error when a toggle label is set and the assigned toggle is not a `BaseToggle` instance.
     *
     * Format: "Toggle label '%s' requires a 'BaseToggle' toggle, '%s' given."
     */
    case TOGGLE_LABEL_REQUIRES_BASE_TOGGLE = "Toggle label '%s' requires a 'BaseToggle' toggle, '%s' given.";

    /**
     * Returns the formatted message string for the error case.
     *
     * @param int|string ...$argument Values to insert into the message template.
     *
     * @return string Formatted error message with interpolated arguments.
     */
    public function getMessage(int|string ...$argument): string
    {
        return sprintf($this->value, ...$argument);
    }
}
