# User API examples
### Library including 
```php
include '/vendor/autoload.php';
```
or
```php
use TaktikRegistr\TaktikRegistr;
```

### Login user [API](https://registr.etaktik.cz/docs#operation/login)
```php
$conf = [
    'secret_key' => 'YOUR_SECRET_KEY',
    'x_taktik_token' => 'YOUR_X_TAKTIK_TOKEN'
];

$api = new TaktikRegistr\TaktikRegistr($conf);

$user = $api->user()->login('login', 'password');

//You can save it to cookie, for later use.
setcookie("user_token", $user->getToken(), $user->getExpiration(), "/");
```

### Get user data [API](https://registr.etaktik.cz/docs#operation/get-user)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'USER_UNIQUE_ID';
$user = $api->user()->get($uid);

$uid = $user->getUID();
$email = $user->getEmail();
$phone = $user->getPhone();
$gender = $user->getGender();
$firstname = $user->getFirstName();
$lastname = $user->getLastName();
$degreeBefore = $user->getDegreeBefore();
$degreeAfter = $user->getDegreeAfter();
```
### Delete user [API](https://registr.etaktik.cz/docs#operation/delete-user)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'USER_UNIQUE_ID';
$user = $api->user()->delete($uid);

if ($user->getErrorCode() === 404) {
    echo "User not exists.";
}
```
### Update user [API](https://registr.etaktik.cz/docs#operation/update-user)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'USER_UNIQUE_ID';
$data = [
    'email' => 'johnjohnson1@etaktik.cz',
    "password" => "myverylongpassword",
    "phone" => "123456789",
    "gender" => 1,
    "firstname" => "John",
    "lastname" => "Johnson",
    "degreeBefore" => "Mgr.",
    "degreeAfter" => "DiS."
];

$user = $api->user()->update($uid, $data);

if ($user->getErrorCode() > 0) {
    echo "Error with update return code: ".$user->getErrorCode();
    exit;
}
```
### Insert user [API](https://registr.etaktik.cz/docs#operation/insert-user)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'USER_UNIQUE_ID';
$data = [
    'email' => 'johnjohnson1@etaktik.cz',
    "password" => "myverylongpassword",
    "phone" => "123456789",
    "gender" => 1,
    "firstname" => "John",
    "lastname" => "Johnson",
    "degreeBefore" => "Mgr.",
    "degreeAfter" => "DiS."
];

$user = $api->user()->insert($data);

if ($user->getErrorCode() > 0) {
    echo "Error with insert return code: ".$user->getErrorCode();
    exit;
}
$new_uid = $user->getUID();
```