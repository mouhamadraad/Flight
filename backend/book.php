<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Flights</title>
    <link rel="stylesheet" type="text/css" href="../frontend/Styling/display.css">
</head>
<body>
    <h1>Book Flights</h1>
    
    <?php
    require 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UserID = $_POST['UserID']; 
        $FlightID = $_POST['FlightID'];
        $BookingDate = $_POST['BookingDate'];
        $NumberofPassenger = $_POST['NumberofPassenger'];
        $SeatNumbers = $_POST['SeatNumbers'];
        $PaymentStatus = $_POST['PaymentStatus'];

        $sql = "INSERT INTO bookings (UserID, FlightID, BookingDate, NumberofPassenger, SeatNumbers, PaymentStatus) 
                VALUES ('$UserID', '$FlightID', '$BookingDate', '$NumberofPassenger', '$SeatNumbers', '$PaymentStatus')";

        if (mysqli_query($con, $sql)) {
            echo "<p>Booking successful!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    }
    ?>

    <form id="bookingForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <label for="UserID">User ID:</label>
        <input type="number" id="UserID" name="UserID" required><br>
        
        <label for="FlightID">Flight ID:</label>
        <input type="number" id="FlightID" name="FlightID" required><br>
        
        <label for="BookingDate">Booking Date:</label>
        <input type="datetime-local" id="BookingDate" name="BookingDate" required><br>
        
        <label for="NumberofPassenger">Number of Passengers:</label>
        <input type="number" id="NumberofPassenger" name="NumberofPassenger" required><br>
        
        <label for="SeatNumbers">Seat Numbers:</label>
        <input type="text" id="SeatNumbers" name="SeatNumbers" required><br>
        
        <label for="PaymentStatus">Payment Status:</label>
        <input type="text" id="PaymentStatus" name="PaymentStatus" required><br>

        <input type="submit" value="Submit Booking">
    </form>
</body>
</html>
