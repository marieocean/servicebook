<?php 
    require "models/Booking.php";
    $connect = new PDO("mysql:host=mysql-server;dbname=servicebooking", "root", "secret");
    $received_data = json_decode(file_get_contents("php://input"));
    $data = array();
    $booking = new Booking($connect);
    switch ($received_data->action){
        case "fetchall":
            echo $booking->getAll();break;
        case "insert":
            echo $booking->insert($received_data);break;
        case "update":
            echo $booking->update($received_data);break;
        case "fetchSingle":
            echo $booking->fetchSingle($received_data);break;
        case "delete":
            echo $booking->delete($received_data);break;
        default: die();

    }
