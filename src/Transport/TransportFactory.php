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

namespace Redbox\Whois\Transport;

use Redbox\Whois\Interfaces\Transport\TransportInterface;
use Redbox\Whois\Transport\Adapters\Stream;

class TransportFactory
{
    /**
     * Build a connection to the whois server.
     *
     * @throws \Redbox\Whois\Exceptions\WhoisException
     *
     * @return \Redbox\Whois\Interfaces\Transport\TransportInterface
     */
    public static function build(): TransportInterface
    {
        // TODO: This function might be extended to support more adapters.

        $client = new Client();
        $client->setAdapter(new Stream());

        return $client;
    }
}
