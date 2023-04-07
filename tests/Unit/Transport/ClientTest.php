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

namespace Redbox\Whois\Tests\Unit\Transport;

use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\Tests\Transport\Adapters\SupportedAdapter;
use Redbox\Whois\Tests\Transport\Adapters\UnsupportedAdapter;
use Redbox\Whois\Transport\Client;

test(
    'setAdapter should throw a WhoisException if the adapter does not support the machine\'s configuration.',
    function () {
        expect(
        /**
         * @throws \Redbox\Whois\Exceptions\WhoisException
         */
            fn() => (new Client())->setAdapter(new UnsupportedAdapter())
        )->toThrow(WhoisException::class, 'Adapter not supported');
    }
);

test(
    'getAdapter should return the adapter set to the client.',
    function () {
        $client = new Client();
        $adapter = new SupportedAdapter();

        $client->setAdapter($adapter);

        expect($client->getAdapter())->toEqual($adapter);
    }
);
