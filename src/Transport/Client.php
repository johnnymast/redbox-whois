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

use Redbox\Whois\Interfaces\Transport\Adapters\AdapterInterface;
use Redbox\Whois\Interfaces\Transport\TransportInterface;
use Redbox\Whois\Interfaces\Transport\RequestInterface;
use Redbox\Whois\Exceptions\WhoisException;

class Client implements TransportInterface
{
    public const WHOIS_PORT = 43;

    public function __construct(protected ?AdapterInterface $adapter = null)
    {
    }

    /**
     * Set the Transport adapter we will use to communicate
     * to Twitch.
     *
     * @param \Redbox\Whois\Interfaces\Transport\Adapters\AdapterInterface $adapter
     *
     * @throws \Redbox\Whois\Exceptions\WhoisException
     *
     * @return void
     */
    public function setAdapter(AdapterInterface $adapter): void
    {
        /**
         * Not a adapter throws a BadFunctionCallException or true
         * if usable.
         */
        if ($adapter->verifySupport() === true) {
            $this->adapter = $adapter;
        } else {
            throw new WhoisException("Adapter not supported");
        }
    }

    /**
     * Return the configured Adapter.
     *
     * @return \Redbox\Whois\Interfaces\Transport\Adapters\AdapterInterface
     */
    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    /**
     * Send a request to the server.
     *
     * @param \Redbox\Whois\Interfaces\Transport\RequestInterface $request The request to send.
     *
     * @return string|bool
     */
    public function sendRequest(RequestInterface $request): string|bool
    {
        $adapter = $this->getAdapter();

        $data = $adapter
            ->setRequest($request)
            ->open()
            ->send($request->getData());

        $adapter->close();

        if (!$data) {
            return false;
        }

        return $data;
    }
}
