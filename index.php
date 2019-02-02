<?php
/*
 * Amanda Williams
 * January 17, 2019
 * 328/dating/index.php
 */

#Start session
session_start();

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#require autoload
require_once ('vendor/autoload.php');
#require validation file
require ('model/validation-functions.php');

#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);


#-------------------------------------------------------------------------------
#define a default route
$f3->route('GET /', function($f3) {
    //$f3->set('page',"home");
    //$f3->set('title',"Home Page");
    $view = new Template;
    echo $view->render('views/home.html');
});

#-------------------------------------------------------------------------------
#Route to personal-information.html
$f3->route('GET|POST /personalInfo', function($f3) {
    //$f3->set('page',"personal-information");
    //$f3->set('title',"Personal Information");
    $view = new Template;
    echo $view->render('views/personal-information.html');
});

#-------------------------------------------------------------------------------
#Route to profile.html
$f3->route('POST /profile', function($f3) {
    //$f3->set('page',"profile");
    //$f3->set('title',"Profile");
    $_SESSION['firstName']=$_POST['firstName'];
    $_SESSION['lastName']=$_POST['lastName'];
    $_SESSION['age']=$_POST['age'];
    $_SESSION['gender']=$_POST['gender'];
    $_SESSION['phoneNum']=$_POST['phoneNum'];

    //array of states
    $f3->set('states', array("Alabama", "Alaska", "Arizona", "Arkansas",
        "California", "Colorado", "Connecticut", "Delaware", "Florida",
        "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas",
        "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts",
        "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana",
        "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico",
        "New York", "North Carolina", "North Dakota", "Ohio", "Oklahoma",
        "Oregon", "Pennsylvania", "Rhode Island", "South Carolina",
        "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia",
        "Washington", "West Virginia", "Wisconsin", "Wyoming"));
    $view = new Template;
    echo $view->render('views/profile.html');
});

#-------------------------------------------------------------------------------
#Route to interests.html


$f3->route('POST /interests', function($f3) {
    //$f3->set('page',"interests");
    //$f3->set('title',"Interests");
    $_SESSION['email']=$_POST['email'];
    $_SESSION['state']=$_POST['state'];
    $_SESSION['seeking']=$_POST['seeking'];
    $_SESSION['biography']=$_POST['biography'];

    $f3->set('indoor', array("tv"=>"Watch T.V.", "couch"=>"Eating the couch",
        "barking"=>"Barking at Animals Outside", "board-games"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading",
        "playing-cards"=>"Playing Cards",
        "video-games"=>"Video Games"));
    $f3->set('outdoor', array("hiking"=>"Hiking", "fetch"=>"Playing fetch",
        "swimming"=>"Swimming", "collectStick"=>"Collecting sticks",
        "walks"=>"WALKWALKWALK", "chaseCat"=>"Chasing Cats"));
    $view = new Template;
    echo $view->render('views/interests.html');
});


#-------------------------------------------------------------------------------
#Create route to summary page
$f3->route('POST /summary', function($f3) {
    //$f3->set('page', 'summary');
    //$f3->set('title',"Profile Summary");
    $_SESSION['inDoorInt']=implode(", ", $_POST['inDoorInt']);
    $_SESSION['outDoorInt']=implode(", ", $_POST['outDoorInt']);

    $f3->set('fName', $_SESSION['firstName']);
    $f3->set('lName', $_SESSION['lastName']);
    $f3->set('gender', $_SESSION['gender']);
    $f3->set('age', $_SESSION['age']);
    $f3->set('phone', $_SESSION['phoneNum']);
    $f3->set('email', $_SESSION['email']);
    $f3->set('state', $_SESSION['state']);
    $f3->set('seeking', $_SESSION['seeking']);
    $f3->set('interests', $_SESSION['inDoorInt']);
    $f3->set('outerests', $_SESSION['outDoorInt']);

    $f3->set('biography', $_SESSION['biography']);


    $view= new Template();
    echo $view->render('views/summary.html');
});

#-------------------------------------------------------------------------------
#run fat free
$f3->run();


/*
 * test if a form has been submitted or not
 * if(isset($_POST['submit'])
 *
 * validate checkboxes. If valid, then go to next page
 *      else, stay on same page and display error.
 */