<?php
include "config.php";

// Function to display flight data
function displayFlightData($con) {
    $sql = "SELECT * FROM flights";
    $result = mysqli_query($con, $sql);

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
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
}


function addNewFlight($con) {
    if (isset($_POST['submit'])) {
        $departure_city = $_POST['departure_city'];
        $arrival_city = $_POST['arrival_city'];
        $departure_time = $_POST['departure_time'];
        $arrival_time = $_POST['arrival_time'];
        $price = $_POST['price'];
        $available_seats = $_POST['available_seats'];

  $sql = "INSERT INTO flights (DepartureCity, ArrivalCity, DepartureTime, ArrivalTime, price, AvailableSeats) 
                VALUES ('$departure_city', '$arrival_city', '$departure_time', '$arrival_time', $price, $available_seats)";

        if (mysqli_query($con, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    }
}

// Check if the form is submitted to add new flight
addNewFlight($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flight Management</title>
    <link rel="stylesheet" href="styling/add.css">
</head>

<body>
    <h2>Flight Data</h2>
    <?php displayFlightData($con); ?>

    <h2>Add New Flight</h2>
    <form action="" method="post">
        Departure City: <input type="text" name="departure_city"><br>
        Arrival City: <input type="text" name="arrival_city"><br>
        Departure Time: <input type="datetime-local" name="departure_time"><br>
        Arrival Time: <input type="datetime-local" name="arrival_time"><br>
        Price: <input type="number" name="price"><br>
        Available Seats: <input type="number" name="available_seats"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>
