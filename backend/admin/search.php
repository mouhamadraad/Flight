<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Flight Booking</title>
    <link rel="stylesheet" href="styling/search.css">
</head>
<body>

<?php require 'config.php'; ?>

<?php
if (isset($_GET['error'])) {
    $errorMessage = '';
    switch ($_GET['error']) {
        case 'sameval':
            $errorMessage = "Select different value for departure city and arrival city";
            break;
        case 'seldep':
            $errorMessage = "Select Departure city";
            break;
        case 'selarr':
            $errorMessage = "Select Arrival city";
            break;
    }
    if (!empty($errorMessage)) {
        echo '<script>alert("' . $errorMessage . '")</script>';
    }
}
?>

<h1>Online Flight Booking</h1>

<div class="main-agileinfo">
    <div class="sap_tabs">
        <form action="book_flight.php" method="post">
            <h2>Round Trip</h2>
            <input type="hidden" name="type" value="round">
            <div>
                <h3>From</h3>
                <input type="text" name="dep_city" placeholder="Departure City" required>
            </div>
            <div>
                <h3>To</h3>
                <input type="text" name="arr_city" placeholder="Arrival City" required>
            </div>
            <div>
                <div>
                    <h3>Depart</h3>
                    <input type="date" name="dep_date" required>
                </div>
                <div>
                    <h3>Return</h3>
                    <input type="date" name="ret_date" required>
                </div>
            </div>
            <div>
                <input type="submit" value="Search Flights" name="search_but">
            
            </div>
        </form>
    </div>
</div>

</body>
</html>
