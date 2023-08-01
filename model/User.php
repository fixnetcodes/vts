<?php
// session_start();
require_once __DIR__ . '/../database/DBConfig.php';
$db = new DB();
$data = $db->connect();

class User
{
    //create obj
    public $userId;
    public $name;
    public $password;
    public $email;
    public $usertype;
    public $mobileno;
    
    public function __construct($userId=null,$name = null, $password = null, $email = null, $usertype = null, $mobileno = null)
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->usertype = $usertype;
        $this->mobileno = $mobileno;
    }
    
    public function login($email, $password)
    {
        $this->email = str_replace("'", "\'", $email);
        $this->password = str_replace("'", "\'", md5($password));

        global $data;
        
        $query="SELECT * FROM usermaster WHERE EmailId=:email AND Password=:password";
        $stmt = $data->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        // echo $query;
        // exit;
        $stmt->execute();
        
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $User[] = $rows;
        }
        
        
        if (!empty($User)) 
        {
            session_start();
            $UserId            = $User[0]['Id'];
            $UserName          = $User[0]['Name'];
            $UserType          = $User[0]['UserType'];
            $Email             = $User[0]['EmailId'];
            $Phone             = $User[0]['MobileNo'];
            $_SESSION['user']      = $UserId;
            $_SESSION['username']  = $UserName;
            $_SESSION['usertype']  = $UserType;
            $_SESSION['email']     = $Email;
            $_SESSION['phone']     = $Phone;  
            header("Location: http://localhost/vts_project/views/dashboard.php");
            // exit;
        } else 
        {
            $_SESSION['message'] = '<div class="alert alert-danger">Incorrect username or password</div>';
            ?>
		    <script>
		        window.history.back();
		    </script>
		    <?php
        }
    }
    
    //register user
    public function register()
    {
        global $data;
        
        $userData = array(
            'Name'      => str_replace("'","\'",$_POST['fullname']),
            'Password'  =>md5( $_POST['password']),
            'EmailId'   => str_replace("'","\'",$_POST['email']),
            'UserType'  => str_replace("'","\'",$_POST['user_type']),
            'MobileNo'  => $_POST['mobile'],
        );
        
        //count array data
        $total_data = count($userData);
        $update_query = '';
        
        if(!empty($_POST['id'])) 
        {
            foreach($userData as $columns => $values)
            {
                $update_query.="$columns = '$values'";
                if($total_data > 1)
                {
                    $update_query .= ", ";
                    $total_data--;
                }
            }
            $query = "UPDATE usermaster SET $update_query WHERE Id = " . $_POST['id'];
            $stmt = $data->prepare($query);
            if($stmt->execute()){
                $_SESSION['message']= '<div class="alert alert-success">User updated successfully...</div>'; 
                
            }
           
        }else
        {
            foreach($userData as $key=>$value)
		    {
                if(is_null($value) || $value == '')
                unset($userData[$key]);
		    }
            $fields  = implode(", ",array_keys($userData)); //fields for insert query
            $values   = implode("','", array_values($userData)); //values for insert query
            $query="INSERT INTO usermaster($fields) values('$values')";
            $results = $data->prepare($query);
            if($results->execute()) {
                $_SESSION['message']='<div class="alert alert-success">User created successfully...</div>'; 
            } else {
                $_SESSION['message']='<div class="alert alert-danger">Problem in user creation...</div>'; 
                ?>
                <script>
                window.history.back();
                </script>
                <?php
            }
        }
        
        
    }
    
}