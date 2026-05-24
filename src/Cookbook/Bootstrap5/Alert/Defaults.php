<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\ThemeProviderInterface;
use UIAwesome\Html\Helper\CSSClass;

/**
 * Bootstrap5 alert defaults providing the colored variants.
 *
 * Supports the eight standard contextual types: `danger`, `dark`, `info`, `light`, `primary`, `secondary`, `success`,
 * `warning`. Apply via {@see \UIAwesome\Html\Core\Base\BaseTag::addThemeProvider()} with the contextual type as the
 * theme name.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Alert::tag()
 *     ->addThemeProvider('danger', \UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Alert\Defaults::class)
 *     ->content('Watch out!')
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/alerts/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class Defaults implements ThemeProviderInterface
{
    /**
     * `printf` template for the alert wrapper class with `%1$s` placeholder for the contextual type.
     */
    private const string BASE_CLASS = 'alert alert-%1$s';
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

    /**
     * Returns the Bootstrap5 `alert` attribute set for the given contextual `$theme`.
     *
     * @param BaseTag $tag Tag the provider is decorating.
     * @param string $theme Contextual theme key matched against {@see self::TYPES}.
     *
     * @return array<string, mixed> Method-call definitions merged into the tag at render time.
     */
    public function apply(BaseTag $tag, string $theme): array
    {
        return [
            'class' => [CSSClass::render($theme, self::BASE_CLASS, self::TYPES)],
        ];
    }
}
