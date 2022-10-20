<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "Turite prisijungti";
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
}
?>
<?php  if (isset($_SESSION['email']) AND ($_SESSION['user_type'] == 'admin') ) : ?>
    <?php $admin_id = $_SESSION['userid']; ?>
    <?php include('server.php') ?>
<?php
    if (!isset($_REQUEST["date"])) {
        $dateSel = "CURDATE()";
    } else {$dateSel = $_REQUEST["date"];} ?>

    <div class="content">
        <h2 style="padding: 0px; margin: 0px;"><?php if ($dateSel === "CURDATE()") {
            echo "Vienos dienos ataskaita";
        } elseif ($dateSel === "CURRENT_DATE - INTERVAL 1 MONTH"){
            echo "Einamojo mėnesio ataskaita";
            } else {
            echo "Einamų metų ataskaita";
            }
        ?></h2>
        <a href="javascript:if(window.print)window.print()">Spausdinti <img src="https://www.shareicon.net/download/2015/09/28/108333_document.ico" width="16"/> </a>
        <p style="padding: 0px; margin: 0px;"><?php reportSum($dateSel); ?></p>
        <p style="padding: 0px; margin: 0px;"><?php reportSumByBox($dateSel,1);?></p>
        <p style="padding: 0px; margin: 0px;"><?php reportSumByBox($dateSel,2);?></p>
        <p style="padding: 0px; margin: 0px;"><?php reportSumByBox($dateSel,3);?></p>

        <h2>Išklotinė:</h2>
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%; text-align: center">
            <thead style="border: 1px solid black">
            <tr style="border: 1px solid black">
                <th scope="col" style="border: 1px solid black">Nr.</th>
                <th scope="col" style="border: 1px solid black">Data</th>
                <th scope="col" style="border: 1px solid black">Plovimo aikštelė</th>
                <th scope="col" style="border: 1px solid black">Panaudota žetonų</th>
            </tr>
            </thead>
            <tbody style="border: 1px solid black">
            <?php report($dateSel); ?>
            </tbody>
        </table>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h5>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h5>
            </div>
        <?php endif ?>
    </div>
<?php endif; ?>

<?php  if (empty($_SESSION['email'])) {
    header("location: login.php");
}
?>
