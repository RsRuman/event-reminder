<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
</head>
<body>
<div>
    <h5>Hello,</h5>
    <p>Greetings from, <b>Event Reminder</b></p>
    <p>This is a reminder for your upcoming event.</p>
    <p><b>Event:</b> {{ $event->title }}</p>
    <p><b>Description:</b> {{ $event->description }}</p>
    <p><b>Date and Time:</b> {{ $event->date }}</p>
    <p>Thank you for being with us.</p>
</div>
</body>
</html>
