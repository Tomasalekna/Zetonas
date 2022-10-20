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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand name" href="index.php">
        <img src="img/coin.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Žetonas.lt
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="info.php">Informacija</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
                <?php  if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Prisijungęs kaip <?php echo $_SESSION['email']; ?></a>
                    </li>
                <?php  if ($_SESSION['user_type'] == 'admin') : ?>
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link">Administruoti</a>
                    </li>
                <?php endif ?>
                    <li class="nav-item">
                        <a href="index.php?logout='1'" class="btn btn-danger">Atsijungti</a>
                    </li>
                <?php endif ?>
                <?php if (empty($_SESSION['email'])) : ?>
                        <li class="nav-item">
                            <a class="btn btn-sm btn-success" href="login.php">Prisijungti</a>
                            <a class="btn btn-sm btn-primary" href="register.php">Registracija</a>
                        </li>
                <?php endif ?>
            </ul>
        </form>
    </div>
</nav>
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