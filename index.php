<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "") OR die("cannot connect");
    mysqli_select_db($con, "world_cup");
?>

<!DOCTYPE html>
<html>
<head>
<title>Web App</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style=background-color:#000>
    <div id="main-wrapper">
        <center><h2>Search our World Cup Database!</h2></center>

        <div class="inner-form">
            <form action="index.php" method="post">

            <label><b>Country Name</b></label>
            <input type="text" placeholder="Enter Country Name" name="CountryName">
            <label><b>Color of Card (Optional)</b></label>
            <input type='text' placeholder="Enter Color of Card" name="CardColor">

            <center>
            <button id="btn_go" name="go_btn" type="submit">Submit</button>

            </form>

            <?php
                if(isset($_POST['go_btn'])){
                    //echo '<script type="text/javascript">alert("Go button clicked")</script>';
                    $CountryName = $_POST['CountryName'];
                    $CardColor = $_POST['CardColor'];
                    if($CountryName==""){
                        echo '<script type="text/javascript">alert("You must enter a Country Name")</script>';
                    }
                    else{
                        if($CardColor==""){     //query1
                            $_SESSION["CountryName"]=$CountryName;
                            header("Location:query1.php");
                        }

                        else{                   //query2
                            $_SESSION["CountryName"]=$CountryName;
                            $_SESSION["CardColor"]=$CardColor;
                            header("Location:query2.php");
                        }
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>