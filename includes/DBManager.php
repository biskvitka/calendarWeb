<?php
    class DBManager {

        public $dbcon;
        public $db;

        private $host = "localhost";
        private $user = "root";
        private $password = "";

        // --------------- basic ---------------
        public function connect() { 
            // echo "<p>connection ok</p>";
            $this->dbcon = mysqli_connect($this->host, $this->user, $this->password) or die("DB connection problem");
          
            $this->db = mysqli_select_db($this->dbcon, "calendar") or die("Couldn't select database");
        }

        private function getQuery($query) {
            if($this->dbcon != NULL && $query != NULL){
				//echo $query . "<br/>";
				$result = mysqli_query($this->dbcon, $query) or die ("Someting wrong with SQL");
				return $result;
			} else
				return NULL;
        }

        public function closeConnection() {
            mysqli_close($this->dbcon);
        }

        public function isRegistered($username) {

            // if($this->dbcon != NULL )
        }

        public function login($username, $password) {
            $query = "SELECT * FROM users WHERE username = '$username' AND pass = '$password'";
            $result = $this->getQuery($query);
            $row = mysqli_fetch_array($result);
			return $row;
        }

        public function addUser($username, $name, $password, $type, $email) {
            //TODO: check for existing user
           $query = "INSERT INTO users(username, pass, name, type, email) VALUES('$username', '$password', '$name', '$type', '$email')";
           echo $query."<br>";
           $result = $this->getQuery($query);
        }

        
        public function insertSubject($name, $lecturerName) {
            $query = "SELECT userid FROM users WHERE name = '$lecturerName' and type = 'lecturer'";
            echo "$query";
            $result = $this->getQuery($query);

           // print_r(mysqli_fetch_assoc($result));
            $result = mysqli_fetch_assoc($result);
            $userid = $result['userid'];
            $query = "INSERT INTO subjects(name, userid) values('$name', $userid)";
            echo $query;
            $result = $this->getQuery($query);
        }
        
        // public function insertEvent($type, $date, $roomid, $userid, $name) {
        //     $query = "SELECT subjectid FROM subjects WHERE userid = $userid and name = '$name'";
        //     echo "$query";
        //     //$query = "INSERT INTO events(type, date, room, status, subjectId) values('$type', $date, $roomid, 'none', )";
        // }

    //     public function getStudentEvents() {

    //     }
     }
?>