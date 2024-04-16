<?php 

function dd($value)
{
    echo '<div style="border: 1px solid #ddd; margin: 10px; padding: 10px; background-color: #f8f8f8;">';
    echo '<div style="background-color: #333; color: #fff; padding: 8px; font-weight: bold; margin-bottom: 5px;">Debug</div>';
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    echo '</div>';
    die();
}
function obj($data){
    return json_decode(json_encode($data), false);
}
function isNullOrEmpty($value)
{
    return !isset($value) || empty($value);
}
function sanitizeInput($input)
{
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function toTitleCase($string)
{
    return ucwords(strtolower($string));
}
function flattenArray($array)
{
    $result = [];
    array_walk_recursive($array, function ($value) use (&$result) {
        $result[] = $value;
    });
    return $result;
}
function startsWith($haystack, $needle)
{
    return strncmp($haystack, $needle, strlen($needle)) === 0;
}
function endsWith($haystack, $needle)
{
    return substr_compare($haystack, $needle, -strlen($needle)) === 0;
}
function truncateString($string, $length, $suffix = '...')
{
    if (strlen($string) > $length) {
        $string = substr($string, 0, $length - strlen($suffix)) . $suffix;
    }
    return $string;
}
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
