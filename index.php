<?php
/*
 * Amanda Williams
 * February 13, 2019
 * 328/dating/index1.php
 */


#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#-------------------------------------------------------------------------------
#require autoload
require_once ('vendor/autoload.php');

#Start session
session_start();

#require validation file
require ('model/validation-functions.php');

#-------------------------------------------------------------------------------
#create an instance of the Base class
$f3 = Base::instance();

#Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

#-------------------------------------------------------------------------------
#define a default route
$f3->route('GET /', function() {
    $view = new Template;
    echo $view->render('views/home.html');
});

#-------------------------------------------------------------------------------
#Route to personal-information.html
$f3->route('GET|POST /personalInfo', function($f3) {
    #Initialize Errors
    $f3->set('errorFirstName', '');
    $f3->set('errorLastName', '');
    $f3->set('errorAge', '');
    $f3->set('errorPhone', '');


    #if form is posted
    if (!empty($_POST)) { // isset($_POST['submit'])
        #validate
        #if valid
        if(validName($_POST['firstName'])
            &&validName($_POST['lastName'])
            &&validAge($_POST['age'])
            &&validPhone($_POST['phoneNum'])) {

            /**/
            #check if premium
            if(isset($_POST['premium'])) {
                $_SESSION['premium']=true;
                #create premium member and assign values
                $_SESSION['memberObj']= new PremiumMember($_POST['firstName'],
                    $_POST['lastName'], $_POST['age'], $_POST['gender'],
                    $_POST['phoneNum']);
            }
            else {
                $_SESSION['premium']=false;
                #create  member and assign values
                $_SESSION['memberObj']= new Member($_POST['firstName'],
                    $_POST['lastName'], $_POST['age'], $_POST['gender'],
                    $_POST['phoneNum']);
            }


            /*
            #assign session variables
            $_SESSION['firstName']=$_POST['firstName'];
            $_SESSION['lastName']=$_POST['lastName'];
            $_SESSION['age']=$_POST['age'];
            $_SESSION['phoneNum']=$_POST['phoneNum'];
            $_SESSION['gender']=$_POST['gender'];
            */
            
            #reroute to profile.html
            $f3->reroute('/profile');
        }
        else {
            #Provide errors for invalid data
            if(!validName($_POST['firstName'])) {$f3->set('errorFirstName',
                "Please provide a first name.");}
            if(!validName($_POST['lastName']))  {$f3->set('errorLastName',
                "Please provide a last name.");}
            if(!validAge($_POST['age']))        {$f3->set('errorAge',
                "Please be 18 or older.");}
            if(!validPhone($_POST['phoneNum'])) {$f3->set('errorPhone',
                "Please provide a phone number in the following format : 2223334444");}
        }

        #make form sticky
        if($_POST['gender']=="male"){$f3->set('male','checked');}
        if($_POST['gender']=="female"){$f3->set('female','checked');}

        /*
        if($_POST['premium']) {$_SESSION['premium']=true;}
        else{$_SESSION['premium']=false;}

        if($_POST['premium']){$f3->set('premCheck', 'checked');}
        */
        if(isset($_POST['premium'])) { $f3->set('premCheck', 'checked');}
        else{$f3->set('premCheck', '');}

        $f3->set('firstName',$_POST['firstName']);
        $f3->set('lastName',$_POST['lastName']);
        $f3->set('age',$_POST['age']);
        $f3->set('phoneNum',$_POST['phoneNum']);
    }

    #render personal-information.html
    $view = new Template();
    echo $view->render('views/personal-information.html');
});

#-------------------------------------------------------------------------------
#Route to profile.html
$f3->route('GET|POST /profile', function ($f3) {
    #Initialize Errors
    $f3->set('errorEmail', '');

    #Initialize states array
    $states=array("Alabama"=>"",
        "Alaska"=>"",
        "Arizona"=>"",
        "Arkansas"=>"",
        "California"=>"",
        "Colorado"=>"",
        "Connecticut"=>"",
        "Delaware"=>"",
        "Florida"=>"",
        "Georgia"=>"",
        "Hawaii"=>"",
        "Idaho"=>"",
        "Illinois"=>"",
        "Indiana"=>"",
        "Iowa"=>"",
        "Kansas"=>"",
        "Kentucky"=>"",
        "Louisiana",
        "Maine",
        "Maryland",
        "Massachusetts",
        "Michigan"=>"",
        "Minnesota",
        "Mississippi",
        "Missouri",
        "Montana",
        "Nebraska"=>"",
        "Nevada"=>"",
        "New Hampshire"=>"",
        "New Jersey"=>"",
        "New Mexico"=>"",
        "New York"=>"",
        "North Carolina"=>"",
        "North Dakota"=>"",
        "Ohio"=>"",
        "Oklahoma"=>"",
        "Oregon"=>"",
        "Pennsylvania"=>"",
        "Rhode Island"=>"",
        "South Carolina"=>"",
        "South Dakota"=>"",
        "Tennessee"=>"",
        "Texas"=>"",
        "Utah"=>"",
        "Vermont"=>"",
        "Virginia"=>"",
        "Washington"=>"",
        "West Virginia"=>"",
        "Wisconsin"=>"",
        "Wyoming"=>"");

    #If form is posted
    if(!empty($_POST)) { // isset($_POST['submit'])
        #validate
        #if is valid
        if (!($_POST['email']==='')) {
            #get member obj
            $member = $_SESSION['memberObj'];
            #set new data
            $member->setEmail($_POST['email']);
            $member->setState($_POST['state']);
            $member->setSeeking($_POST['seeking']);
            $member->setBio($_POST['bio']);
            #restore member obj
            $_SESSION['memberObj']=$member;

            /*
            #assign session variables
            $_SESSION['email']=$_POST['email'];
            $_SESSION['state']=$_POST['state'];
            $_SESSION['seeking']=$_POST['seeking'];
            $_SESSION['biography']=$_POST['biography'];
            */

            #if premium
            if($_SESSION['premium']) {
                #reroute to interests
                $f3->reroute('interests');
            }
            #not premium
            #reroute to summary
            $f3->reroute('summary');
         }
        #provide errors for invalid data
        $f3->set('errorEmail', 'Please provide an email address.');

        #make form sticky
        if($_POST['seeking']=="borker"){$f3->set('borker','checked');}
        if($_POST['seeking']=="moon-moon"){$f3->set('moonMoon','checked');}

        $states[$_POST['state']]='selected';

        $f3->set('biography',$_POST['biography']);
    }
    $f3->set('states', $states);

    #render profile.html
    $view = new Template();
    echo $view->render('views/profile.html'); #part of error points here
});

