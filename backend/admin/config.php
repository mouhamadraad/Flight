<?php
define("db_SERVER", "localhost");
define("db_USER", "root");
define("db_PASSWORD", "");
define("db_DBNAME", "airlinedb");


$con = mysqli_connect(db_SERVER, db_USER, db_PASSWORD, db_DBNAME);
if ($con) {
    echo ("");
} else {

    echo ("Error connecting the server " . mysqli_connect_error());
}

