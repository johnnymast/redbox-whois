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

require 'autoload.php';

use Redbox\Whois\Exceptions\WhoisException;
use Redbox\Whois\WhoisClient;

try {

    $whois = new WhoisClient();
    $result = $whois->lookup('google.nl')
        ->getOutput();

    echo $result;

} catch (WhoisException $e) {
    echo $e->getMessage();
}

