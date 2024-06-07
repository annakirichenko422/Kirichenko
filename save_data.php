<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "chelgusave"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}


$data = json_decode(file_get_contents("php://input"), true);


foreach ($data as $row) {
    $sql = "INSERT INTO contracts (full_name, group_name, financing, birth_date, citizenship, scholarship, benefits, start_date, end_date, order_number, status) 
            VALUES ('" . $conn->real_escape_string($row[0]) . "', '" . $conn->real_escape_string($row[1]) . "', '" . $conn->real_escape_string($row[2]) . "', 
            '" . $conn->real_escape_string($row[3]) . "', '" . $conn->real_escape_string($row[4]) . "', '" . $conn->real_escape_string($row[5]) . "', 
            '" . $conn->real_escape_string($row[6]) . "', '" . $conn->real_escape_string($row[7]) . "', '" . $conn->real_escape_string($row[8]) . "', 
            '" . $conn->real_escape_string($row[9]) . "', '" . $conn->real_escape_string($row[10]) . "')";

    if ($conn->query($sql) !== TRUE) {
        echo "Ошибка при выполнении запроса: " . $conn->error;
    }
}


if ($conn->affected_rows > 0) {
    echo "Данные успешно сохранены в базе данных!";
} else {
    echo "Не удалось сохранить данные в базе данных.";
}


$conn->close();
?>
