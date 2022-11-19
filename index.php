<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesssion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1>Login Form</h1>
        <?php if (isset($_SESSION['message'])) { ?>
            <div class="alert <?php echo ($_SESSION['messageStyle']) ?>">
                <p><?php echo ($_SESSION['message']) ?></p>
            </div>
            <?php
            unset($_SESSION['message']);
            unset($_SESSION['messageStyle']);
            ?>
        <?php } ?>
        <?php if (isset($_SESSION["isLogedIn"]) && $_SESSION["isLogedIn"] = 1) {
            return;
        } else if(isset($_COOKIE['falseLoginCounter'])){  ?>
        <h1>false login</h1>
        <?php } ?>
        <?php  if($_COOKIE['falseLoginCounter'] > 2){
            return;
        }?>
        <form class="d-flex flex-column m-5" method="post" action="index.php">
                <input class="form-controll m-1" name="name" type="text">
                <input class="form-controll m-1" name="password" type="password">
                <button class="btn btn-primary m-3" name="loginButton" type="submit">Login</button>
            </form>

        <?php if (isset($_POST['loginButton'])) {
            $loginName = $_POST['name'];
            $password = $_POST['password'];
            $correctName = "admin";
            $correctPassword = "123";
            if ($loginName == $correctName && $password == $correctPassword) {
      
                $_SESSION["isLogedIn"] = 1;
                $_SESSION["logedUser"] = $loginName;
                header("Location: myaccount.php");
                exit();
            } else {
                if (isset($_COOKIE['falseLoginCounter'] )) {
                    $newvalue = $_COOKIE['falseLoginCounter'];
                    $newvalue++;
                    setcookie('falseLoginCounter',$newvalue, time()+60, "/");

                    if($_COOKIE['falseLoginCounter'] > 1){
                        $_SESSION['message'] = "Login error, wait 60 seconds";
                        header("Location:index.php");
                        exit();
                    }
                } else {
                    setcookie('falseLoginCounter', 1, time()+60, "/");
                }
                $_SESSION['message'] = "Login error";
                $_SESSION['messageStyle'] = "alert-danger";
                header("Location:index.php");
                exit();
            }
        } ?>

    </div>
</body>

</html>