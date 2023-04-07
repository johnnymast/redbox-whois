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

namespace Redbox\Whois\Tests\Unit;

use Redbox\Whois\Tests\Transport\Adapters\UnsupportedAdapter;
use Redbox\Whois\Tests\Transport\Adapters\SuccessfulAdapter;
use Redbox\Whois\Tests\Transport\Adapters\FailingAdapter;
use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\WhoisClient;

test(
    'Lookup should throw an exception if the given domain is not a valid domain.',
    function () {

        expect(
        /**
         * @throws \Redbox\Whois\Exceptions\WhoisException
         */
            fn() => (new WhoisClient())->lookup('invalid')
        )->toThrow(WhoisException::class, 'invalid is not a valid domain name.');
    }
);

test(
    'Lookup should throw an exception if there is no whois server found for the top-level domain.',
    function () {

        expect(
        /**
         * @throws \Redbox\Whois\Exceptions\WhoisException
         */
            fn() => (new WhoisClient())->lookup('lookout.example')
        )->toThrow(WhoisException::class, 'We don\'t have a whois server for example.');
    }
);

test(
    'Lookup should throw an exception if the chosen adapter does not support the machine\'s configuration.',
    function () {
        //Redbox\Whois\Tests\Transport\Adapters
        expect(
        /**
         * @throws \Redbox\Whois\Exceptions\WhoisException
         */
            fn() => (new WhoisClient())->getTransport()->setAdapter(new UnsupportedAdapter())
        )->
        toThrow(WhoisException::class, 'Adapter not supported');
    }
);

test(
    'Lookup should throw an exception if there was an issue communicating with the whois server.',
    function () {
        expect(
        /**
         * @throws \Redbox\Whois\Exceptions\WhoisException
         */
            function () {
                $whois = new WhoisClient();
                $whois->getTransport()->setAdapter(new FailingAdapter());
                $whois->lookup('example.nl');
            }
        )->
        toThrow(WhoisException::class, 'We had a communication problem with the whois server.');
    }
);

test(
    /**
     * @throws \Redbox\Whois\Exceptions\WhoisException
     */
    'getOutput should return the output of the whois server.',
    function () {
        $whois = new WhoisClient();
        $whois->getTransport()->setAdapter(new SuccessfulAdapter());
        $whois->lookup('example.nl');
        expect($whois->getOutput())->toContain('This is a success response from the server.');
    }
);

test(
    /**
     * @throws \Redbox\Whois\Exceptions\WhoisException
     */
    'saveOutput should save the output of the whois server into a file.',
    function () {

        $path = realpath(__DIR__ . '/../Data');
        $file = $path . '/response.txt';

        if (file_exists($file)) {
            unlink($file);
        }

        expect(file_exists($file))->toBeFalse();

        $whois = new WhoisClient();
        $whois->getTransport()->setAdapter(new SuccessfulAdapter());
        $whois->lookup('example.nl')
            ->saveOutput($file);

        expect($file)->toBeFile();

        $content = file_get_contents($file);

        expect($content)->toContain('This is a success response from the server.');
    }
);

test(
    /**
     * @throws \Redbox\Whois\Exceptions\WhoisException
     */
    'domain wrap around resolve.',
    function () {

        expect(WhoisClient::domain('server.nl'))->toBeInstanceOf(WhoisClient::class);
    }
);
