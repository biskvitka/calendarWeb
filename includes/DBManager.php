<?php
    class DBManager {

        public $dbcon;
        public $db;

        private $host = "localhost";
        private $user = "root";
        private $password = ">@crypt__Magnetic93!<";

        // --------------- basic ---------------
        public function connect() { 
            $this->dbcon = mysqli_connect($this->host, $this->user, $this->password) or die("DB connection problem");
            $this->db = mysqli_select_db($this->dbcon, "calendar") or die("Couldn't select database");
            mysqli_query($this->dbcon, "SET NAMES UTF8");
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
            $encrypted = hash("sha256", $password);
            $query = "SELECT * FROM users WHERE username = '$username' AND pass = '$encrypted'";
            $result = $this->getQuery($query);
            $row = mysqli_fetch_array($result);
			return $row;
        }

        public function addUser($username, $name, $password, $type, $email) {
			$username = trim($username);
			$name = trim($name);
			$password = trim($password);
			$type = trim($type);
			$email = trim($email);
           $encrypted = hash("sha256", $password);
           $exist = $this->login($username, $password);
           if(empty($exist)) {
                $query = "INSERT INTO users(username, pass, name, type, email) VALUES('$username', '$encrypted', '$name', '$type', '$email')";
				// echo $query;
                $result = $this->getQuery($query);
                return true;
           }
			
           return false;
        }

        
        public function insertSubject($name, $lecturerName) {
			$lecturerName = trim($lecturerName);
			$name = trim($name);
            $query = "SELECT userid FROM users WHERE name = '$lecturerName' and type = 'lecturer'";
            $result = $this->getQuery($query);

            $user = mysqli_fetch_assoc($result);
            $userid = $user['userid'];

            $query = "INSERT INTO subjects(name, userid) values('$name', $userid)";
			// echo $query;
            $result = $this->getQuery($query);
        }
        
        public function insertEvent($type, $date, $roomid, $subject) {
            // $query = "SELECT subjectid FROM subjects WHERE userid = $userid and name = '$name'";
            
            // $result = $this->getQuery($query);
            // $subjid = mysqli_fetch_assoc($result);

            $query = "INSERT INTO events(type, date, room, status, subjectId) values('$type', '$date', $roomid, 'none', $subject)";
            // echo "$query";
            $result = $this->getQuery($query);
        }

        public function insertSubjectStudent($name, $username) {
			$name = trim($name);
			$username = trim($username);
            $queryUserid = "SELECT userid FROM users WHERE username = '$username' and type = 'student'";
            $resultuid = $this->getQuery($queryUserid);

            $querySubjid = "SELECT subjectid FROM subjects WHERE name = '$name'";
            $resultsid = $this->getQuery($querySubjid);

           // print_r(mysqli_fetch_assoc($result));
            $user = mysqli_fetch_assoc($resultuid);
            $userid = $user['userid'];
            $subject = mysqli_fetch_assoc($resultsid);
            $subjectid = $subject['subjectid'];

            $query = "INSERT INTO subjectstudent(subjectid, userid) values($subjectid, $userid)";
            // echo $query;
            $result = $this->getQuery($query);
        }

        // returns array of query results. Each result is an assoc array with keys {date, subjname, lecturer, room, type}
        public function getStudentEvents($userid, $date) {
            $query = "SELECT events.date, subjects.name as subjname, users.name as lecturer, events.room, events.type FROM subjectstudent 
                        JOIN events ON events.subjectId = subjectstudent.subjectid 
                        JOIN subjects ON events.subjectId = subjects.subjectid 
                        JOIN users ON users.userid = subjects.userid
                    WHERE subjectstudent.userid = $userid and status = 'approved' and DATE(date) = '$date'";
            //echo $query;
            $result = $this->getQuery($query);
            
            $rows = array();
            while($event = mysqli_fetch_assoc($result)) {
                $rows[] = $event;
            }
            return $rows;
        }

        //TODO: moje da se opravi samo approved ili vsichki
        public function getAllEvents($date) {
            $query = "SELECT events.eventid, events.date, subjects.name as subjname, users.name as lecturer, events.room, events.type, events.status FROM events
                        JOIN subjects ON events.subjectId = subjects.subjectid
                        JOIN users ON users.userid = subjects.userid
                    WHERE DATE(date) = '$date'";
            // echo $query;
            $result = $this->getQuery($query);
            
            $rows = array();
            while($event = mysqli_fetch_assoc($result)) {
                $rows[] = $event;
            }

           return $rows;
        }

        public function getLecturerEvents($date, $userid) {
            $query = "SELECT events.eventid, events.date, subjects.name as subjname, users.name as lecturer, events.room, events.type, events.status FROM events
                        JOIN subjects ON events.subjectId = subjects.subjectid
                        JOIN users ON users.userid = subjects.userid
                    WHERE DATE(date) = '$date' and ((status ='approved' and users.userid <> $userid) or (users.userid = $userid))";
            // echo $query;
            $result = $this->getQuery($query);
            
            $rows = array();
            while($event = mysqli_fetch_assoc($result)) {
                $rows[] = $event;
            }
           return $rows;
        }

        public function getLecturerSubs($userid) {
            $query = "SELECT subjectid, name FROM subjects WHERE userid = '$userid'";
            // echo $query;
            $result = $this->getQuery($query);

            $subs = array();
            while($sub = mysqli_fetch_assoc($result)) {
                $subs[] = $sub;
            }

            return $subs;
        }

        public function setEventStatus($eventid, $status) {
            $query = "UPDATE events SET status = '$status' WHERE eventid = $eventid";
            //echo $query;
            $result = $this->getQuery($query);
        }

        public function getEvent($eventid) {
            $query = "SELECT * FROM events WHERE eventid = $eventid";
            //echo $query;
            $result = $this->getQuery($query);
			$rows = array();
            while($event = mysqli_fetch_assoc($result)) {
                $rows[] = $event;
            }
           return $rows[0];
        }

        public function deleteEvent($userid, $eventid) {
            $query = "DELETE events 
                      FROM events JOIN subjects on events.subjectId = subjects.subjectid
                      WHERE eventid = '$eventid' and subjects.userid = '$userid'";
            // echo $query;
            $result = $this->getQuery($query);
        }

        public function changeRoom($eventid, $room) {
            $query = "UPDATE events SET room = $room, status = 'none' WHERE eventid = $eventid";
           // echo $query;
            $result = $this->getQuery($query);
        }
     }
?>