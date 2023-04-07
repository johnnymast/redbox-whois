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

namespace Redbox\Whois;

use Redbox\Whois\Interfaces\Transport\TransportInterface;
use Redbox\Whois\Transport\ConnectionContext;
use Redbox\Whois\Transport\TransportFactory;
use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\Transport\Client;

class WhoisClient
{
    protected string|bool $output = '';

    /**
     * Stores the transport layer..
     *
     * @var \Redbox\Whois\Interfaces\Transport\TransportInterface|null
     */
    protected ?TransportInterface $transport = null;

    /**
     * Whois constructor.
     *
     * @param \Redbox\Whois\Servers $servers
     */
    public function __construct(protected Servers $servers = new Servers())
    {
    }

    /**
     * Parse a tld from a uri.
     *
     * @param string $uri the uri to parse.
     *
     * @return mixed
     */
    private function tld(string $uri): mixed
    {
        $parts = explode('.', $uri);

        return count($parts) > 1 ? end($parts) : false;
    }

    /**
     * Create a way of communication between the client
     * and the server.
     *
     * @throws \Redbox\Whois\Exceptions\WhoisException
     */
    public function getTransport(): TransportInterface
    {
        if (!$this->transport) {
            $this->transport = TransportFactory::build();
        }
        return $this->transport;
    }

    /**
     * @param string $domain
     *
     * @throws \Redbox\Whois\Exceptions\WhoisException
     *
     * @throws \Exception
     * @return \Redbox\Whois\WhoisClient
     */
    public function lookup(string $domain): WhoisClient
    {

        $tld = $this->tld($domain) or
        throw new WhoisException("{$domain} is not a valid domain name.");

        $server = $this->servers->resolve($tld) or
        throw new WhoisException("We don't have a whois server for {$tld}.");

        $request = new ConnectionContext($server, Client::WHOIS_PORT);
        $request->setData($domain);

        $this->output = $this
            ->getTransport()
            ->sendRequest($request)
        or throw new WhoisException('We had a communication problem with the whois server.');

        return $this;
    }

    /**
     * Write the output of the Whois
     * query to a file.
     *
     * @param string $path The filename to write the output to.
     *
     * @return $this
     */
    public function saveOutput(string $path = 'whois.txt'): WhoisClient
    {
        if ($this->output) {
            file_put_contents($path, $this->output);
        }
        return $this;
    }

    /**
     * Return the output of the whois
     * query.
     *
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }

    /**
     * Quickly lookup a domain.
     *
     * @param string $domain The domain to lookup.
     *
     * @throws \Redbox\Whois\Exceptions\WhoisException
     *
     * @return \Redbox\Whois\WhoisClient
     */
    public static function domain(string $domain): WhoisClient
    {
        return (new static())
            ->lookup($domain);
    }
}
