﻿<?php
//Fill this place
$conn = mysqli_connect("localhost",'root');
if(! $conn )
{
    die('连接错误: ' . mysqli_error($conn));
}
mysqli_select_db($conn, "travel");
//****** Hint ******
//connect database and fetch data here


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chapter 14</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />



    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />

</head>

<body>
<?php include 'header.inc.php'; ?>



<!-- Page Content -->
<main class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Filters</div>
        <div class="panel-body">
            <form action="Lab10.php" method="get" class="form-horizontal">
                <div class="form-inline">
                    <select name="continent" class="form-control">
                        <option value="0">Select Continent</option>
                    <?php
                        //Fill this place
                        $sql = 'SELECT * FROM continents';
                    if($result = mysqli_query($conn, $sql) )
                    {

                        //****** Hint ******
                        //display the list of continents
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                        }
                    }

                        ?>

                    </select>
                    <select name="country" class="form-control">
                        <option value="0">Select Country</option>
                        <?php
                        //Fill this place
                        $sql = 'SELECT * FROM countries';

                        if($result = mysqli_query($conn, $sql) ){
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                            }
                        }
                        //****** Hint ******
                        /* display list of countries */
                        ?>
                    </select>
                    <input type="text"  placeholder="Search title" class="form-control" name="title">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

        </div>
    </div>


    <ul class="caption-style-2">
        <?php
        //Fill this place

        //****** Hint ******
        /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data */

        @$countries = $_GET["country"];
        @$continents = $_GET["continent"];
        if($countries == "0"){
            if($continents == "0"){
                $sql = "SELECT * FROM imagedetails";
            }else{
                $sql = "SELECT * FROM imagedetails WHERE ContinentCode = '$continents'";
            }
        }else{
            if($continents == "0"){
                $sql = "SELECT * FROM imagedetails WHERE CountryCodeISO = '$countries'";

            }else{
                $sql = "SELECT * FROM imagedetails WHERE ContinentCode = '$continents' AND CountryCodeISO = '$countries'";

            }
        }
        if($result = mysqli_query($conn, $sql)){
            while($row = mysqli_fetch_array($result)){
                echo "
        <li>
          <a href='detail.php?id={$row["ImageID"]}' class='img-responsive'>
            <img src='images/square-medium/{$row["Path"]}' alt='{$row["Title"]}'>
            <div class='caption'>
              <div class='blur'></div>
              <div class='caption-text'>
                <p>{$row["Title"]}</p>
              </div>
            </div>
          </a>
        </li>
       ";
            }
        }

        mysqli_close($conn);
        ?>
    </ul>


</main>

<footer>
    <div class="container-fluid">
        <div class="row final">
            <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
            <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
        </div>
    </div>


</footer>


<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>