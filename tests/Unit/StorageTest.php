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

use Redbox\Whois\Storage;

beforeEach(function () {
    $this->storage = new Storage();
});

test(
    'has should return true if a key has been set',
    function () {
        $this->storage->add('existing_key', 'my_value');
        expect($this->storage->has('existing_key'))->toBeTrue()
            ->and($this->storage->has('non_existing_key'))->toBeFalse();
    }
);

test(
    'has should return false if a key has not been set',
    function () {
        expect($this->storage->has('non_existing_key'))->toBeFalse();
    }
);

test(
    'add should set a value in the storage.',
    function () {
        $this->storage->add('existing_key', 'my_value');
        expect($this->storage->get('existing_key'))->toEqual('my_value')
            ->and($this->storage->get('non_existing_key'))->toBeNull();
    }
);

test(
    'remove should actually remove they given key and value from the storage.',
    function () {
        $this->storage->add('existing_key', 'my_value');
        expect($this->storage->count())->toEqual(1)
            ->and($this->storage->all())->toEqual(['existing_key' => 'my_value']);

        $this->storage->remove('existing_key');

        expect($this->storage->count())->toEqual(0)
            ->and($this->storage->all())->toEqual([])
            ->and($this->storage->has('existing_key'))->toBeFalse()
            ->and($this->storage->has('existing_key'))->toBeFalse();
    }
);

test(
    'get should return the the value of a given key.',
    function () {
        $this->storage->add('my_key', 'my_value');
        expect($this->storage->get('my_key'))->toEqual('my_value');
    }
);

test(
    'get should return the default value if the key does not exist.',
    function () {
        expect(
            $this->storage->get('non_existing_key', 'default_value')
        )->toEqual('default_value');
    }
);

test(
    'count should return the number of keys set on the storage',
    function () {
        expect($this->storage->count())->toEqual(0);

        $this->storage->add('my_first_key', 'my_first_value');
        $this->storage->add('my_second_key', 'my_second_value');

        expect($this->storage->count())->toEqual(2);
    }
);

test(
    'all should return all keys and values set in the storage.',
    function () {
        expect($this->storage->count())->toEqual(0)
            ->and($this->storage->all())->toEqual([]);

        $this->storage->add('my_first_key', 'my_first_value');
        $this->storage->add('my_second_key', 'my_second_value');

        expect($this->storage->count())->toEqual(2)
            ->and($this->storage->all())->toEqual([
                'my_first_key' => 'my_first_value',
                'my_second_key' => 'my_second_value'
            ]);
    }
);
