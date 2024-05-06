<?php
ob_start(); // Start output buffering

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method

    $result = CallAPI("https://secure.myfees.lk/api/sch/payments", $_POST);
    $result = json_decode($result, true);

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

ob_end_flush(); // Flush the output buffer and send content to the browser
?>
