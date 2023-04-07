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

use Redbox\Whois\Interfaces\Transport\RequestInterface;

class ConnectionContext implements RequestInterface
{
    public function __construct(protected string $server = '', protected int $port = 43, protected string $data = '')
    {
    }

    /**
     * @param string $data
     *
     * @return void
     */
    public function setData(string $data): void
    {
        $this->data = $data;
    }

    /**
     * Return the server.

     * @return string
     */
    public function getServer(): string
    {
        return $this->server;
    }

    /**
     * return the port number.
     *
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->data;
    }
}
