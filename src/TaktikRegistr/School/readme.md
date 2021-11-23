# School API examples
### Library including
```php
include '/vendor/autoload.php';
```
or
```php
use TaktikRegistr\TaktikRegistr;
```

### Get school data [API](https://registr.etaktik.cz/docs#operation/get-school)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'SCHOOL_UNIQUE_ID';
$school = $api->school()->get($uid);

$uid = $school->getUID();
$name = $school->getName();
$street = $school->getStreet();
$city = $school->getCity();
$zip = $school->getZip();
$cin = $school->getCin();
$redizo = $school->getRedizo();
$country = $school->getCountry();
```
### Search schools [API](https://registr.etaktik.cz/docs#operation/search-school)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$search = [
    'query' => 'What i want to search',
    'limit' => 50,
    'page' => 1,
];

$schools = $api->school()->search($search);
foreach ($schools as $school) {
    $uid = $school->getUID();
    $name = $school->getName();
    $street = $school->getStreet();
    $city = $school->getCity();
    $zip = $school->getZip();
    $cin = $school->getCin();
    $redizo = $school->getRedizo();
    $country = $school->getCountry();
}
```
### Delete school [API](https://registr.etaktik.cz/docs#operation/delete-school)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'SCHOOL_UNIQUE_ID';
$school = $api->school()->delete($uid);

if ($school->getErrorCode() === 404) {
    echo "School not exists.";
}
```
### Update school [API](https://registr.etaktik.cz/docs#operation/update-school)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$uid = 'SCHOOL_UNIQUE_ID';
$data = [
    'name' => 'School from API',
    'street' => 'Street',
    'city' => 'City',
    'zip' => '12345',
    'cin' => '123456789',
    'redizo' => '123456789',
    'country' => 'cz'
];

$school = $api->school()->update($uid, $data);

if ($school->getErrorCode() > 0) {
    echo "Error with update return code: ".$school->getErrorCode();
    exit;
}
```
### Insert school [API](https://registr.etaktik.cz/docs#operation/insert-school)
```php
$conf = [
    'bearer' => 'YOUR_GENERATED_TOKEN_FROM_LOGIN'
];
$api = new TaktikRegistr\TaktikRegistr($conf);

$data = [
    'name' => 'School from API',
    'street' => 'Street',
    'city' => 'City',
    'zip' => '12345',
    'cin' => '123456789',
    'redizo' => '123456789',
    'country' => 'cz'
];

$school = $api->school()->insert($data);

if ($school->getErrorCode() > 0) {
    echo "Error with insert return code: ".$school->getErrorCode();
    exit;
}
$new_uid = $school->getUID();
```