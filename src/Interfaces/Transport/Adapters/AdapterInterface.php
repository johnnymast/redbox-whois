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

namespace Redbox\Whois\Interfaces\Transport\Adapters;

use BadFunctionCallException;
use Redbox\Whois\Interfaces\Transport\RequestInterface;
use Redbox\Whois\Transport\Adapters\Stream;
use Redbox\Whois\Transport\ConnectionContext;

interface AdapterInterface
{
    /**
     * Since PSR-4 does not allow constructors to throw exceptions
     * we need to get creative. Every Adapter needs to verify that it can
     * be used.
     *
     * @throws BadFunctionCallException
     * @return bool
     */
    public function verifySupport(): bool;


    /**
     * Provide the adapter with information on
     * how to connect to the target server.
     *
     * @param \Redbox\Whois\Interfaces\Transport\RequestInterface $request Information on how to connect to the server.
     *
     * @return \Redbox\Whois\Transport\Adapters\Stream
     */
    public function setRequest(RequestInterface $request): AdapterInterface;

    /**
     * @return mixed
     */
    public function open(): AdapterInterface;

    /**
     * @return mixed
     */
    public function close(): AdapterInterface;

    /**
     * Send information to the server.
     *
     * @param string|null $data The data to send to the host.
     *
     * @return bool|string
     */
    public function send(string $data = null): bool|string;
}
