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
use Redbox\Whois\Exceptions\WhoisTransportException;
use Redbox\Whois\WhoisClient;

$whois = new WhoisClient();
try {

    $output = $whois->lookup('google.com')
        ->saveOutput('output.txt')
        ->getOutput();

} catch (WhoisException|WhoisTransportException $e) {

}
