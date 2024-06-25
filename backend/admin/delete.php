<?php
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Management</title>
    <link rel="stylesheet" href="styling/delete.css">
</head>

<body>

<?php

// Check if the flight ID is provided and perform deletion
if(isset($_GET['delete_id'])) {
    $flight_id = $_GET['delete_id'];
    $sql = "DELETE FROM flights WHERE FlightID = ?";
    $stmt = mysqli_stmt_init($con);
    
    if(mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $flight_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Flight with ID: $flight_id has been deleted successfully.";
    } else {
        echo "Error deleting flight.";
    }
}

// Fetch flight data from the database
$sql = "SELECT * FROM flights";
$result = mysqli_query($con, $sql);

// Check if there are any flights
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
    <tr>
    <th>Flight ID</th>
    <th>Airline ID</th>
    <th>Departure City</th>
    <th>Arrival City</th>
    <th>Departure Time</th>
    <th>Arrival Time</th>
    <th>Price</th>
    <th>Available Seats</th>
    <th>Action</th>
    </tr>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['FlightID'] . "</td>";
        echo "<td>" . $row['AirlineID'] . "</td>";
        echo "<td>" . $row['DepartureCity'] . "</td>";
        echo "<td>" . $row['ArrivalCity'] . "</td>";
        echo "<td>" . $row['DepartureTime'] . "</td>";
        echo "<td>" . $row['ArrivalTime'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['AvailableSeats'] . "</td>";
    
  echo "<td><a href='?delete_id=" . $row['FlightID'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($con);
?>


</body>

</html>