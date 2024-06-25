<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Management</title>
    <link rel="stylesheet" href="styling/update.css">
</head>

<body>
<?php
include "config.php";

// Check if the form is submitted and perform the update
if(isset($_POST['update'])) {
    $flight_id = $_POST['flight_id'];
    $field_name = $_POST['field_name'];
    $new_value = $_POST['new_value'];
    
    $sql = "UPDATE flights SET $field_name = ? WHERE FlightID = ?";
    $stmt = mysqli_stmt_init($con);
    
    if(mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $new_value, $flight_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo "Flight with ID: $flight_id has been updated successfully.";
    } else {
        echo "Error updating flight.";
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
    </tr>";

    // Output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['FlightID'] . "</td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='AirlineID'><input type='text' name='new_value' value='" . $row['AirlineID'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='DepartureCity'><input type='text' name='new_value' value='" . $row['DepartureCity'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='ArrivalCity'><input type='text' name='new_value' value='" . $row['ArrivalCity'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='DepartureTime'><input type='text' name='new_value' value='" . $row['DepartureTime'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='ArrivalTime'><input type='text' name='new_value' value='" . $row['ArrivalTime'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='price'><input type='text' name='new_value' value='" . $row['price'] . "'><button type='submit' name='update'>Update</button></form></td>";
        echo "<td><form action='' method='post'><input type='hidden' name='flight_id' value='" . $row['FlightID'] . "'><input type='hidden' name='field_name' value='AvailableSeats'><input type='text' name='new_value' value='" . $row['AvailableSeats'] . "'><button type='submit' name='update'>Update</button></form></td>";
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
