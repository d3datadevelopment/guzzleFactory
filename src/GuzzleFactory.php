<?php

/**
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <info@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */

namespace D3\GuzzleFactory;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class GuzzleFactory
{
    use HeaderTrait;
    use LoggerTrait;
    use MessageFormatterTrait;

    public static function create()
    {
        return new GuzzleFactory();
    }

    public function getGuzzle(string $baseUri): Client
    {
        return new Client([
                 'handler' => $this->getStack(),
                 'base_uri' => $baseUri,
                 'headers' => [
                     'Content-Type' => $this->getContentType(),
                     'Accept'       => $this->getAccept(),
                     'User-Agent'   => $this->getUserAgent()
                 ]
             ]);
    }

    protected function getStack(): HandlerStack
    {
        $stack = HandlerStack::create();

        foreach ($this->getLoggers() as $logger) {
            $stack->push( Middleware::log( $logger, $this->getMessageFormatter(), $this->getMessageLevel() ) );
        }

        return $stack;
    }
}
