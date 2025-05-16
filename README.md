![stability mature](https://img.shields.io/badge/stability-mature-008000.svg)
[![latest tag](https://img.shields.io/packagist/v/d3/guzzle-factory?label=release)](https://packagist.org/packages/d3/guzzle-factory)
[![MIT License](https://img.shields.io/packagist/l/d3/guzzle-factory)](https://git.d3data.de/D3Public/guzzleFactory/src/branch/main/LICENSE.md)

# Guzzle Factory

Guzzle factory for everyday simple configuration

## Installation

```
composer require d3/guzzle-factory
```

## Usage

```
$guzzleFactory = GuzzleFactory::create();
$guzzleFactory->setUserAgent('myApi-php-client/1.0.0'));
$guzzleFactory->addConfiguredLogger($logger);
$guzzleFactory->setMessageFormatter(
    '{method} {uri} HTTP/{version} {req_body}'.PHP_EOL.'RESPONSE: {code} - {res_body}',
    ['myUsername', 'myPassword']
);
$guzzleFactory->setMessageLevel(Logger::INFO);
$httpClient = $guzzleFactory->getGuzzle('https://remoteApi.com');
```

## Licence of this software (Guzzle factory) [MIT]

(01.01.2025)

```
Copyright (c) D3 Data Development (Inh. Thomas Dartsch)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
```