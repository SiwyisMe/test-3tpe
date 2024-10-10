<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cars";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function calculateCarAge($productionDate) {
    $currentDate = new DateTime();
    $prodDate = new DateTime($productionDate);
    $age = $currentDate->diff($prodDate);
    return $age->y;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $car_brand = $_POST['car_brand'];
    $car_model = $_POST['car_model'];
    $car_color = $_POST['car_color'];
    $car_production_date = $_POST['car_production_date'];
    $car_first_registration_date = $_POST['car_first_registration_date'];
    $car_age = calculateCarAge($car_production_date);

    if($car_production_date > $car_first_registration_date){
        echo "nie może być zarejstrowany wcześniej niż data produkcji";
        exit();
    }
    $sql = "INSERT INTO car (car_brand, car_model, car_color, car_production_date, car_first_registration_date, car_age) 
            VALUES ('$car_brand', '$car_model', '$car_color', '$car_production_date', '$car_first_registration_date', $car_age)";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>
<form method="post">
    <label for="car_brand">Car Brand:</label>
    <input type="text" id="car_brand" name="car_brand" required><br>
    <label for="car_model">Car Model:</label>
    <input type="text" id="car_model" name="car_model" required><br>
    <label for="car_color">Car Color:</label>
    <input type="text" id="car_color" name="car_color" required><br>
    <label for="car_production_date">Production Date:</label>
    <input type="date" id="car_production_date" name="car_production_date" required><br>
    <label for="car_first_registration_date">First Registration Date:</label>
    <input type="date" id="car_first_registration_date" name="car_first_registration_date" required><br>
    <input type="submit" value="Submit">
</form>
