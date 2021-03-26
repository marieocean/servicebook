<?php
    require_once '../vendor/autoload.php';
    require_once "models/Booking.php";
   
    use Monolog\Handler\StreamHandler;
    use Monolog\Logger;
    use Monolog\ErrorHandler;
    
    

    $logfile = "/var/www/logs/errors.log";
    $logger = new Logger('database');
    ErrorHandler::register($logger);
    $logger->pushHandler(new StreamHandler($logfile, Logger::ERROR));
    
    try{
        $connect = new PDO("mysql:host=mysql-server;dbname=servicebooking", "root", "secret");
    }
    catch(Exception $e){
        $logger->error('Impossible to connect to the database');
        die();
    }
    
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
