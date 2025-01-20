<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
</head>
<body>
    <h1>Booking Details</h1>
    <p><strong>Room Name:</strong> {{ $booking->room->name ?? 'N/A' }}</p>
    <p><strong>Name:</strong> {{ $booking->user_name }}</p>
    <p><strong>Phone:</strong> {{ $booking->user_phone }}</p>
    <p><strong>Address:</strong> {{ $booking->user_address }}</p>
    <p><strong>Checked In:</strong> {{ $booking->check_in }}</p>
    <p><strong>Checked Out:</strong> {{ $booking->check_out }}</p>
</body>
</html>
