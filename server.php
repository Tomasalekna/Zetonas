<?php
session_start();

// ERROR showing
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// initializing variables
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($email)) { array_push($errors, "Elektroninio pašto adresą nurodyti būtina."); }
    if (empty($password_1)) { array_push($errors, "Būtina nustatyti slaptažodį."); }
    if ($password_1 != $password_2) {
        array_push($errors, "Slaptažodžiai nesutampa.");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists

        if ($user['email'] === $email) {
            array_push($errors, "Vartotojas su tokiu el. pašto adresu jau yra.");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO users (email, password) 
  			  VALUES('$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "Sėkmingai prisijungėte.";
        header('location: index.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
        array_push($errors, "El.pašto adresas yra privalomas laukelis");
    }
    if (empty($password)) {
        array_push($errors, "Neįvedėte slaptažodžio.");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Sėkmingai prisijungėte";
            header('location: index.php');
        }else {
            array_push($errors, "Neteisingai įvestas el. pašto adresas arba slaptažodis.");
        }
    }
}
$email = $_SESSION['email'];
// USER ID GET
$query = "SELECT id, user_type FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();
$userid    = $row['id'];
$user_type = $row['user_type'];
$_SESSION['userid'] = $userid;
$_SESSION['user_type'] = $user_type;
mysqli_free_result($result);


// COINS LEFT AND COINS HAD GET
$query = "SELECT (SELECT SUM(added) FROM coins WHERE userid='$userid') AS sumadded, (SELECT SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS Panaudota, (SELECT sumadded-SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS sumcoinsleft";
$result = mysqli_query($db, $query);
$result = $db->query($query) or die($db->error);

$row = $result->fetch_assoc();
$_SESSION['coinsleft'] = $row['sumcoinsleft'];
$_SESSION['coinshad'] = $row['sumadded'];
mysqli_free_result($result);

// COINS LEFT AND COINS HAD History get
function history($userid)
    {
        $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
        $query = "SELECT * FROM coins WHERE userid='$userid' ORDER BY date DESC LIMIT 10";
        $result = mysqli_query($db, $query);
        $i = 1;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><th scope='row'>" . $i .  "</th><td>" . $row["added"] . "</td><td>" . $row["date"] . "</td></tr>";
                $i++;
            }
        } else {
            echo "<tr><th scope='row'>" . $i .  "</th><td colspan='2'>" . "Iki šiol nesate papildęs sąskaitos" . "</td></tr>" ;
        }
        mysqli_free_result($result);
    }

// ADMIN COMPANY INFO TABLE
function company($adminid)
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT * FROM wash WHERE admin_id='$adminid'";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><th scope='row'>" . $i .  "</th><td>" . $row["company"] . "</td><td>" . $row["companycode"] . "</td><td>" . $row["vatcode"] . "</td><td>" . $row["address"] . ", " . $row["city"] . "</td><td>" . $row["number"] . "</td></tr>";
            $i++;
        }
    } else {
        echo "<tr><th scope='row'>" . $i .  "</th><td colspan='2'>" . "Jums dar nėra priskirta plovyklų" . "</td></tr>" ;
    }
    mysqli_free_result($result);
}


// ADMIN REPORT TABLE
function report($dateSel)
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT * FROM movement WHERE date >= $dateSel";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><th scope='row'>" . $i .  "</th><td>" . $row["date"] . "</td><td>" . $row["boxid"] . "</td><td>" . $row["coinsless"] . "</td></tr>";
            $i++;
        }
    } else {
        echo "<p>Šiandien Jūsų plovykloje dar nebuvo panaudota žetonų.</p>" ;
    }
    mysqli_free_result($result);
}

// ADMIN REPORT TABLE
function reportSum($dateSel)
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT SUM(coinsless) AS Suma FROM movement WHERE date >= $dateSel";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($row["Suma"]>1)
            {
                echo "<p>Iš viso panaudota: " . $row["Suma"] . " žetonų.<br></p>";
                $i++;
            } else {
                echo "<p>Per pasirinktą laikotarpį žetonų panaudota nebuvo.</p>";
            }
        }
    } else {
        echo "<p>Šiandien Jūsų plovykloje dar nebuvo panaudota žetonų.</p>" ;
    }
    mysqli_free_result($result);
}

