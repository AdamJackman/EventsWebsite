<?php
require("libs/config.php");
$_SESSION["memberID"] = 48;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSC309Project</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="content/css/semantic.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript">
    function displayEvent(actionID) {
      $.ajax({
        type: 'get',
        url: 'eventDetails.php',
        data: 'actionID=' + actionID,
        success: function(response){
            //$('#eventBody').text(response);
            var data = JSON && JSON.parse(response) || $.parseJSON(response);
            $('#startDate').text(data['actionid']);
            $('#joinDate').text(data['datejoined']);
            $('#description').text(data['description']);
            $('#minMembers').text(data['minattend']);
          }
        });
    }
    </script>
  </head>


  <body>
  
    <?php include("includes/header.php");?>
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



    <!-- start main container--> 
    <div class ="pull-left" style="display:block; width: 650px">   


    </div> <!--end mainContainer-->
  </body>
</html>
