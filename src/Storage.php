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

class Storage
{
    /**
     * Container constructor.
     *
     * @param array $container
     */
    public function __construct(protected array $container = [])
    {
    }

    /**
     * Add a value to the container.
     *
     * @param string $key   The key to add.
     * @param mixed  $value The value to add with the key.
     *
     * @return void
     */
    public function add(string $key, mixed $value): void
    {
        $this->container[$key] = $value;
    }

    /**
     * Remove a value from the container.
     *
     * @param string $key The key to remove.
     *
     * @return void
     */
    public function remove(string $key): void
    {
        unset($this->container[$key]);
    }

    /**
     * Get a value from the container.
     *
     * @param string     $key     The key to get.
     * @param mixed|null $default The default value to return if the key does not exist.
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed
    {
        if ($this->has($key)) {
            return $this->container[$key];
        }
        return $default;
    }

    /**
     * Check if a key exist in the container.
     *
     * @param string $key The key to check.
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->container[$key]);
    }

    /**
     * Count the number of items in the
     * container.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_keys($this->container));
    }

    /**
     * Return all items in the
     * container.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->container;
    }
}
