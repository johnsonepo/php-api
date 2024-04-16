<?php

$ch = curl_init();


curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/customers");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json', 
    // Add any additional headers here if needed
));

$response = curl_exec($ch);

if (curl_error($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    if (empty($response)) {
        echo "No response received from the API.". PHP_EOL;
    } else {
        echo "Response received from the API: ". PHP_EOL;
        var_dump($response);
    }
}

curl_close($ch);

