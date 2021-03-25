# PHP library for Taktik Registr API
This PHP library allows you to work with Taktik Registr API. [Full API documentation](https://registr.etaktik.cz/docs) 

<img src="https://upload.wikimedia.org/wikipedia/commons/3/35/TAKTIK_International_logo.jpg" alt="TAKTIK" width="240" />

## Install
```
composer require taktik/php-lib-registr
```

## Versions
| State       | Version | Branch   | PHP      |
|-------------|---------|----------|----------|
| stable      | `1.0`  | `master` | `>= 7.3` |

## Need to be prepared
Please prepare a simple interface on your project for data synchronization. 
API will ping to url ```/registr-taktik-import/``` and sending JSON data. 
### Example usage
```php
$fp = fopen('php://input', 'r');
$f = json_decode(stream_get_contents($fp), true);

/* JSON example 
    {
        "user:": {
            "uid": "e7urzbVMhIf2TwywnzusCN9YesBghB2ywofzPwiMJG4RATvlayHKaQvT5a8INF4XYXWncs2Rb6cbPyzaMe8iU5QQwJENRrKPmJ9RpMtcCDRRQNTzE1FdcPnNcZB9O02q",
            "email": "johnjohnson@etaktik.cz",
            "phone": "123456789",
            "gender": 1,
            "firstname": "John",
            "lastname": "Johnson",
            "degreeBefore": "Mgr.",
            "degreeAfter": "DiS."
        }
    }
*/

if ($f['user']['uid'] > '') {
    //do action for user update, example: 
    mysqli_query('UPDATE user SET ? WHERE uid = ? ', $f['user'], $f['user']['uid']);
}
if ($f['school']['uid'] > '') {
    //do action for school update, example: 
    mysqli_query('UPDATE school SET ? WHERE uid = ? ', $f['school'], $f['school']['uid']);
}
```
# Configuration array
| Key            | Name                                   | Required                     | Type    | Note               |
|----------------|----------------------------------------|------------------------------|---------|--------------------|
| secret_key     | Unique secret key for your application | Yes - Login / Register       | string  | 16 characters      |
| x_taktik_token | Unique token for your application      | Yes - Login / Register       | string  | 64 characters      |
| bearer         | JWT token from login or registration   | Yes - GET, POST, PUT, DELETE | JWT key |                    |
| version        | API version                            | No                           | string  | only '1.0' allowed |
| dev            | Choose between live or dev server      | No                           | boolean | true or false      |
### Example usage
```php
include '../../vendor/autoload.php';

$conf = [
    'secret_key' => 'YOUR_SECRET_KEY',
    'x_taktik_token' => 'YOUR_X_TAKTIK_TOKEN',
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN',
    'version' => '1.0'
    'dev' => true
];
```

# User
API provides collecting data from users, inserting, updating and deleting.
### Example usage
```php
include '../../vendor/autoload.php';

$conf = [
    'secret_key' => 'YOUR_SECRET_KEY',
    'x_taktik_token' => 'YOUR_X_TAKTIK_TOKEN'
];

$api = new TaktikRegistr\TaktikRegistr($conf);

$user = $api->user()->login('login', 'password');

//You can save it to cookie, for later use.
setcookie("user_token", $user->getToken(), $user->getExpiration(), "/");
```
For more examples [click here](src/TaktikRegistr/User/readme.md). 

# School
API provides collecting data from schools, inserting, updating and deleting.
### Example usage
```php
include '../../vendor/autoload.php';

$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];

$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'SCHOOL_UNIQUE_ID';
$school = $api->school()->get($uid);

$uid = $school->getUID();
```
For more examples [click here](src/TaktikRegistr/School/readme.md). 