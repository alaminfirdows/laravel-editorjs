![image](https://user-images.githubusercontent.com/30468274/162574530-f9af87ef-79d4-41de-8ddb-9ebf60563ac9.png)

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

## Override templates

If you create a file with the same name in your resources/views/blocks/ directory (example: resources/views/blocks/table.blade.php) you can override the default template used for that block.
Be aware these do not automatically update when you update versions so you will need to do manual updates.

## Versioning

| Laravel | Supported |
| ------- | --------- |
| 10.x    | ✅ 2.x    |
| 9.x     | ✅ 1.1    |
| 8.x     | ✅ 1.0    |

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Al-Amin Firdows](https://github.com/alaminfirdows)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
