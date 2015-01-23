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


    <div class ="pull-left" style="display:block; width: 650px">   
      <!-- START JUMBOTRON HEADER -->
      <div class="jumbotron" style="background: #eee; width:630px;">
        <h2 style= "margin-bottom: 0%;">Friends List:</h2>
        <p style="text-align: center;">Friends</p>
        <?php
          // ------------- CURRENTLY HARD CODED ---------
          $res = $functions->getFriendsWithInfo($db, 51);
          // ------------- SET TO SHOW ME ---------------
        ?>
        <!-- On rows -->
        <table class="table table-hover eventTable" style="border: 2px solid black; background: #eee;">
          <thead>
            <tr style="background-color:#F7F7F9;">
              <th>#</th>
              <th>Friend</th>
              <th>Email</th>
              <th>Occupation</th>
              <th>Rating </th>
            </tr>
          </thead>
          <tbody class = "tableContents">
            <?php
            foreach ($res as $key => $value) :
            ?>
            <tr event="<?php echo $value['actionid']; ?>" <?php echo "id=\"row" . ($key+1) . "\"";
              if (($key+1)%2==0) { echo "style=\"background-color:#F7F7F9;\""; }?>>
                <?php $rat = $functions->averageRating($db, $value['memberid']); ?>
                <!-- <td><?php echo $key+1; ?></td> -->


                <td> <img src="test2.jpg" alt="DC" style= "max-height: 100px; max-width: 100px;" onerror="this.src='images/profile.jpg'" name ="fill"/></td>
                <!-- <td><?php echo $value['profilepicture']; ?></td> -->
                <td><?php echo $value['identity']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><?php echo $value['occupation']; ?></td>
                <td><?php echo $rat ?></td>
            </tr>
            <?php
            endforeach;
            ?>
            
            </table>
            <!-- On cells (`td` or `th`) -->
            <div class="recFriends">
              <p style="text-align: center; margin-top:60px">Recommended Friends</p3>
              <table class="table table-hover" style="border: 2px solid black; background: #eee;">
                <tbody class = "tableContents">
                  <tr id="row1">
                    <td>Friend 1</td>
                  </tr>
                  <tr id = "row2" style="background-color:#F7F7F9;">
                    <td>Friend 2</td>
                  </tr>
                  <tr id = "row3" >
                    <td>Friend3</td>
                  </tr>
                  <tr id = "row4" style="background-color:#F7F7F9;">
                  <td>Friend4</td>
                    </tr>
                  <tr id = "row5" >
                    <td>Friend5</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </tbody>
        </table>
      </div> <!--end of Jumbo -->
    </div> <!--end mainContainer-->



    <!-- Make the friends upcoming events panel -->
    <div class ="pull-left" style="background: #eee; display:block; width:900px; padding: 30px 20px;">
      <h2 style="margin-bottom: 0%;" >Upcoming Friend Events</h2>
      <?php
        // ------------- CURRENTLY HARD CODED ---------
        $res = $functions->getUpcomingForFriends($db, 51);
        // ------------- SET TO SHOW ME ---------------
      ?>
      <!-- On rows -->
      <table class="table table-hover eventTable" style="border: 2px solid black; background: #eee;">
        <thead>
          <tr style="background-color:#F7F7F9;">
            <th>#</th>
            <th>Event</th>
            <th>Location</th>
            <th>Date</th>
            <th>Description </th>
          </tr>
        </thead>
        <tbody class = "tableContents">
          <?php
          foreach ($res as $key => $value) :
          ?>
          <tr event="<?php echo $value['actionid']; ?>" <?php echo "id=\"row" . ($key+1) . "\"";
            if (($key+1)%2==0) { echo "style=\"background-color:#F7F7F9;\""; }?>>
            <!--  <?php $rat = $functions->averageRating($db, $value['memberid']); ?> -->
             <td><?php echo $key+1; ?></td>
             <td><?php echo $value['eventname']; ?></td>
             <td><?php echo $value['location']; ?></td>
             <td><?php echo $value['startdate']; ?></td>
             <td><?php echo $value['description']; ?></td>
          </tr>
          <?php
          endforeach;
          ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
