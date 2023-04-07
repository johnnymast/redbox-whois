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

namespace Redbox\Whois\Tests\Unit\Transport\Adapters;

use Redbox\Whois\Transport\Adapters\Stream;

test(
    'Send should return false if the stream is not open.',
    function () {
        $adapter = new Stream();
        expect($adapter->send())->toBeFalse();
    }
);
