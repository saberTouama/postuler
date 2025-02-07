<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{route('workowner.store')}}">
        @csrf
 <input type="text" name="name" placeholder="name"><br><br>
 <input type="text" name="address" placeholder="adress"><br><br>
 <input type="email" name="email" placeholder="email"><br><br>
 <input type="text" name="company" placeholder=" company name"><br><br>
 <input type="tel" name="phone" placeholder="phone number"><br><br>
 <input type="submit" value="Submit">
    </form>
</body>
</html>