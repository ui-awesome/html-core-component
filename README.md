<p align="center">
    <a href="https://github.com/ui-awesome/html-core-component" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/121752654?s=200&v=4" height="100px">
    </a>
    <h1 align="center">UI Awesome HTML Core Component for PHP.</h1>
    <br>
</p>

<p align="center">
    <a href="https://github.com/ui-awesome/html-core-component/actions/workflows/build.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html-core-component/actions/workflows/build.yml/badge.svg" alt="PHPUnit">
    </a>
    <a href="https://codecov.io/gh/ui-awesome/html-core-component" target="_blank">
        <img src="https://codecov.io/gh/ui-awesome/html-core-component/branch/main/graph/badge.svg?token=MF0XUGVLYC" alt="Codecov">
    </a>
    <a href="https://dashboard.stryker-mutator.io/reports/github.com/ui-awesome/html-core-component/main" target="_blank">
        <img src="https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Fui-awesome%2Fhtml-core-component%2Fmain" alt="Infection">
    </a>
    <a href="https://github.com/ui-awesome/html-core-component/actions/workflows/static.yml" target="_blank">
        <img src="https://github.com/ui-awesome/html-core-component/actions/workflows/static.yml/badge.svg" alt="Psalm">
    </a>
    <a href="https://shepherd.dev/github/ui-awesome/html-core-component" target="_blank">
        <img src="https://shepherd.dev/github/ui-awesome/html-core-component/coverage.svg" alt="Psalm Coverage">
    </a>
    <a href="https://github.styleci.io/repos/776381948?branch=main">
        <img src="https://github.styleci.io/repos/776381948/shield?branch=main" alt="Style ci">
    </a>        
</p>

These abstract classes serve as foundational building blocks for creating diverse UI components in HTML applications.

They provide a structured approach to developing reusable components with customizable configurations and default
settings. 

By extending these classes, you can quickly implement and customize various UI elements, such as breadcrumbs,
dropdowns, navigation bars, and toggles, to enhance your application's user interface.

- AbstractBreadcrumb: Extend this class to implement breadcrumb navigation components. It simplifies the management of
breadcrumb items and offers customizable configurations for rendering breadcrumb elements.

- AbstractDropdown: Extend this class to effortlessly implement dropdown components. It simplifies the management of
menu items and offers customizable configurations for rendering dropdown elements.

- AbstractNavBar: Use this class as a basis for crafting navigation bar components. It provides flexibility in rendering
brand elements, menus, and additional content, with customizable attributes and default configurations.

- AbstractToggle: Extend this class to create toggle components with ease. It supports various types (e.g., button, link)
and offers functionality for rendering toggle elements using customizable templates, attributes, and content.

- Item: This class represents individual items within a menu or breadcrumb. It allows for easy management of item attributes
and content.

- Menu: This class represents a collection of menu items. It facilitates the organization and rendering of menu items within
dropdowns, navigation bars, or other menu-based components.

Simply extend these abstract classes and apply their default configurations to swiftly integrate and customize UI components
tailored to your application's requirements.

## Installation

The preferred way to install this extension is through [composer](https://getcomposer.org/download/).

Either run

```shell
composer require --prefer-dist ui-awesome/html-core-component:^0.1
```

or add

```json
"ui-awesome/html-core-component": "^0.1"
```

to the require-dev section of your `composer.json` file. 

## Usage

To use the classes in your project, you need to extend them in your custom components.

For example, to create a custom breadcrumb component, you can extend the `AbstractBreadcrumb` class:

```php
use UIAwesome\Html\Core\Component\AbstractBreadcrumb;

class CustomBreadcrumb extends AbstractBreadcrumb
{
    // Custom implementation
}
```

## Testing

[Check the documentation testing](docs/testing.md) to learn about testing.

## Support versions

[![PHP81](https://img.shields.io/badge/PHP-%3E%3D8.1-787CB5)](https://www.php.net/releases/8.1/en.php)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Our social networks

[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/Terabytesoftw)
