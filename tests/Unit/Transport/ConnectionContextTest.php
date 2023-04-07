<?php

/**
 * This file is part of the Redbox-Whois package.
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

use Redbox\Whois\Transport\ConnectionContext;

beforeEach(function () {
    $this->storage = new ConnectionContext('example.com', 8080, 'test data');
});

test('getServer should return the server', function () {
    expect($this->storage->getServer())->toEqual('example.com');
});

test('getPort should return the port', function () {
    expect($this->storage->getPort())->toEqual(8080);
});

test('getData should return the data', function () {
    expect($this->storage->getData())->toEqual('test data');
});
