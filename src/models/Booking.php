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

    public function fetchSingle($received_data){
        $query = "
        SELECT * FROM appointment 
        WHERE id = '".$received_data->id."'
        ";

        $statement = $this->connect->prepare($query);

        $statement->execute();

        $result = $statement->fetchAll();

        foreach($result as $row)
        {
        $data['id'] = $row['id'];
        $data['client'] = $row['client'];
        $data['date_rdv'] = $row['date_rdv'];
        $data['other_location'] = $row['other_location'];
        $data['duration'] = $row['duration'];
        }

        echo json_encode($data);
    }

    public function delete($received_data){
        $query = "
            DELETE FROM appointment 
            WHERE id = '".$received_data->id."'
            ";
        $statement = $this->connect->prepare($query);

        $statement->execute();

        $output = array(
            'message' => 'Data Deleted'
           );
          
        echo json_encode($output);

    }

    public function update($received_data){
        $data = array(
            ':client' => $received_data->client,
            ':date_rdv' => $received_data->date_rdv,
            ':duration' => $received_data->duration,
            ':other_location' => $received_data->other_location,
            ':id' => $received_data->id,
        );
        
        $query = "
        UPDATE appointment 
        SET client = :client, 
        date_rdv = :date_rdv, 
        duration = :duration, 
        other_location = :other_location
        WHERE id = :id
        ";
        $statement = $this->connect->prepare($query);
        
        $sValue = $statement->execute($data);
        $output = array(
        'message' => var_dump($data).'Data Updataed'
        );
        
        echo json_encode($output);
    }
}