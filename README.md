# Modus UI

Modus UI is a Blade component library for Laravel, designed to streamline the development of dashboards and user interfaces. Built with Tailwind CSS and Flowbite, Modus UI offers a robust and extensible foundation for modern Laravel applications.

## Features

- **Laravel Compatibility:** Supports Laravel versions 8 through 11.
- **PHP Compatibility:** Works with PHP 7.4 through 8.4.
- **Modern Frontend:** Built on Tailwind CSS and Flowbite for styling and components.
- **Easy Customization:** Publish views and configurations to tailor the library to your needs.

---

## Installation

### Step 1: Install the package via Composer

```bash
composer require modusdigital/modus-ui
```

### Step 2: Publish configuration

If you want to customize the package, you can publish the configuration using:

```bash
php artisan vendor:publish --tag=modus-ui-config
```

- **Configuration:** Publishes the `modus-ui.php` file to your `config` directory.

---

## Usage

### Blade Components
Modus UI provides a collection of Blade components that are automatically registered. You can use them in your Blade templates like this:

```blade
<x-modus-ui::button type="blue">
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

- PHP 7.4 - 8.4
- Laravel 8 - 11
- Node.js and npm (for building frontend assets, if needed)

---

## Contributing
Contributions are welcome! Please submit a pull request or open an issue if you encounter any bugs or have feature suggestions.

---

## License
Modus UI is open-source software licensed under the [MIT license](LICENSE).

