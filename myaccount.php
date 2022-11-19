<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?php 
        if(isset($_SESSION['isLogedIn']) && $_SESSION['isLogedIn'] == 1){
            echo "Sveikas prisijunges" . $_SESSION["logedUser"];
        } else {
            echo("Unauthorised");
        }
        ?>
        <h2>Welcomme <?php echo($_SESSION['isLogedIn']); ?></h2>
    </div>
    <div>
    <form method="post" action="myaccount.php">
            <button class="btn btn-primary" type="submit" name="logout">LogOut</button>
        </form>   
    </div>
<?php
if(isset($_POST['logout'])){
    unset($_SESSION['isLogedIn']);
    unset($_SESSION['logedUser']);
    $_SESSION['message'] = "LogOut success";
    $_SESSION['messageStyle'] = "alert-success";
    header("Location: index.php");
    exit();
}
?>
</body>
</html>