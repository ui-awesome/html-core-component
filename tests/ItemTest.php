<?php

declare(strict_types=1);

namespace UIAwesome\Html\Core\Component\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use UIAwesome\Html\Core\Component\Item;
use UIAwesome\Html\Core\Component\Tests\Support\{
    ForeignTag,
    RenderIconOverride,
    RenderLabelOverride,
    StringableValue,
    Theme,
};
use UIAwesome\Html\Core\Config\{Call, ComponentContext, Config, Cookbook, Recipe};

/**
 * Unit tests for the {@see Item} component rendering and immutable configuration.
 */
#[Group('item')]
final class ItemTest extends TestCase
{
    public function testActivateItems(): void
    {
        self::assertTrue(
            Item::tag()
                ->active()
                ->link('/')
                ->isActive(),
            'Active flag with a link must report active state.',
        );
    }

    public function testActivateItemsWithFalseValue(): void
    {
        self::assertFalse(
            Item::tag()
                ->activateItems(false)
                ->active()
                ->link('/')
                ->isActive(),
            'Disabled activation must short-circuit the active state.',
        );
    }

    public function testConfigAppliesRecipeDefaults(): void
    {
        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.item',
                    new Cookbook(
                        new Call('linkClass', 'item-link'),
                        new Call('listItemClass', 'item-shell'),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <li class="item-shell">
            <a class="item-link" href="/">
            Home
            </a>
            </li>
            HTML,
            Item::tag()
                ->config($config, new ComponentContext('item'))
                ->label('Home')
                ->link('/')
                ->render(),
            'Recipe classes must reach the list item and the link.',
        );
    }

    public function testConfigIsOverriddenByFluentCallsMadeAfterwards(): void
    {
        $config = new Config(
            new Theme(
                'stub',
                new Recipe(
                    'stub.item',
                    new Cookbook(
                        new Call('linkClass', 'from-config'),
                        new Call('label', 'Config label'),
                    ),
                ),
            ),
        );

        self::assertSame(
            <<<HTML
            <li>
            <a class="from-config" href="/">
            User label
            </a>
            </li>
            HTML,
            Item::tag()
                ->config($config, new ComponentContext('item'))
                ->label('User label')
                ->link('/')
                ->render(),
            'Local label must win over the recipe value.',
        );
    }

