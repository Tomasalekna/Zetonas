<?php
// connect to the database
$db = mysqli_connect('localhost', 'u284886996_tomas', 'enn187xedos', 'u284886996_coin');
    $user_check_query = "SELECT * FROM users WHERE email='ugnee.ugne@gmail.com' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $oldPasswordCheck = mysqli_fetch_assoc($result);
    $password = md5(durne);//encrypt the password before saving in the database
    $query = "UPDATE users SET password='$password' WHERE email='ugnee.ugne@gmail.com'";
    mysqli_query($db, $query);
 ?>



<?php if($coinsleft > 0){
    if($wash > 0){
        echo '<input class="wash-button" type="button" name="clickMe" id="alertTimerButton" value="Plauti!" onclick="alertTimerClickHandler()"/>';
    } else { echo "<p>Nepasirinkote plovyklos.</p>";}
} else {
    echo "Neturite pakankamai žetonų.";
}
?>
