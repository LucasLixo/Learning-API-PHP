<div align="center">

# API

## Overview

</div>

## Find results by tables .CSV

- This API provides responses in JSON format based on CSV files stored in the `api/ folder`. Requests are made from the application located in the `app/ folder`.

```
root/
 |-- app/               # Client
 |-- api/               # API
```

## Example in [Index.php](./index.php)
```php
<?php

require_once(dirname(__FILE__) . '/config/config.php');
require_once(dirname(__FILE__) . '/app/index.php');

header("Content-Type:application/json");

echo api_request(/* class */'init', /* function */'customers', /* method */'GET', /* variables */[], /* user */'admin', /* pass */'password123');
die(1);

?>
```

## Results

```json
{
  "method": "GET",
  "class": "init",
  "function": "customers",
  "lenght": 11,
  "results": [
    [
      "Trash",
      "Nome",
      "Nascimento",
      "Email",
      "Capital",
      "Token"
    ],
    [
      "0",
      "Miguel",
      "25/04/1990",
      "Miguel@gmail.com",
      "2830761",
      "XGoduMCEVQuWur5cIqsqYMEmqALl6o6c"
    ],
    [
      "0",
      "Arthur",
      "12/09/1985",
      "Arthur@gmail.com",
      "26655",
      "28WFdzkH9y9YFuDchHjsxTucm7re5e14"
    ],
    [
      "0",
      "Gael",
      "03/11/2000",
      "Gael@gmail.com",
      "239673",
      "Bi6UQIZAJECW29NviNSSQWQJlKYtaMFL"
    ],
    [
      "0",
      "Heitor",
      "08/07/1998",
      "Heitor@gmail.com",
      "223568",
      "sUAE0P2azgpzWFZTkGId7KJE65xgwr3z"
    ],
    [
      "0",
      "Helena",
      "15/02/1976",
      "Helena@gmail.com",
      "214890",
      "nptsmlzN8OOMowLk1kyH0CcvKWWMGm6T"
    ],
    [
      "0",
      "Alice",
      "29/06/1995",
      "Alice@gmail.com",
      "20381",
      "0Rh1CyO6Q5rE4w8TJNWDzbEU31CDLjwC"
    ],
    [
      "0",
      "Theo",
      "10/12/1983",
      "Theo@gmail.com",
      "19863",
      "LEULxFqeJOHELIdZJ3WMKRFqcrfTPfyn"
    ],
    [
      "0",
      "Laura",
      "21/03/2002",
      "Laura@gmail.com",
      "252522",
      "zB2GAUc6cLaEVwnLdgJOjhcxwtzKngPa"
    ],
    [
      "0",
      "Kaio",
      "03/09/2000",
      "Kaio@gmail.com",
      "186448",
      "GF7kKSUkp8z646oxV5x9tijQKQQ9sulU"
    ],
    [
      "1",
      "Alice",
      "09/12/2003",
      "Alice@gmail.com",
      "832902",
      "RmItBNRq4w7JR9vO9A2VevBHVGgkgDDa"
    ]
  ]
}
```
