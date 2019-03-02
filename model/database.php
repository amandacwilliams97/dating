<?php
/*
 * Amanda Williams
 * March 1, 2019
 * 328/dating/database.php
 */

#Error Reporting
ini_set("display_errors", 1);
error_reporting(E_ALL);

#Require database constants
require_once ('/home/awilliam/config.php');

/*
 * TABLE COLUMNS IN ORDER
 * member_id, fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests
 * *****************************************************************************
 */
//******************************************************************************
#*******************************************************************************
function connect()
{
    #connect to the database
    try {
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        return $dbh;
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function insertMember($fname, $lname, $age, $gender, $phone, $email,
                      $state, $seeking, $bio, $premium, $image, $interests)
{
    global $dbh;

    //Create SQL statement
    $sql = "INSERT INTO Members (fname, lname, age, gender, phone, email, state,
                seeking, bio, premium, image, interests) 
            VALUES(:fname, :lname, :age, :gender, :phone, :email, :state,
                :seeking, :bio, :premium, :image, :interests)";

    //prepare statement
    $statement=$dbh->prepare($sql);

    //bind parameters
    $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
    $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
    $statement->bindParam(':age', $age, PDO::PARAM_STR);
    $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
    $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':state', $state, PDO::PARAM_STR);
    $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
    $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
    $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
    $statement->bindParam(':image', $image, PDO::PARAM_STR);
    $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

    //execute statement
    $success = $statement->execute();

    //return success
    return $success;

}

function getMembers()
{
    global $dbh;

    //Create SQL statement
    $sql = "SELECT * FROM Members ORDER BY lname";

    //prepare statement
    $statement = $dbh->prepare($sql);

    //execute statement
    $statement->execute();

    //save results
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    //return result
    return $result;

}

function getMember($id)
{
    global $dbh;

    //$id = (integer)$id;

    //Create SQL statement
    $sql = "SELECT * FROM Members WHERE member_id=$id";

    //prepare statement
    $statement = $dbh->prepare($sql);

    //execute statement
    $statement->execute();

    //save results
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    //return member
    return $result;
}
