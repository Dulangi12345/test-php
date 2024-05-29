<?php
ob_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form method="post" id="paymentForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="studentName">Name</label>
                        <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Eg: John Doe" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Eg: Library Fee/Semester Fee" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Payment Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Eg: 999.99" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="indexNumber">Index Number</label>
                        <input type="text" class="form-control" id="indexNumber" name="indexNumber" placeholder="Eg: ABC123 / 0000" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Eg: johndoe@gmail.com" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phoneNo">Mobile Number</label>
                        <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Eg: +94000000000">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="classOrCourse">Class or Course name</label>
                        <input type="text" class="form-control" id="classOrCourse" name="classOrCourse" placeholder="Eg: Grade7/Dip.in.IT" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="termsCheck">
                            <label class="form-check-label" for="termsCheck">I agree to the terms and conditions</label>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="apiKey" name="apiKey" value="KCBAE725KPTCGANOKA902101207">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            var termsCheck = document.getElementById('termsCheck');
            if (!termsCheck.checked) {
                event.preventDefault();
                alert('You must agree to the terms and conditions before submitting the form.');
            }
        });
    </script>
</body>

</html>
