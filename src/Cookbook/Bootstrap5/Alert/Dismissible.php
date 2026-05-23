<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\Alert as AlertToggle;
use UIAwesome\Html\Core\Component\Toggle;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;

/**
 * Bootstrap5 alert defaults providing dismissible colored variants with a close toggle.
 *
 * Supports the eight standard contextual types: `danger`, `dark`, `info`, `light`, `primary`, `secondary`, `success`,
 * `warning`. Apply via {@see \UIAwesome\Html\Core\Base\BaseTag::addThemeProvider()} with the contextual type as the
 * theme name.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Alert::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert\Dismissible::class)
 *     ->content('Watch out!')
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/alerts/#dismissing
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Dismissible implements ThemeProviderInterface
{
    /**
     * `printf` template for the alert wrapper class with `%1$s` placeholder for the contextual type.
     */
    private const string BASE_CLASS = 'alert alert-%1$s alert-dismissible fade show';
    /**
     * Allowed contextual type names.
     */
    private const array TYPES = [
        'danger',
        'dark',
        'info',
        'light',
        'primary',
        'secondary',
        'success',
        'warning',
    ];

    public function apply(BaseTag $tag, string $theme): array
    {
        return [
            'class' => [CSSClass::render($theme, self::BASE_CLASS, self::TYPES)],
            'toggle' => [Toggle::tag()->addDefaultProvider(AlertToggle::class)],
        ];
    }
}
