<?php use App\Models\chirp;
use App\Models\User;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h1{
           font-size: 5cm;
        }
       
    </style>
</head>
<body>
   
 <?php
 echo "<table border=1>";
    echo "<tr><th>Message</th></tr>";
    foreach (chirp::all() as $flight) {
        echo "<tr>" ."<td>".$flight->message.
            
            "</td><td>" ;
        

    }
    echo "</table>";
    $flight = User::find(1);
    echo "<h1> $flight</h1>"
    ?>


    <h1>idbebvkhbfvkhb</h1>
</body>
</html>