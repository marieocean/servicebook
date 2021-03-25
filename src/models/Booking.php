<?php 
class Booking {

    private $connect;

    function __construct($connector) {
        $this->connect = $connector;
    }

    public function getAll(){
        $query = "
        SELECT * FROM appointment 
        ORDER BY id DESC 
        ";
        $statement = $this->connect->prepare($query);
        $statement->execute();
        while($row = $statement->fetch(PDO::FETCH_ASSOC))
        {
         $data[] = $row;
        }
        return json_encode($data);
    }

    public function insert($received_data){
        $data = array(
            ':client' => $received_data->client,
            ':date_rdv' => $received_data->date_rdv,
            ':duration' => $received_data->duration,
            ':other_location' => $received_data->other_location,
        );
        
        $query = "
        INSERT INTO appointment 
        (client, date_rdv, duration, other_location) 
        VALUES (:client, :date_rdv, :duration, :other_location)
        ";
        $statement = $this->connect->prepare($query);
        
        $sValue = $statement->execute($data);
        $output = array(
        'message' => var_dump($data).'Data Inserted'
        );
        
        echo json_encode($output);
    }
}