<?php
    class DBManager {

        public $dbcon;
        public $db;

        private $host = "localhost";
        private $user = "root";
        private $password = "";

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
           $encrypted = hash("sha256", $password);
           $exist = $this->login($username, $encrypted);
           if(empty($exist)) {
                $query = "INSERT INTO users(username, pass, name, type, email) VALUES('$username', '$encrypted', '$name', '$type', '$email')";
                $result = $this->getQuery($query);
                return true;
           }

           return false;
        }

        
        public function insertSubject($name, $lecturerName) {
            $query = "SELECT userid FROM users WHERE name = '$lecturerName' and type = 'lecturer'";
            $result = $this->getQuery($query);

           // print_r(mysqli_fetch_assoc($result));
            $result = mysqli_fetch_assoc($result);
            $userid = $result['userid'];
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
            $queryUserid = "SELECT userid FROM users WHERE username = '$username' and type = 'student'";
            $resultuid = $this->getQuery($queryUserid);

            $querySubjid = "SELECT subjectid FROM subjects WHERE name = '$name'";
            $resultsid = $this->getQuery($querySubjid);

           // print_r(mysqli_fetch_assoc($result));
            $resultuid = mysqli_fetch_assoc($resultuid);
            $userid = $resultuid['userid'];
            $resultsid = mysqli_fetch_assoc($resultsid);
            $subjecttid = $resultsi['subjectid'];

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
            // echo $query;
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
            // echo $query;
            $result = $this->getQuery($query);
        }

        public function deleteEvent($eventid) {
            $query = "DELETE FROM events WHERE eventid = '$eventid'";
            // echo $query;
            $result = $this->getQuery($query);
        }

        // public function changeRoom($eventid, $room) {
        //     $query = "UPDATE events SET room = '$room'"
        // }
        // public function getNumberCol($tablename) {
        //     $query = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tablename'";
        //     $result = $this->getQuery($query);
        //     //$result = mysqli_fetch_array($result);
        //     echo "<pre>";
        //     print_r($result);
        //     echo "</pre>";
        // }

     }
?>