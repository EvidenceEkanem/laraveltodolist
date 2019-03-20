# laravelTodoList

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require evidenceekanem/laraveltodolist
```

## Usage

You need to run migrations to create necessary tables

```bash
php artisan migrate"
```

You can publish the configuration file using this command:

```bash
php artisan vendor:publish --tag=public
```

Then you are ready to get runnings. Just visit 

```bash
http://{{site-url}}/tasks
```

Add task categories and tasks. Enjoy.

Developed by 

Evidence Ekanem
@evidenceetinih

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email ekanemevidence@gmail.com instead of using the issue tracker.

## Credits

- [evidenceekanem][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/evidenceekanem/laraveltodolist.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/evidenceekanem/laraveltodolist.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/evidenceekanem/laraveltodolist/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/evidenceekanem/laraveltodolist
[link-downloads]: https://packagist.org/packages/evidenceekanem/laraveltodolist
[link-travis]: https://travis-ci.org/evidenceekanem/laraveltodolist
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/evidenceekanem
[link-contributors]: ../../contributors
