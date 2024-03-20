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

    $sql = "SELECT users.UserID, users.name, flights.DepartureCity, flights.ArrivalCity, flights.price FROM users JOIN bookings ON users.UserID = bookings.UserID JOIN flights ON bookings.FlightID = flights.FlightID";

    if ($result = mysqli_query($con, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>User ID</th>';
            echo '<th>Name</th>';
            echo '<th>Departure City</th>';
            echo '<th>Arrival City</th>';
            echo '<th>Price</th>';
            echo '</tr>';
            
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $row['UserID'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['DepartureCity'] . '</td>';
                echo '<td>' . $row['ArrivalCity'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
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
  
    
</body>
</html>
