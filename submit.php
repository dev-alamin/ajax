<?php

$host = 'localhost';
$username = 'root';
$password = '';

try {

    $conn = new PDO("mysql:host=$host;dbname=ajax", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {

    echo "Connection faild: " . $error->getMessage();
}

$response = array('success' => false);

if (isset($_POST['name']) && $_POST['name'] != '' && isset($_POST['phone']) && $_POST['phone'] != '' && isset($_POST['email']) && $_POST['email'] != '') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    addslashes($name);
    addslashes($phone);
    addslashes($email);

    $sql = "INSERT INTO contact(name, phone, email) VALUES ('$name', '$phone', '$email')";

    if ($conn->query($sql)) {

        $response['success'] = true;
    }
}

echo json_encode($response);
