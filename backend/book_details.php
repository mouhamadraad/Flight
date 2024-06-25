<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Booking</title>
    <link rel="stylesheet" type="text/css" href="../frontend/Styling/display.css">
    
</head>
<body>
    <h1>Welcome to Flight Booking</h1>
    <p>Below is the list of available flights:</p>

    <?php
    require 'config.php';

    $sql = "SELECT * FROM bookings";

    if ($result = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Booking ID</th>';
            echo '<th>User ID</th>';
            echo '<th>Flight ID</th>';
            echo '<th>Booking Date</th>';
            echo '<th>Number of Passengers</th>';
            echo '<th>Seat Numbers</th>';
            echo '<th>Payment Status</th>';
            echo '</tr>';
            
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $row['BookingID'] . '</td>';
                echo '<td>' . $row['UserID'] . '</td>';
                echo '<td>' . $row['FlightID'] . '</td>';
                echo '<td>' . $row['BookingDate'] . '</td>';
                echo '<td>' . $row['NumberofPassenger'] . '</td>';
                echo '<td>' . $row['SeatNumbers'] . '</td>';
                echo '<td>' . $row['PaymentStatus'] . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
        } else {
            echo 'No records found.';
        }
    } else {
        echo 'Error: ' . mysqli_error($con);
    }
    ?>

   <div class="center">
    <center>
       <a href="book.php" class="btn">Book Flights</a>
       </center>
   </div>
    
</body>
</html>
