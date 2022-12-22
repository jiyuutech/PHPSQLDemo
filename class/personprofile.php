<?php
class PersonProfile {

    public $connection;

    public $profileid;
    public $firstname;
    public $lastname;
    public $middlename;
    public $gender;
    public $address;

    public function __construct($db) {
     //to do initialize from db
        $this->connection = $db;

    }

    public function getProfileById() {
        mysqli_next_result($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM personprofile WHERE profileid = '".$this->profileid."'");

        if($statement->execute()){
            $result = $statement->get_result();
            $statement->close();
            return $result;
        }
    }

    public function getAllProfile(){
        // Get all records from the database
        mysqli_next_result($this->connection);
        $statement = $this->connection->prepare("SELECT * FROM personprofile");

        if($statement->execute()){
            $result = $statement->get_result();
            $statement->close();
            return $result;
        }
    }

    public function create(){
        // Create a new record in the database
        $statement = $this->connection->prepare("INSERT INTO personprofile (firstname, lastname, middlename, gender, address) VALUES ('".$this->firstname."', '".$this->lastname."', '".$this->middlename."', '".$this->gender."', '".$this->address."')");
       
        //sanitize
        $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        $this->lastname=htmlspecialchars(strip_tags($this->lastname));
        $this->middlename=htmlspecialchars(strip_tags($this->middlename));
        $this->gender=htmlspecialchars(strip_tags($this->gender));
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
         $sql = "UPDATE personprofile SET firstname = '".$this->firstname."', lastname = '".$this->lastname."', middlename = '".$this->middlename."', gender ='".$this->gender."' , address = '".$this->address."' WHERE profileid = '".$this->profileid."'";
       
         $statement = $this->connection->prepare($sql);
         
         //sanitize
         $this->firstname=htmlspecialchars(strip_tags($this->firstname));
         $this->lastname=htmlspecialchars(strip_tags($this->lastname));
         $this->middlename=htmlspecialchars(strip_tags($this->middlename));
         $this->gender=htmlspecialchars(strip_tags($this->gender));
         $this->address=htmlspecialchars(strip_tags($this->address));
 
         if($statement->execute()){
             $statement->close();
             return true;
         }
         echo ("Error description: " . $this->connection->error);
         return false;
    }

    public function delete(){
        $statement = $this->connection->prepare("DELETE FROM personprofile WHERE profileid = '".$this->profileid."'");
       
        if($statement->execute()){
            $statement->close();
            return true;
        }
        echo ("Error description: " . $this->connection->error);
        return false;
    }


}

?>