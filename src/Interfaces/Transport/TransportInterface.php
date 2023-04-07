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

namespace Redbox\Whois\Interfaces\Transport;

use Redbox\Whois\Transport\ConnectionContext;

interface TransportInterface
{
    /**
     * Send a request to the server.
     *
     * @param \Redbox\Whois\Interfaces\Transport\RequestInterface $request The request to send.
     *
     * @return mixed
     */
    public function sendRequest(RequestInterface $request): mixed;
}
