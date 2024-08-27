<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{asset('user_front/images/mono_logo_icon.png')}}">

    <title>Mono Sushi Website Contact</title>
</head>
<body>
    <p>Name: {{$details['name']}}</p>
    <p>Phone: {{$details['phone']}}</p>
    <p>Email: {{$details['email']}}</p>
    <p>subject: {{$details['subject']}}</p>
    <p>Message: {{$details['message']}}</p>

</body>
</html>