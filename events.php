<?php

require("libs/config.php");
require("includes/calendar.php");

$_SESSION["memberID"] = 48;

$functions = new Functions();

$cal = new Calendar($db, $functions);
$res = $cal->generateCalendar();

?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="content/css/semantic.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
<link href="css/calendar.css" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>
    <?php include("includes/header.php");?>

  <!-- add in the calendar-->
  <div id="calendar">
    <?php echo $res; ?>
  </div>
  <!-- START LEFT SIDEBAR -->

    <!-- STAR RATING -->
    <div class="sideContainer pull-left">
      <div class="profilepic col-lg-12">
        <a href="#" class="thumbnail">
          <img src="images/profile.jpg">
        </a>
        <span style="margin-left: 5px;"> Rating </span>
        <div class="ui large star rating">
          <i class="icon active"></i>
          <i class="icon active"></i>
          <i class="icon active"></i>
          <i class="icon"></i>
          <i class="icon"></i>
        </div>
      <br/>
      <p style="width: 90%; text-align: right;"> (x votes) </p>
      </div>
      <!-- END STAR RATING-->

    </div> <!-- END LEFT SIDEBAR -->

  <div class ="container pull-left" style="padding: 30px 10px;">   
      <!-- START JUMBOTRON HEADER -->
      <div style="background: #eee; width:630;">
        <h2 style= "margin-bottom: 0%;">Scheduled Events</h2>
        <h4 style="text-align: center;">Attending</h4>
        <?php
          // ------------- CURRENTLY HARD CODED ---------
          $res = $functions->myEvents($db, 'adam@test');
          // ------------- SET TO SHOW ME ---------------
        ?>
        <!-- On rows -->
        <table class="table table-hover eventTable" style="border: 2px solid black; background: #eee;">
          <thead>
            <tr style="background-color:#F7F7F9;">
              <th>Picture </th>
              <th>Event</th>
              <th>Starts</th>
              <th>Ends</th>
              <th>About </th>
              <th>Where </th>
              
            </tr>
          </thead>
          <tbody class = "tableContents">
            <?php
            foreach ($res as $key => $value) :
            ?>
            <tr event="<?php echo $value['actionid']; ?>" <?php echo "id=\"row" . ($key+1) . "\"";
              if (($key+1)%2==0) { echo "style=\"background-color:#F7F7F9;\""; }?>>
                <!-- <td> <img src="test.jpg" alt="DC" style= "max-height: 100px; max-width: 100px;" onerror="this.src='images/profile.jpg'" name ="fill"/></td> -->
                <td><?php echo $value['coverpicture']; ?></td>
                <td><?php echo $value['eventname']; ?></td>
                <td><?php echo $value['startdate']; ?></td>
                <td><?php echo $value['enddate']; ?></td>
                <td><?php echo $value['description']; ?></td>
                <td><?php echo $value['location']; ?></td>
                
            </tr>
            <?php
            endforeach;
            ?>
            

            </table>
            <!-- On cells (`td` or `th`) -->
            <div class="recFriends">
              <h4 style="text-align: center; margin-top:60px">Organizing Events</h4>
              <table class="table table-hover" style="border: 2px solid black; background: #eee;">
                <tbody class = "tableContents">
                  <tr id="row1">
                    <td>Event 1</td>
                  </tr>
                  <tr id = "row2" style="background-color:#F7F7F9;">
                    <td>Event 2</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </tbody>
        </table>
      </div> <!--end of Jumbo -->
    </div> <!--end mainContainer-->
</div>




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript"></script>
  </body>

</html>
