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
        
        while($rows = $stmt->fetchAll(PDO::FETCH_ASSOC))
        {
            $User[] = $rows;
        }
        
        if (!empty($User)) 
        {
            $UserId            = $user[0]['Id'];
            $UserName          = $user[0]['Name'];
            $UserType          = $user[0]['UserType'];
            $Email             = $user[0]['EmailId'];
            $Phone             = $user[0]['MobileNo'];
            $_SESSION['user']      = $UserId;
            $_SESSION['username']  = $UserName;
            $_SESSION['usertype']  = $UserType;
            $_SESSION['email']     = $Email;
            $_SESSION['phone']     = $Phone;
            header("Location: http://localhost/vts/views/dashboard.php");
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
    
}