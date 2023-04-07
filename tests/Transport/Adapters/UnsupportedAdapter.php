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

namespace Redbox\Whois\Tests\Transport\Adapters;

use Redbox\Whois\Interfaces\Transport\Adapters\AdapterInterface;
use Redbox\Whois\Interfaces\Transport\RequestInterface;

class UnsupportedAdapter implements AdapterInterface
{
    /**
     * Information about the connection.
     *
     * @var \Redbox\Whois\Interfaces\Transport\RequestInterface|null The request object.
     */
    protected ?RequestInterface $request = null;

    /**
     * If a adapter supports the current environment it will true if not it will return false.
     *
     * @return bool
     */
    public function verifySupport(): bool
    {
        return false;
    }

    /**
     * Provide the adapter with information on
     * how to connect to the target server.
     *
     * @param \Redbox\Whois\Interfaces\Transport\RequestInterface $request Information on how to connect to the server.
     *
     * @return \Redbox\Whois\Tests\Transport\Adapters\UnsupportedAdapter
     */
    public function setRequest(RequestInterface $request): UnsupportedAdapter
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Open a (fake) connection to a whois server.
     *
     * @return \Redbox\Whois\Tests\Transport\Adapters\UnsupportedAdapter
     */
    public function open(): UnsupportedAdapter
    {
        return $this;
    }

    /**
     * Close the (fake) connection.
     *
     * @return \Redbox\Whois\Tests\Transport\Adapters\UnsupportedAdapter
     */
    public function close(): UnsupportedAdapter
    {
        return $this;
    }

    /**
     * Send information to the server.
     *
     * @param string|null $data The data to send to the host.
     *
     * @return bool|string
     */
    public function send(string $data = null): bool|string
    {
        return false;
    }
}
