# Delivery Calculator Client
### Requirements

- PHP >= 8.0
- Curl

### Example of usage

1. Install packages
```shell
composer install
```

2.Run php script

a) for Slow Delivery

```shell
php index.php slow 1000400000000 1000400000000 1.2
```

b) for Fast Delivery

```shell
php index.php fast 1000400000000 1000400000000 5.2
```

c) for delivery calculation for country by ID

```shell
php index.php fast 1000400000000 1000400000000 5.2 8
```

### Tests

```shell
composer unit-test
```