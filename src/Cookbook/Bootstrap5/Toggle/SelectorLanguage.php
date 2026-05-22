<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle;

use UIAwesome\Html\Core\Base\BaseTag;
use UIAwesome\Html\Core\Provider\DefaultsProviderInterface;
use UIAwesome\Html\Svg\Svg;

/**
 * Bootstrap5 toggle defaults for a language selector button with a globe icon.
 *
 * Usage example:
 * ```php
 * echo \UIAwesome\Html\Core\Component\Toggle::tag()
 *     ->addDefaultProvider(\UIAwesome\Html\Core\Component\Cookbook\Bootstrap5\Toggle\SelectorLanguage::class)
 *     ->render();
 * ```
 *
 * @link https://getbootstrap.com/docs/5.3/components/dropdowns/
 *
 * @copyright Copyright (C) 2026 Terabytesoftw.
 * @license https://opensource.org/license/bsd-3-clause BSD 3-Clause License.
 */
final class SelectorLanguage implements DefaultsProviderInterface
{
    public function getDefaults(BaseTag $tag): array
    {
        return [
            'ariaAttributes' => [['expanded' => 'false', 'label' => 'Toggle language dropdown']],
            'class' => ['btn btn-primary dropdown-toggle d-flex align-items-center text-white'],
            'dataAttributes' => [['bs-toggle' => 'dropdown']],
            'iconAttributes' => [['height' => '32', 'width' => '32']],
            'iconFilePath' => [Svg::iconPath('Bootstrap5:globe')],
            'iconTag' => ['svg'],
            'title' => ['Select language'],
        ];
    }
}
