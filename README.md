# Laravel-Editor.js

A simple editor.js html parser for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/alaminfirdows/laravel-editorjs.svg?style=for-the-badge)](https://packagist.org/packages/alaminfirdows/laravel-editorjs)
[![Total Downloads](https://img.shields.io/packagist/dt/alaminfirdows/laravel-editorjs.svg?style=for-the-badge)](https://packagist.org/packages/alaminfirdows/laravel-editorjs)

---

## Installation

You can install the package via composer:

```bash
composer require alaminfirdows/laravel-editorjs
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel_editorjs-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel_editorjs-views"
```

## Usage

```php
use App\Models\Post;

$post = Post::find(1);
echo LaravelEditorJs::render($post->body);
```

Defining An Accessor

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AlAminFirdows\LaravelEditorJs\Facades\LaravelEditorJs;

class Post extends Model
{
    public function getBodyAttribute()
    {
        return LaravelEditorJs::render($this->attributes['body']);
    }
}

$post = Post::find(1);
echo $post->body;
```

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Credits

-   [Al-Amin Firdows](https://github.com/alaminfirdows)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
