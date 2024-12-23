# Guzzle Factory

Guzzle factory for every day simple configuration

## Installation

```
composer require d3/guzzle-factory
```

## Usage

```
$guzzleFactory = GuzzleFactory::create();
$guzzleFactory->setUserAgent('myApi-php-client/1.0.0'));
$guzzleFactory->addFileLogger('myPluginLogger', 'plugin_requests.log', Logger::DEBUG, 5);
$guzzleFactory->setMessageFormatter(
    '{method} {uri} HTTP/{version} {req_body}'.PHP_EOL.'RESPONSE: {code} - {res_body}',
    ['myUsername', 'myPassword']
);
$httpClient = $guzzleFactory->getGuzzle('https://remoteApi.com');
```

## Licence
(21.12.2024)

Distributed under the GPLv3 licence

```
Copyright (c) D3 Data Development (Inh. Thomas Dartsch)

Diese Software wird unter der GNU GENERAL PUBLIC LICENSE Version 3 vertrieben.
```