    public function testContent(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            content
            </a>
            </li>
            HTML,
            Item::tag()
                ->content('content')
                ->link('/')
                ->render(),
            'Content must render inside the link.',
        );
    }

    public function testCurrentPath(): void
    {
        self::assertTrue(
            Item::tag()
                ->currentPath('/')
                ->link('/')
                ->isActive(),
            "Matching 'currentPath' must activate the item.",
        );
    }

    public function testDisabled(): void
    {
        self::assertTrue(
            Item::tag()
                ->disabled()
                ->link('/')
                ->isDisabled(),
            'Disabled flag must report disabled state.',
        );
    }

    public function testDividerWithVoidsTag(): void
    {
        self::assertSame(
            '<br>',
            Item::tag()->divider('br')->render(),
            "Voids tag 'br' must resolve to 'Voids::BR' and render as a self-closing element.",
        );
    }

    public function testIconAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconAttributes(['class' => 'icon'])
                ->link('/')
                ->render(),
            'Icon attribute map must decorate the icon element.',
        );
    }

    public function testIconAttributesMergesAcrossCalls(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <i class="first" aria-hidden="true">
            x
            </i>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconAttributes(['class' => 'first'])
                ->iconAttributes(['aria-hidden' => 'true'])
                ->iconContent('x')
                ->iconTag()
                ->link('/')
                ->render(),
            'Prior values must be retained on merge.',
        );
    }

    public function testIconClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconClass('icon')
                ->link('/')
                ->render(),
            'CSS class must be applied to the icon element.',
        );
    }

    public function testIconClassMergesWithBaseIconAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <i class="base value">
            </i>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconAttributes(['class' => 'base'])
                ->iconClass('value')
                ->iconTag()
                ->link('/')
                ->render(),
            "Default 'iconClass' merge must append to existing icon class.",
        );
    }

    public function testIconContent(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->link('/')
                ->render(),
            'Icon content must render inside the icon element.',
        );
    }

    public function testIconFilePath(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/></svg>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconFilePath(__DIR__ . '/Support/svg/toggle.svg')
                ->iconTag('svg')
                ->link('/')
                ->render(),
            'SVG file content must be inlined inside the link.',
        );
    }

    public function testIconRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <i>
            value
            </i>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconAttributes(['aria-hidden' => 'true'])
                ->iconContent('value')
                ->iconRemoveAttribute('aria-hidden')
                ->iconTag()
                ->link('/')
                ->render(),
            'Removed icon attribute must not appear in the rendered icon element.',
        );
    }

    public function testIconSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <i aria-hidden="true">
            value
            </i>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->iconSetAttribute('aria-hidden', 'true')
                ->iconTag()
                ->link('/')
                ->render(),
            'Set icon attribute must appear on the rendered icon element.',
        );
    }

    public function testIconTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <i>
            value
            </i>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->iconTag()
                ->link('/')
                ->render(),
            "Default icon tag must be '<i>'.",
        );
    }

    public function testIconTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->iconTag(false)
                ->link('/')
                ->render(),
            "'false' icon tag must drop the icon element.",
        );
    }

    public function testIconTagWithSpanValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span>
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->iconTag('span')
                ->link('/')
                ->render(),
            "Span icon tag must wrap the content in '<span>'.",
        );
    }

    public function testIconTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <svg>
            value
            </svg>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('value')
                ->iconTag('svg')
                ->link('/')
                ->render(),
            'Custom icon tag must wrap the icon content.',
        );
    }

    public function testIsActiveWithEmptyLink(): void
    {
        self::assertFalse(
            Item::tag()->active()->isActive(),
            'Active flag without a link must not report active.',
        );
    }

    public function testLabel(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            &lt;b&gt;label&lt;b&gt;
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('<b>label<b>')
                ->link('/')
                ->render(),
            'Label must be HTML-encoded by default.',
        );
    }

    public function testLabelAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span title="tip">
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelAttributes(['title' => 'tip'])
                ->labelTag()
                ->link('/')
                ->render(),
            'Label attribute map must decorate the label element.',
        );
    }

    public function testLabelAttributesMergesAcrossCalls(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span class="first" title="tip">
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelAttributes(['class' => 'first'])
                ->labelAttributes(['title' => 'tip'])
                ->labelTag()
                ->link('/')
                ->render(),
            'Prior values must be retained on merge.',
        );
    }

    public function testLabelClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span class="nav-label">
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelClass('nav-label')
                ->labelTag()
                ->link('/')
                ->render(),
            'CSS class must be applied to the label element.',
        );
    }

    public function testLabelClassMergesWithBaseLabelAttributeClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span class="base value">
            label
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('label')
                ->labelAttributes(['class' => 'base'])
                ->labelClass('value')
                ->labelTag()
                ->link('/')
                ->render(),
            "Default 'labelClass' merge must append to existing label class.",
        );
    }

    public function testLabelRemoveAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span>
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelAttributes(['title' => 'tip'])
                ->labelRemoveAttribute('title')
                ->labelTag()
                ->link('/')
                ->render(),
            'Removed label attribute must not appear in the rendered label element.',
        );
    }

    public function testLabelSetAttribute(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span title="tip">
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelSetAttribute('title', 'tip')
                ->labelTag()
                ->link('/')
                ->render(),
            'Set label attribute must appear on the rendered label element.',
        );
    }

    public function testLabelTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span>
            value
            </span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelTag()
                ->link('/')
                ->render(),
            "Default label tag must be '<span>'.",
        );
    }

    public function testLabelTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            value
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelTag(false)
                ->link('/')
                ->render(),
            "'false' label tag must render the label as plain text.",
        );
    }

    public function testLabelTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <div>
            value
            </div>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->labelTag('div')
                ->link('/')
                ->render(),
            'Custom label tag must wrap the label.',
        );
    }

    public function testLabelWithEncodeFalse(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <strong>label</strong>
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('<strong>label</strong>', false)
                ->link('/')
                ->render(),
            "'false' encode flag must preserve raw markup.",
        );
    }

    public function testLink(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->render(),
            'Link href must be serialized.',
        );
    }

    public function testLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a class="value" href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkAttributes(['class' => 'value'])
                ->render(),
            'Link attribute map must decorate the link element.',
        );
    }

    public function testLinkClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a class="value" href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkClass('value')
                ->render(),
            'CSS class must be applied to the link element.',
        );
    }

    public function testLinkContainerAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <div class="value">
            <a href="/">
            </a>
            </div>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkContainerAttributes(['class' => 'value'])
                ->linkContainerTag()
                ->render(),
            'Link container attribute map must decorate the wrapper.',
        );
    }

    public function testLinkContainerClass(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <div class="value">
            <a href="/">
            </a>
            </div>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkContainerClass('value')
                ->linkContainerTag()
                ->render(),
            'CSS class must be applied to the link container.',
        );
    }

    public function testLinkContainerFalseTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkContainerTag(false)
                ->render(),
            "'false' link container tag must drop the wrapper.",
        );
    }

    public function testLinkContainerTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <div>
            <a href="/">
            </a>
            </div>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkContainerTag()
                ->render(),
            'Default link container tag must wrap the link.',
        );
    }

    public function testLinkContainerTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <span>
            <a href="/">
            </a>
            </span>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkContainerTag('span')
                ->render(),
            'Custom link container tag must wrap the link.',
        );
    }

    public function testLinkTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->linkTag()
                ->render(),
            "Default link tag must be '<a>'.",
        );
    }

    public function testLinkTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            value
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->linkTag(false)
                ->render(),
            "'false' link tag must drop the link wrapper.",
        );
    }

    public function testLinkTagWithForeignEnumMatchingAnchorKeepsHref(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            value
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->linkTag(ForeignTag::A)
                ->render(),
            'Any enum meaning `a` must keep the link.',
        );
    }

    public function testLinkTagWithValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <span>
            value
            </span>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->linkTag('span')
                ->render(),
            'Custom link tag must wrap the label.',
        );
    }

    public function testLinkTagWithValueKeepsLinkAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <span class="value" data-role="current">
            value
            </span>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->linkAttributes(['data-role' => 'current'])
                ->linkClass('value')
                ->linkTag('span')
                ->render(),
            'Only `href` is dropped outside an anchor.',
        );
    }

    public function testListItemAttributes(): void
    {
        self::assertSame(
            <<<HTML
            <li class="value">
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->listItemAttributes(['class' => 'value'])
                ->render(),
            'List item attribute map must decorate the wrapper.',
        );
    }

    public function testListItemClass(): void
    {
        self::assertSame(
            <<<HTML
            <li class="value">
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->listItemClass('value')
                ->render(),
            'CSS class must be applied to the list item wrapper.',
        );
    }

    public function testListItemTag(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            </a>
            </li>
            HTML,
            Item::tag()
                ->link('/')
                ->listItemTag()
                ->render(),
            "Default list item tag must be '<li>'.",
        );
    }

    public function testListItemTagWithFalseValue(): void
    {
        self::assertSame(
            <<<HTML
            <a href="/">
            value
            </a>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->listItemTag(false)
                ->render(),
            "'false' list item tag must drop the wrapper.",
        );
    }

    public function testRender(): void
    {
        self::assertEmpty(
            Item::tag()->render(),
            'Empty item must render an empty string.',
        );
    }

    public function testRenderIconRemainsProtectedForSubclassOverride(): void
    {
        self::assertInstanceOf(
            Item::class,
            new RenderIconOverride(),
            'Override subclass must be an `Item` instance.',
        );
    }

    public function testRenderLabelRemainsProtectedForSubclassOverride(): void
    {
        self::assertInstanceOf(
            Item::class,
            new RenderLabelOverride(),
            'Override subclass must be an `Item` instance.',
        );
    }

    public function testReturnNewInstanceWhenSettingAttribute(): void
    {
        $instance = Item::tag();

        self::assertNotSame(
            $instance,
            $instance->activateItems(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->active(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->currentPath(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->disabled(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->divider(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconContent(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconFilePath(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->iconTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->items(),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->label(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->labelAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->labelClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->labelRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->labelSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->labelTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->link(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkContainerTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->linkTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemAttributes([]),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemClass(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemRemoveAttribute('key'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemSetAttribute('key', 'value'),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->listItemTag(false),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->separator(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->templateLinkItem(''),
            'New instance must be returned (immutability).',
        );
        self::assertNotSame(
            $instance,
            $instance->visible(),
            'New instance must be returned (immutability).',
        );
    }

    public function testSeparator(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            >
            <a href="/">
            value
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->separator('>')
                ->render(),
            'Separator must precede the link.',
        );
    }

    public function testSeparatorWithStringableValue(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            >
            <a href="/">
            value
            </a>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->separator(new StringableValue('>'))
                ->render(),
            'Stringable separator must be cast to `string`.',
        );
    }

    public function testTemplate(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <div>
            <a href="/">
            value
            </a>
            </div>
            </li>
            HTML,
            Item::tag()
                ->label('value')
                ->link('/')
                ->template('<div>\n{link}\n</div>')
                ->render(),
            'Custom template must control the rendered structure.',
        );
    }

    public function testTemplateLinkItem(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            <a href="/">
            <span>label content</span>
            </a>
            </li>
            HTML,
            Item::tag()
                ->iconContent('icon')
                ->label('label')
                ->content('content')
                ->link('/')
                ->templateLinkItem('<span>{icon}{label} {content}</span>')
                ->render(),
            'Custom link item template must control the composition.',
        );
    }

    public function testThrowInvalidArgumentExceptionWhenIconTagIsNotAllowed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'div' is not in the list of valid values for 'iconTag': 'i', 'span', 'svg'.",
        );

        Item::tag()->iconTag('div');
    }

    public function testThrowInvalidArgumentExceptionWhenLabelTagDoesNotResolveToEnum(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Label tag 'my-label' must resolve to an `Inline` or `Block` enum case.",
        );

        Item::tag()->labelTag('my-label');
    }

    public function testThrowInvalidArgumentExceptionWhenLinkContainerTagDoesNotResolveToEnum(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Link container tag 'my-wrapper' must resolve to an `Inline` or `Block` enum case.",
        );

        Item::tag()->linkContainerTag('my-wrapper');
    }

    public function testThrowInvalidArgumentExceptionWhenLinkTagDoesNotResolveToEnum(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Link tag 'my-link' must resolve to an `Inline` or `Block` enum case.",
        );

        Item::tag()->linkTag('my-link');
    }

    public function testThrowInvalidArgumentExceptionWhenListItemTagIsNotAllowed(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Value 'span' is not in the list of valid values for 'listItemTag': 'li'.",
        );

        Item::tag()
            ->label('value')
            ->link('/')
            ->listItemTag('span')
            ->render();
    }

    public function testVisible(): void
    {
        self::assertSame(
            <<<HTML
            <li>
            label
            </li>
            HTML,
            Item::tag()
                ->label('label')
                ->visible()
                ->render(),
            'Default visible argument must render the item.',
        );
    }

    public function testVisibleWithFalseValue(): void
    {
        self::assertEmpty(
            Item::tag()
                ->label('label')
                ->link('/')
                ->visible(false)
                ->render(),
            "'false' visible flag must short-circuit rendering even when label and link are set.",
        );
    }
}
