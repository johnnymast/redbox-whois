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

use Redbox\Whois\WhoisClient;

try {

    $whois = new WhoisClient();
    echo $whois->lookup('google.com')
        ->getOutput();

} catch (Exception $e) {
}