// ADMIN REPORT TABLE
function reportSumByBox($dateSel, $boxSel)
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT SUM(coinsless) AS Suma FROM movement WHERE date >= $dateSel AND boxid = $boxSel";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["Suma"]>1){
            echo "Aikštelėje Nr. " . $boxSel . ": " . $row["Suma"] . " žetonai/ų. ";
            $i++;} else {

            }
        }
    } else {
        echo "<p>Šiandien Jūsų plovykloje dar nebuvo panaudota žetonų.</p>" ;
    }
    mysqli_free_result($result);
}




// USE COIN
function useCoin($w, $b, $ui)
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $wash = mysqli_real_escape_string($db, $w);
        $box = mysqli_real_escape_string($db, $b);
        $useridd = mysqli_real_escape_string($db, $ui);

        $query = "INSERT INTO movement (userid,coinsless,washid,boxid) VALUES ('$useridd',1,'$wash','$box')";
        mysqli_query($db, $query);
}

//COINS LEFT FUNCTION
function coinsLeft($userid){
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT (SELECT SUM(added) FROM coins WHERE userid='$userid') AS sumadded, (SELECT SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS Panaudota, (SELECT sumadded-SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS sumcoinsleft";
    $result = mysqli_query($db, $query);
    $result = $db->query($query) or die($db->error);
    $row = $result->fetch_assoc();
    echo "Liko žetonų: " , $row['sumcoinsleft'] , " iš " , $row['sumadded'];
    mysqli_free_result($result);
}

//COINS LEFT FUNCTION
function coinsLeftEmpty($userid){
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT (SELECT SUM(added) FROM coins WHERE userid='$userid') AS sumadded, (SELECT SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS Panaudota, (SELECT sumadded-SUM(movement.coinsless)FROM movement WHERE userid='$userid') AS sumcoinsleft";
    $result = mysqli_query($db, $query);
    $result = $db->query($query) or die($db->error);

    $row = $result->fetch_assoc();
    return $row['sumcoinsleft'];
    mysqli_free_result($result);
}

// ADMIN REPORT TABLE
function users()
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if(coinsLeftEmpty($row["id"]) > 0){$coinsleftuser = coinsLeftEmpty($row["id"]);} else {$coinsleftuser = "0";}
            echo "<tr><th scope='row'>" . $i .  "</th><td>" . $row["email"] . "</td><td>" . $coinsleftuser . "</td><td>" . $row["dateCreated"] . "</td></tr>";
            $i++;
        }
    } else {
        echo "<tr><th scope='row'>" . $i .  "</th><td colspan='2'>" . "Jums dar nėra priskirta plovyklų" . "</td></tr>" ;
    }
    mysqli_free_result($result);
}

// ADMIN REPORT TABLE
function cards()
{
    $db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $query = "SELECT * FROM rechargeCard";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $i = 1;
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["status"]<1){ $status = "Nepanaudotas";} else {$status = "Panaudotas";}

            echo "<tr><th scope='row'>" . $i .  "</th><td>" . $row["code"] . "</td><td>" . $row["value"] . "</td><td>" . $status . "</td></tr>";
            $i++;
        }
    } else {
        echo "<tr><th scope='row'>" . $i .  "</th><td colspan='2'>" . "Jums dar nėra priskirta plovyklų" . "</td></tr>" ;
    }
    mysqli_free_result($result);
}

// UPDATE PASSWORD
if (isset($_POST['changePassword'])) {
    // receive all input values from the form
    $oldPassword = mysqli_real_escape_string($db, $_POST['oldPassword']);
    $newPassword_1 = mysqli_real_escape_string($db, $_POST['newPassword_1']);
    $newPassword_2 = mysqli_real_escape_string($db, $_POST['newPassword_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($oldPassword)) { array_push($errors, "Neįrašytas senas slaptažodis."); }
    if (empty($newPassword_1)) { array_push($errors, "Neįvestas naujas slaptažodis."); }
    if ($newPassword_1 != $newPassword_2) {
        array_push($errors, "Slaptažodžiai nesutampa.");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $oldPasswordCheck = mysqli_fetch_assoc($result);

    if ($oldPasswordCheck) { // if user exists

        if ($oldPasswordCheck['password'] === md5($oldPassword)) {
            // If old password is corect
            if (count($errors) == 0) {
                $password = md5($newPassword_1);//encrypt the password before saving in the database

                $query = "UPDATE users SET password='$password' WHERE email='$email'";
                mysqli_query($db, $query);
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "Slaptažodis pakeistas.";
                header('location: profile.php');
            }
        } else {
            array_push($errors, "Neteisingai įvestas senas slaptažodis.");
        }
    }
}
?>