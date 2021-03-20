# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mohamedahmed01/simple-merkele.svg?style=flat-square)](https://packagist.org/packages/mohamedahmed01/simple-merkele)
[![Build Status](https://img.shields.io/travis/mohamedahmed01/simple-merkele/master.svg?style=flat-square)](https://travis-ci.com/mohamedahmed01/simple-merkele)
[![Quality Score](https://img.shields.io/scrutinizer/g/mohamedahmed01/simple-merkele.svg?style=flat-square)](https://scrutinizer-ci.com/g/mohamedahmed01/simple-merkele)
[![Total Downloads](https://img.shields.io/packagist/dt/mohamedahmed01/simple-merkele.svg?style=flat-square)](https://packagist.org/packages/mohamedahmed01/simple-merkele)

This is a very simple implemenation to merkle tree in which you can use multiple hashes
to create a merkele tree and compress it to a single hash .

## Installation

You can install the package via composer:

```bash
composer require mohamedahmed01/simple-merkele
```

## Usage

``` php

    //prepare your array of hashes
    $hashsArray=[
            hash('sha256', 'hello'),
            hash('sha256', 'goodbye'),
            hash('sha256', 'topofthemorning'),
            hash('sha256', 'sionara'),
            hash('sha256', 'areviditche'),
            hash('sha256', 'arregato'),
        ];
    //create new instance of simpleMerkele
    $merkele = new SimpleMerkele();
    //add your hashes to the inventory
    foreach ($hashsArray as $hash) {
        $merkele->addHash($hash);
    }
    //create the top hash
    $merkele->calulateTree(); //9b8dd5dd1f56d5fa17a67c10b8891c57e51f5fd36fe3a2d7e290d605840332d8
        
```

### Testing

``` bash
composer test
```

### Security

If you discover any security related issues, please email mohamedabdelmenem01@gmail.com instead of using the issue tracker.

## Credits

- [Mohamed Ahmed](https://github.com/mohamedahmed01)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

