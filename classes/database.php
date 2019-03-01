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

/**
 * Yep that's a database alright.
 * And it's beating up our cheese.
 * Class Database
 */
class Database
{
    //fields


    //methods
    /**
     * Connects to the database
     * @return bool|PDO, the database
     */
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

    /**
     * Adds a member to the database
     * @param $member_id, just guess what it represents.
     * @param $fname, just guess what it represents.
     * @param $lname, just guess what it represents.
     * @param $age, just guess what it represents.
     * @param $gender, just guess what it represents.
     * @param $phone, just guess what it represents.
     * @param $email, just guess what it represents.
     * @param $state, just guess what it represents.
     * @param $seeking, just guess what it represents.
     * @param $bio, just guess what it represents.
     * @param $premium, just guess what it represents.
     * @param $image, just guess what it represents.
     * @param $interests, just guess what it represents.
     * @return bool, just guess what it represents.
     */
    function insertMember($member_id, $fname, $lname, $age, $gender, $phone, $email,
                          $state, $seeking, $bio, $premium, $image, $interests)
    {
        global $dbh;

        //Create SQL statement
        $sql = "INSERT INTO Members VALUES(:member_id, :fname, :lname, :age, :gender, 
            :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

        //prepare statement
        $statement=$dbh->prepare($sql);

        //bind parameters
        $statement->bindParam(':member_id', $member_id, PDO::PARAM_INT);
        $statement->bindParam(':fname', $fname, PDO::PARAM);
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

        //execute statement
        $success = $statement->execute();

        //return success
        return $success;

    }

    /**
     * Provides all members in the database
     * @return array, the memebers in the database
     */
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

    /**
     * Retrieves the specified member from the datatable
     * @param $id, member's id
     * @return mixed, the member's saved data
     */
    function getMember($id)
    {
        global $dbh;

        //Create SQL statement
        $sql = "SELECT * FROM Members WHERE 'member_id'=$id";

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //save results
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        //return member
        return $result;
    }
}