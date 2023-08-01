<?php
require_once __DIR__ .'/../database/DBConfig.php';

$database = new DB();
$data = $database->connect();

class Vessel
{
    public $vessel_name;
    public $description;
    
    public function __construct($vessel_name, $description)
    {
        $this->vessel_name = $vessel_name;
        $this->description = $description;
    }
    
    public function addVessel()
    {
        global $data;
        
        $vesselData = array(
            'vessel_name' => str_replace("'", "\'", $_POST['vessel_name']),
            'description' => str_replace("'", "\'", $_POST['description']),
        );
        
        $total_data = count($vesselData);
        $update_query = '';
        
        if(!empty($_POST['id']))
        {
            foreach($vesselData as $columns => $values)
            {
                $update_query .= "$columns = '$values'";
                if($total_data > 1)
                {
                    $update_query .= ",";
                    $total_data--;
                }
            }
            $query="Update vessels set $update_query where id= ".$_POST['id']."";
            $stmt = $data->prepare($query);
            if($stmt->execute())
            {
                $_SESSION['message'] = '<div alert alert-success>Vessel data updated successfully...</div>';
            }else
            {
                $_SESSION['message'] = '<div alert alert-danger>Vessel data failed to update</div>';
            }
        }else
        {
            foreach($vesselData as $key => $value)
            {
                if(is_null($value) || $value == '')
                unset($vesselData[$key]);
            }
            $fields = implode(",", array_keys($vesselData));
            $values = implode(",", array_values($vesselData));
            $query="INSERT INTO vessels($fields) values('$values')";
            $stmt = $data->prepare($query);
            if($stmt->execute())
            {
                $_SESSION['message']='<div class="alert alert-success">User created successfully...</div>';
            }else
            {
                $_SESSION['message']='<div class="alert alert-danger">Problem in vessel creation...</div>';
            }
        }
    }
}