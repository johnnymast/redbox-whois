# Redbox-whois (WORK IN PROGRESS)

[![Packagist](https://img.shields.io/packagist/v/redbox/whois.svg)](https://packagist.org/packages/redbox/whois)
[![Unit Tests](https://github.com/johnnymast/redbox-whois/actions/workflows/Tests.yml/badge.svg)](https://github.com/johnnymast/redbox-whois/actions/workflows/Tests.yml)
[![PhpCS](https://github.com/johnnymast/redbox-whois/actions/workflows/Phpcs.yaml/badge.svg)](https://github.com/johnnymast/redbox-whois/actions/workflows/Phpcs.yaml)
[![Test Coverage PHP Package](https://github.com/johnnymast/redbox-whois/blob/master/badges/coverage-badge.svg)](https://github.com/johnnymast/redbox-whois/actions/workflows/pest-coverage.yaml)

This is a Whois library i wrote to use for reconnaissance missions for my pen testing efforts. You could
use it your self because i make it really easy to use.

## Installation

```bash
$ composer require redbox/whois
```

## Usage

The package is flexible and easy use. Here are a few examples of how you could use the package.

### Simple static call

```php

use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\WhoisClient;

try {
    $whois = WhoisClient::domain('google.com')
        ->getOutput();

    echo $whois;

} catch (WhoisException $e) {
    echo $e->getMessage();
}
```

### Use it without the static call

The static call mentioned above is just a clever wrapper around the lookup function. You can instantiate the WhoisClient
your self and call the lookup function. Note as well we are using the getOutput() function to get the output of the
lookup.

```php

use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\WhoisClient;

try {

    $whois = new WhoisClient();
    $result = $whois->lookup('google.nl')
        ->getOutput();

    echo $result;

} catch (WhoisException $e) {
    echo $e->getMessage();
}

```

### Save the output to a file

The saveOutput function has an optional parameter which is the path to the file. If you don not specify a path the
output will be stored as whois.txt. The saveOutput function will return the WhoisClient object so you can chain it with
getOutput() if you wish.

```php

use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\WhoisClient;

try {

    $whois = new WhoisClient();
    $output = $whois->lookup('google.fr')
        ->saveOutput('output.txt')
        ->getOutput();

    echo $output;;

} catch (WhoisException $e) {
    echo $e->getMessage();
}


```

# The MIT License (MIT)

Copyright (c) 2023 Johnny Mast <mastjohnny@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.