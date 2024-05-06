<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method


    $result = CallAPI("https://secure.myfees.lk/api/sch/payments", $_POST);
    $result = json_decode($result, true);
    echo $result;
    if (isset($result['id'])) {

        header("Location: https://secure.myfees.lk/pay/" . $result['id']);

        
        die();
    } else {
        print_r($result);
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="row" style="padding: 50px;">








        <div class="col-lg-8">
            <div id="errors" class="alert alert-danger" role="alert" style="display: none">
            </div>
            <form method="post">
                <div class="form-group">
                    <label for="studentName">Name</label>
                    <input type="text" class="form-control" id="studentName" name="studentName" placeholder="Eg: John Doe" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Eg: Library Fee/Semester Fee" required>
                </div>

                <div class="form-group">
                    <label for="amount">Payment Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Eg: 999.99" required>
                </div>

                <div class="form-group">
                    <label for="indexNumber">Index Number</label>
                    <input type="text" class="form-control" id="indexNumber" name="indexNumber" placeholder="Eg: ABC123 / 0000" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Eg: johndoe@gmail.com" required>
                </div>

                <div class="form-group">
                    <label for="phoneNo">Mobile Number</label>
                    <input type="text" class="form-control" id="phoneNo" name="phoneNo" placeholder="Eg: +94000000000">
                </div>

                <div class="form-group">
                    <label for="classOrCourse">Class or Course name</label>
                    <input type="text" class="form-control" id="classOrCourse" name="classOrCourse" placeholder="Eg: Grade7/Dip.in.IT" required>
                </div>

                <input type="hidden" id="apiKey" name="apiKey" value="KCBAE725KPTCGANOKA902101207">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>