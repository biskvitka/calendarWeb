<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // $host = "localhost";
    // $user = "root";
    // $password = ">@crypt__Magnetic93!<";
    // require_once('DBManager.php');
    // require_once('Site.php');

    // $dbmanager = new DBManager();
    // $dbmanager->connect();
	// $dbmanager ->addUser('admin', 'Admincho Adminchev', 'admin', 'admin', 'admin@admin.com');
	// $dbmanager ->addUser('gaba', 'Габриела Грозева', 'gaba', 'student', 'gg_grozeva@mail.bg');
	// $dbmanager ->addUser('tosho', 'ТОДОр гаЙДАРОВ', 'tosho', 'lecturer', 'tradle.tgg@gmail.com');
	
	echo date("Y-m-d H:i:s", strtotime(date("Y-m-d") . "+9 hours"));


    // // // echo "<p>connection ok</p>";
    // // $username, $name, $password, $type, $email

    // // $dbmanager->insertSubject("informatics", "Ivan1");
    // // // $date = date("Y-m-d H:i:s", mktime(10, 30, 0, 7, 23, 2017));
    // // // $date2 = date("Y-m-d", mktime(0, 0, 0, 7, 21, 2017));
    // // $dbmanager -> insertEvent('lecture', $date, 12, 10, 'informatics');

    // // // $site = new Site();
    // // $array = $site->readPropsFile('users.csv', 5);

    // // // $subjstudent = $site->readSubjectStudent("subjectstudent.csv");
    // // // $users = $site->readUsers('users.csv');
    // // // $subjects = $site->readSubjects('subjects.csv');

    // // $subs = $dbmanager->getLecturerSubs(10);
    // // $lecturerEvents = $dbmanager->getLecturerEvents($date2, 10);

    // // // $dbmanager->changeRoom(10, 123);
    // // // echo "<pre>";
   // // print_r($lecturerEvents);
    // // // echo "</pre>";

    // // foreach($users as $user) {
        // // $username = $user['username'];
        // // $name = $user['name'];
        // // $password = $user['password'];
        // // $type = $user['type'];
        // // $email = $user['email'];
        // // $dbmanager->addUser();
    // // }
    // // $dbmanager->getAllEvents($date2, 313);
    // // $dbmanager->setEventStatus(2,'approved');
    // // // echo "no error";
    // // $dbmanager->closeConnection();
?>