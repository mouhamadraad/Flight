<?php

include 'config.php';


$searchResults = array();


if(isset($_POST["DepartureTime"]) && isset($_POST["ArrivalTime"]) && isset($_POST["DepartureCity"]) && isset($_POST["ArrivalCity"])) {

$DepartureTime = $_POST["DepartureTime"];
    $ArrivalTime = $_POST["ArrivalTime"];
    $DepartureCity = $_POST["DepartureCity"];
    $ArrivalCity = $_POST["ArrivalCity"];


    $sql = "SELECT DepartureTime, ArrivalTime, DepartureCity, ArrivalCity FROM flights WHERE DATE(DepartureTime) = DATE(?) AND DATE(ArrivalTime) = DATE(?) AND DepartureCity = ? AND ArrivalCity = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssss", $DepartureTime, $ArrivalTime, $DepartureCity, $ArrivalCity);

  
    $stmt->execute();
    $result = $stmt->get_result();


    while ($row = $result->fetch_assoc()) {
        $searchResults[] = $row;
    }


    $stmt->close();
} else {
    
    echo "Please provide both Departure Time, Arrival Time, Departure City, and Arrival City.";
    exit;
}


$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Search Results</title>
  <link rel="stylesheet" type="text/css" href="../frontend/Styling/search.css">
</head>
<body>

    <h2>Flight Search Results</h2>

    <?php if (!empty($searchResults)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Departure Time</th>
                    <th>Arrival Time</th>
                    <th>Departure City</th>
                    <th>Arrival City</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($searchResults as $result) : ?>
                    <tr>
                        <td><?php echo $result['DepartureTime']; ?></td>
                        <td><?php echo $result['ArrivalTime']; ?></td>
                        <td><?php echo $result['DepartureCity']; ?></td>
                        <td><?php echo $result['ArrivalCity']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No flights available for the selected criteria.</p>
    <?php endif; ?>

</body>
</html>
