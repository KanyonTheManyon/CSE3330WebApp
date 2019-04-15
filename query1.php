<?php
    session_start();
    $con = mysqli_connect("localhost", "root", "") OR die("cannot connect");
    mysqli_select_db($con, "world_cup");
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
echo "Connected successfully";
?>

<!DOCTYPE html>
<html>
<head>
<title>Web App</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body style=background-color:#000>
    <div id="main-wrapper">
        <center><h1>Results<br></h1></center>
        <h3><center>
        <?php
            $CountryName = $_SESSION['CountryName'];
            $count = 0;
            printf("Country Name = %s", $CountryName);
        ?>
        </h3></center>
            <div class="results">
                <?php
                    $query = "SELECT G.GameID, Pname, P.PNo FROM Game G, Player P, startinglineup SL WHERE SL.GameID = G.GameID AND SL.TeamID = P.TeamID AND SL.PNo = P.PNo AND P.Team = '$CountryName' ORDER BY GameID ASC, Pno ASC";
                    $query_run = mysqli_query($con, $query);
                    if($query_run){
                        if(mysqli_num_rows($query_run)>0){
                            echo '<center><table border="1" cellspacing="0" cellpadding="4"> 
                            <tr> 
                                <td> <b> GameID </b> </td> 
                                <td> <b> Player Name </b> </td> 
                                <td> <b> Player Number </b> </td> 
                            </tr>';
                            while($row = mysqli_fetch_array($query_run, MYSQLI_ASSOC)){
                                //echo "<b> GameID </b>: " . $row['GameID']. "   <b>Player Name </b>: " . $row['Pname']. "   <b>Player ID </b>: " . $row['PNo']. "<br>";
                                echo '<tr> 
                                    <td>'.$row['GameID'].'</td> 
                                    <td>'.$row['Pname'].'</td> 
                                    <td>'.$row['PNo'].'</td> 
                                </tr>';
                                $count += 1;
                            }

                        }
                        else{
                            echo '<script type="text/javascript">alert("Error: Team not in database")</script>';
                        }
                    }
                    else{
                        echo '<script type="text/javascript">alert("Error: Team not in database")</script>';
                    }
                ?>
                <center><h3>
                <?php
                printf("Total number of Results = %d", $count);
                //session_unset();
                //session_destroy();
                ?>
                </h3></center>
            
            </div>
        <center><button onclick="location.href='index.php';" id="btn_back" name="back_btn" type="submit">Search Again</button></center>
    </div>

</body>
