# Simple CMS Blog

Simple CMS Blog that can like or comment every posts and then can get notifications when posts from a user has been liked or commented

## Installation


```bash
composer install
php artisan key:generate
```

```bash
php artisan storage:link
php artisan migrate:fresh --seed
```


## Configuration

```php
FILESYSTEM_DRIVER=public
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
