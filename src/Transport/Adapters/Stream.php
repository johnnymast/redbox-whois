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

namespace Redbox\Whois\Transport\Adapters;

use Redbox\Whois\Interfaces\Transport\Adapters\AdapterInterface;
use Redbox\Whois\Interfaces\Transport\RequestInterface;

class Stream implements AdapterInterface
{
    protected mixed $stream = null;

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
        return true;
    }

    /**
     * Provide the adapter with information on
     * how to connect to the target server.
     *
     * @param \Redbox\Whois\Interfaces\Transport\RequestInterface $request Information on how to connect to the server.
     *
     * @return \Redbox\Whois\Transport\Adapters\Stream
     */
    public function setRequest(RequestInterface $request): Stream
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Open a connection to the server.
     *
     * @return \Redbox\Whois\Transport\Adapters\Stream
     */
    public function open(): Stream
    {
        if ($this->request !== null) {
            $this->stream = fsockopen($this->request->getServer(), $this->request->getPort());
        }

        return $this;
    }

    /**
     * Close the connection.
     *
     * @return \Redbox\Whois\Transport\Adapters\Stream
     */
    public function close(): Stream
    {
        if ($this->stream !== null) {
            fclose($this->stream);
        }
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

        if (!$this->stream) {
            return false;
        }

        $return = '';

        restore_error_handler();
        stream_set_timeout($this->stream, 3);
        stream_set_blocking($this->stream, false);

        fputs($this->stream, $data . "\r\n");

        while (!feof($this->stream)) {
            $return .= fgets($this->stream);
        }

        return $return;
    }
}
