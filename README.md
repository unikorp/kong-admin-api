# kong-admin-api

[![Documentation](https://img.shields.io/badge/doc-v0.0.1--alpha.5-blue.svg)](http://docs.unikorp.io/kong-admin-api/api/v0.0.1-alpha.5/)
[![Build Status](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/unikorp/kong-admin-api/?branch=master)
[![Dependency Status](https://dependencyci.com/github/unikorp/kong-admin-api/badge)](https://dependencyci.com/github/unikorp/kong-admin-api)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/2c4382ff-9689-49ca-9fe5-b1923e348579/mini.png)](https://insight.sensiolabs.com/projects/2c4382ff-9689-49ca-9fe5-b1923e348579)

## Installation

### Step 1: Download the Library

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this library:

```console
$ composer require "unikorp/kong-admin-api"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2: Download a client implementation

If your project is not already using a client implementation, select one form
the list of virtual packages [php-http/client-implementation](https://packagist.org/providers/php-http/client-implementation),
and then download it.

> For this example we are going to use `php-http/guzzle6-adapter`

```console
$ composer require "php-http/guzzle6-adapter"
```

## Usage

```php
<?php

require_once('./vendor/autoload.php');

// configure KongAdminApi client
$configurator = new \Unikorp\KongAdminApi\Configurator();
$configurator->setBaseUri('http://example.com:8001/');

// create KongAdminApi client
$client = new \Unikorp\KongAdminApi\Client($configurator);

// retrieve node information
$response = $client->getNode('information')->retrieveNodeInformation();
$information = json_decode($response->getBody()->getContents(), true);

var_dump($information);
```
