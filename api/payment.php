<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method

    $result = CallAPI("https://secure.myfees.lk/api/sch/payments", $_POST);
    $result = json_decode($result, true);

    // Check if $result is an array before trying to echo it
    if (is_array($result)) {
        print_r($result); // Output the array
    } else {
        echo $result; // Output as string
    }

    if (isset($result['id'])) {
        // Redirect to the payment URL
        header("Location: https://secure.myfees.lk/pay/" . $result['id']);
        exit; // Ensure script stops execution after redirection
    } else {
        print_r($result); // Output any error
    }
}

function CallAPI($url, $data)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

?>
