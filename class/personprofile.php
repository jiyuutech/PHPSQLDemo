<?php
class PersonProfile {

    public $connection;
    public $profileid;
    public $firstname;
    public $lastname;
    public $middlename;
    public $birthdate;
    public $gender;
    public $email;
    public $address;
    public $category;

    public function __construct($db) {
     //to do initialize from db
        $this->connection = $db;

    }

    public function getProfileById() {
        mysqli_next_result($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM studentprofile WHERE profileid = '".$this->profileid."'");

        if($statement->execute()){
            $result = $statement->get_result();
            $statement->close();
            return $result;
        }
    }

    public function getAllProfile(){
        // Get all records from the database
        mysqli_next_result($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM studentprofile");

        if($statement->execute()){
            $result = $statement->get_result();
            $statement->close();
            return $result;
        }
    }

    public function getAllProfileACAD(){
        // Get all records from the database
        mysqli_next_result($this->connection);
        $statement2 = $this->connection->prepare("SELECT * FROM studentprofile where category='ACADEMIC STRAND'");

        if($statement2->execute()){
            $result2 = $statement2->get_result();
            $statement2->close();
            return $result2;
        }
    }

    public function getAllProfileTVL(){
        // Get all records from the database
        mysqli_next_result($this->connection);
        $statement2 = $this->connection->prepare("SELECT * FROM studentprofile where category='TECHNICAL-VOCATIONAL-LIVELIHOOD STRAND (TVL)'");

        if($statement2->execute()){
            $result2 = $statement2->get_result();
            $statement2->close();
            return $result2;
        }
    }

   
    public function create(){
        // Create a new record in the database
        $statement = $this->connection->prepare("INSERT INTO studentprofile (firstname, lastname, middlename, birthdate, gender, email, address,category) VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->middlename."', '".$this->birthdate."','".$this->gender."','".$this->email."', '".$this->address."','".$this->category."')");
     
       
        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->middlename=htmlspecialchars(strip_tags($this->middlename));
        $this->birthdate=date("Y-m-d", strtotime($this->birthdate));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->address=htmlspecialchars(strip_tags($this->address));
     

        if($statement->execute()){
            $statement->close();
            return true;
        }
        echo ("Error description: " . $this->connection->error);
        return false;

    }

    public function update(){
        // Update a record in the database

         // Create a new record in the database
         $sql = "UPDATE studentprofile SET firstname = '".$this->firstname."', lastname = '".$this->lastname."', middlename = '".$this->middlename."', gender ='".$this->gender."' , email = '".$this->email."' , address = '".$this->address."',category = '".$this->category."' WHERE profileid = '".$this->profileid."'";
 
       
         $statement = $this->connection->prepare($sql);
         
         //sanitize
         $this->firstname=htmlspecialchars(strip_tags($this->firstname));
         $this->lastname=htmlspecialchars(strip_tags($this->lastname));
         $this->middlename=htmlspecialchars(strip_tags($this->middlename));
         $this->birthdate=htmlspecialchars(strip_tags($this->birthdate));
         $this->gender=htmlspecialchars(strip_tags($this->gender));
         $this->email=htmlspecialchars(strip_tags($this->email));
         $this->address=htmlspecialchars(strip_tags($this->address));
   
         if($statement->execute()){
             $statement->close();
             return true;
         }
         echo ("Error description: " . $this->connection->error);
         return false;
    }

    public function delete(){
        $statement = $this->connection->prepare("DELETE FROM studentprofile WHERE profileid = '".$this->profileid."'");
       
        if($statement->execute()){
            $statement->close();
            return true;
        }
        echo ("Error description: " . $this->connection->error);
        return false;
    }


}

?>