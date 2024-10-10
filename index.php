<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cars";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_brand = $_POST['car_brand'];
    $car_model = $_POST['car_model'];
    $car_color = $_POST['car_color'];
    $car_production_date = $_POST['car_production_date'];
    $car_first_registration_date = $_POST['car_first_registration_date'];

    $sql = "INSERT INTO car (car_brand, car_model, car_color, car_production_date, car_first_registration_date) 
            VALUES ('$car_brand', '$car_model', '$car_color', '$car_production_date', '$car_first_registration_date')";
}

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>


?>
