<?php

include_once 'clsPermissions.php';

class clsUser
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $phone_number;
    private $role;
    private $permissions;
        
    private static function Conncect()
    {
        include_once 'C:\xampp\desktop\htdocs\Resto_Project\Dashbord-Menu\Classes\DbhConnection\Dbh.php';
        return Dbh::connect();
    }
    
    public function __construct($id=null, $fname='', $lname='', $email='', $pswd='', $phone='' ,$role='', $prmsn=null)
    {
        $this->user_id = $id;
        $this->first_name = $fname;
        $this->last_name = $lname;
        $this->email = $email;
        $this->password = $pswd;
        $this->phone_number = $phone;
        $this->role = $role;
        $this->permissions = $prmsn;
    }    

    // Getter for user_id (read-only)
     public function getUserId()
     {
         return $this->user_id;
     }
 
     // Getter and setter for first_name
     public function getFirstName()
     {
         return $this->first_name;
     }
 
     public function setFirstName($fname)
     {
         $this->first_name = $fname;
     }
 
     // Getter and setter for last_name
     public function getLastName()
     {
         return $this->last_name;
     }
 
     public function setLastName($lname)
     {
         $this->last_name = $lname;
     }
 
     // Getter and setter for email
     public function getEmail()
     {
         return $this->email;
     }
 
     public function setEmail($email)
     {
         $this->email = $email;
     }
 
     // Getter and setter for password
     public function getPassword()
     {
         return $this->password;
     }
 
     public function setPassword($pswd)
     {
         $this->password = $pswd;
     }
 
     // Getter and setter for phone_number
     public function getPhoneNumber()
     {
         return $this->phone_number;
     }
 
     public function setPhoneNumber($phone)
     {
         $this->phone_number = $phone;
     }
 
     // Getter and setter for role
     public function getRole()
     {
         return $this->role;
     }
 
     public function setRole($role)
     {
         $this->role = $role;
     }

    
     // Getter and setter for permissions
     public function getPermissions()
     {
        return $this->permissions;
     
     }

     public function setPermissions($prmsn)
     {
        $this->permissions = $prmsn;
     }
    
     // Find The user 
    public static function Find($email, $pswd='0000')
    {
        $conn = self::Conncect();

        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT * from users where password = '$pswd' and email='$email'");
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) 
        {
            $currUser = new clsUser($user['user_id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['phone_number'], $user['role'], $user['permissions']);
            return $currUser;
        }
        else
            return null;
    }

    // ListUsers
    public static function ListUsers()
    {
        $conn = clsUser::Conncect();
        // Prepare and execute the statement
        $stmt = $conn->prepare("CALL list_users_admin()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // DeleteUser
    public function DeleteUser($id)
    {
        $conn = self::Conncect();
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();

    }

    // Update Method into the database
    public function Update()
    {
        $id = $this->user_id;
        $fname = $this->first_name;
        $lname = $this->last_name;
        $email = $this->email;
        $pswd = $this->password;
        $phone = $this->phone_number;
        $role = $this->role;
        $prmsn = $this->permissions;

        $conn = self::Conncect();
        $stmt = $conn->prepare("CALL update_user($id,'$fname', '$lname', '$email', '$pswd', '$phone', '$role', $prmsn)");
        return $stmt->execute();

    }

    public function Save()
    {

        $conn = self::Conncect();
        
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, phone_number, permissions) 
        VALUES (:fname, :lname, :email, :pswd, :role, :phone, :prmsn)");

        // Bind parameters
        $fname = $this->first_name;
        $lname = $this->last_name;
        $email = $this->email;
        $pswd = $this->password;
        $phone = $this->phone_number;
        $role = $this->role;
        $prmsn = $this->permissions;
        
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pswd', $pswd);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':prmsn', $prmsn);
            
        // Execute the statement
        $stmt->execute();
            
        // Verify if the insert was successful
        if ($stmt->rowCount() > 0) 
        {
            // Get the last inserted ID
            $lastId = $conn->lastInsertId();
            $this->user_id = $lastId;
            return true;
        } 
        else 
        {
            return false;
        }
        
}


    public function CheckAccessPermission(int $Permission):bool
    {
        if ($this->permissions == Permissions::All)
            return true;

        if (($this->permissions & $Permission) == $Permission)
            return true;
        else
            return false;
    }

}