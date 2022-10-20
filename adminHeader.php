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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Žetonas.Lt</title>
    <link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Amita|Courgette" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a class="navbar-brand name" href="index.php">
                <img src="img/coin.svg" width="30" height="30" class="d-inline-block align-top" alt="">
                Žetonas.lt
            </a>
        </div>

        <ul class="list-unstyled components">
            <form>
                <ul class="navbar-nav mr-auto">
                    <?php  if (isset($_SESSION['email'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Sveiki, <br> <?php echo $_SESSION['email']; ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Pagrindinis</a>
                            <a class="nav-link" href="admin_reports.php">Ataskaita</a>
                            <a class="nav-link" href="admin_users.php">Vartotojai</a>
                            <a class="nav-link" href="admin_cards.php">Papildymo kortelės</a>

                        </li>
                        <li class="nav-item">
                            <a href="index.php?logout='1'" class="btn btn-danger text-left">Atsijungti</a>
                        </li>
                    <?php endif ?>
                </ul>
            </form>
        </ul>
    </nav>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    });
</script>


<div class="content">
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