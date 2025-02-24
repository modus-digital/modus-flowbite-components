# Modus UI

Modus UI is a Blade component library for Laravel, designed to streamline the development of dashboards and user interfaces. Built with Tailwind CSS and Flowbite, Modus UI offers a robust and extensible foundation for modern Laravel applications.

## Features

- **Laravel Compatibility:** Supports Laravel versions 10 through 11.
- **PHP Compatibility:** Works with PHP 8.2 through 8.4.
- **Modern Frontend:** Built on Tailwind CSS and Flowbite for styling and components.
- **Easy Customization:** Publish views and configurations to tailor the library to your needs.

---

> [!WARNING]
> This package is currently in development and is not yet ready for production use.

---

## Installation

### Step 1: Install the package via Composer

```bash
composer require modus-digital/modus-ui
```

Add this line to your `tailwind.config.js` file under `content`:

```js
module.exports = {
    content: [
        "./vendor/modus-digital/modus-ui/src/View/Components/**/**/*.php",
        "./vendor/modus-digital/modus-ui/resources/views/**/**/*.blade.php",
    ],
}
```

### Step 2: Publish configuration

If you want to customize the package, you can publish the configuration using:

```bash
php artisan vendor:publish --tag=modus-ui-config
```

- **Configuration:** Publishes the `modus-ui.php` file to your `config` directory.

---

## Usage

### Blade Directive
Add the following blade directive to your layout file:

```blade
@modusUiScripts
```

### Blade Components
Modus UI provides a collection of Blade components that are automatically registered. You can use them in your Blade templates like this:

```blade
<x-modus-ui::button>
    Click Me
</x-modus-ui::button>
```

Refer to the [documentation](#) for a full list of available components and usage examples.

---

## Service Provider Details

### Automatic Registration
The `ModusUIServiceProvider` handles automatic registration of:

- Blade view files from `resources/views/vendor/modus-ui`.
- Configurations from `config/modus-ui.php`.

### Customizations
You can override these defaults by publishing the respective resources, as shown above.

---

## Requirements

- PHP 8.2 - 8.4
- Laravel 10 - 11
- Tailwind CSS
- Flowbite
- Alpine.js
- Node.js and npm

---

## Contributing
Contributions are welcome! Please submit a pull request or open an issue if you encounter any bugs or have feature suggestions.

---

## License
Modus UI is open-source software licensed under the [MIT license](LICENSE).