#-------------------------------------------------------------------------------
#Route to interests.html
$f3->route('GET|POST /interests', function ($f3) {
    #Initialize Errors
    $f3->set('errorInterests', '');

    #Initialize indoor and outdoor arrays
    $f3->set('indoor', array("tv"=>"Watch T.V.", "couch"=>"Eating the couch",
        "barking"=>"Barking at Animals Outside", "board-games"=>"Board Games",
        "puzzles"=>"Puzzles", "reading"=>"Reading",
        "playing-cards"=>"Playing Cards",
        "video-games"=>"Video Games"));
    $f3->set('outdoor', array("hiking"=>"Hiking", "fetch"=>"Playing fetch",
        "swimming"=>"Swimming", "collectStick"=>"Collecting sticks",
        "walks"=>"WALKWALKWALK", "chaseCat"=>"Chasing Cats"));

    #If form is posted
    if(!empty($_POST)) { // isset($_POST['submit'])
        #validate
        #if is valid
        if (validIndoor($_POST['inDoorInt'])&&
            validOutdoor($_POST['outDoorInt'])) {
            #get member obj
            $member = $_SESSION['memberObj'];
            #set new data
            $member->setInDoorInterests($_POST['inDoorInt']);
            $member->setOutDoorInterests($_POST['outDoorInt']);
            #restore member obj
            $_SESSION['memberObj']=$member;

            /*
            #assign session variables
            $_SESSION['interests']= validIndoor($_POST['inDoorInt']);
            $_SESSION['outerests']= validIndoor($_POST['outDoorInt']);
            //$f3->set('interests', validIndoor($_POST['inDoorInt']));
            //$f3->set('outerests', validIndoor($_POST['outDoorInt']));
            */

            #if a gender is not chosen
            if($_SESSION['gender']!='male'||$_SESSION['gender']!='female'){$f3->set('gender', 'Not Given');}
            else{$f3->set('gender', $_SESSION['gender']);}

            #reroute to interests
            $f3->reroute('summary');
        }
        #provide errors for invalid data
        $f3->set('errorInterests',
            'What do you think you\'re you doing?');

        #make form sticky
        //$f3->set('selectedInt',$_POST['inDoorInt']);
        //$f3->set('selectedOut',$_POST['outDoorInt']);
    }
    #render profile.html
    $view = new Template();
    echo $view->render('views/interests.html');
});

#-------------------------------------------------------------------------------
#Route to summary.html
$f3->route('GET|POST /summary', function ($f3) {
    #get member obj
    $member = $_SESSION['memberObj'];

    #set new data
    $member->setEmail($_POST['email']);
    $member->setState($_POST['state']);
    $member->setSeeking($_POST['seeking']);
    $member->setBio($_POST['bio']);
    #restore member obj
    $_SESSION['memberObj']=$member;


    $f3->set('fName', $member->getFname());
    $f3->set('lName', $member->getLname());
    $f3->set('age', $member->getAge());
    $f3->set('gender', strtoupper( $member->getGender()));
    $f3->set('phone', $member->getPhone());
    $f3->set('email', $member->getEmail());
    $f3->set('state', $member->getState());
    $f3->set('seeking', $member->getSeeking());

    #if Premium set interests
    if($_SESSION['premium']) {

        $interests= $member->getInDoorInterests();
        $outerests= $member->getOutDoorInterests();
        $f3->set('premiumInterests',
            "<tr><td>Interests: $interests<br>$outerests</td></tr>");
    }
    else {
        $f3->set('premiumInterests',"");
    }

    $f3->set('biography', $member->getBio());

    #Render summary.html
    $view= new Template();
    echo $view->render('views/summary.html');
});

#-------------------------------------------------------------------------------
#run fat free
$f3->run();