<?php
    class DBManager {

        public $dbcon;
        public $db;

        private $host = "localhost";
        private $user = "root";
        private $password = ">@crypt__Magnetic93!<";

        function __construct() {
            echo "<p>DBManager constructed</p>";
        }

        // --------------- basic ---------------
        public function connect() { 
            echo "<p>connection ok</p>";
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
            // echo $query;
            $result = $this->getQuery($query);
        }
        
        public function insertEvent($type, $date, $roomid, $userid, $name) {
            $query = "SELECT subjectid FROM subjects WHERE userid = $userid and name = '$name'";
            
            $result = $this->getQuery($query);
            $subjid = mysqli_fetch_assoc($result);

            $query = "INSERT INTO events(type, date, room, status, subjectId) values('$type', '$date', $roomid, 'none', $subjid[0])";
            // echo "$query";
            $result = $this->getQuery($query);
        }

        // returns array of query results. Each result is an assoc array with keys {date, subjname, lecturer, room, type}
        public function getStudentEvents($userid, $date) {
            $query = "SELECT events.date, subjects.name as subjname, users.name as lecturer, events.room, events.type FROM subjectstudent 
                        JOIN events ON events.subjectId = subjectstudent.subjectid 
                        JOIN subjects ON events.subjectId = subjects.subjectid 
                        JOIN users ON users.userid = subjects.userid
                    WHERE subjectstudent.userid = $userid and status = 'approved' and DATE(date) = '$date'";
            echo $query;
            $result = $this->getQuery($query);
            return $result;
            // while($event = mysqli_fetch_assoc($result)) {
            //     echo "<pre>";
            //     print_r($event);
            //     echo "</pre>";
            // }
        }

        public function getAllEvents($date) {
            $query = "SELECT events.eventid, events.date, subjects.name as subjname, users.name as lecturer, events.room, events.type FROM events
                        JOIN subjects ON events.subjectId = subjects.subjectid
                        JOIN users ON users.userid = subjects.userid
                    WHERE DATE(date) = '$date' and  status = 'approved'";
            echo $query;
            $result = $this->getQuery($query);
            $rows;

            while($event = mysqli_fetch_assoc($result)) {
                $rows[] = $event;
            }

           return $rows;
        }

        public function setEventStatus($eventid, $status) {
            $query = "UPDATE events SET status = '$status' WHERE eventid = $eventid";
            echo $query;
            $result = $this->getQuery($query);
        }

        // public function insertEvent($date, $room, $subjname) {
            
        // }
     }
?>