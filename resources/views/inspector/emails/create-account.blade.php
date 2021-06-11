<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Account aangemaakt</title>
</head>
<body>
<h1>Account succesvol aangemaakt</h1>

<div>
    <div>
        <h3>Hallo, {{$firstname}} {{$lastname}}</h3>
        <p>Het account dat je kan gebruiken om in de inspectietool in te loggen is aangemaakt!</p>
        <p>Je kan inloggen met de volgende gegevens:
            <br/>
            E-mailadres: {{$email}}
            <br/>
            Wachtwoord: {{$password}}
        </p>
        <p>Ga naar <a href="42in4sod.aii.avans.nl/">42in4sod.aii.avans.nl</a> om in te loggen.</p>
    </div>
</div>

</body>
</html>
