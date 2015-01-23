<?php
#require("libs/config.php");
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
    <div class="allContainer" style="width:1300px;">
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

        <div class="ui accordion pull-left">
          <div class="title">
            <i class="dropdown icon"></i>
            Reviews
          </div>
          <div class="content">
            <div class="list-group">
              <a href="#" class="list-group-item">
                View your ratings
              </a>
              <a href="#" class="list-group-item">Add ratings to an event</a>
            </div>

          </div>
          <div class="title">
            <i class="dropdown icon"></i>
            Level 2
          </div>
          <div class="content">
            <p></p>
          </div> <!--end container-->
      </div><!--end accordion-->
    </div><!--end side container-->



        <div class="jumbotron pull-left">
          <h3 id="jumboHeader" style= "margin-bottom: 10%;">Hello, username!</h3>
          <p style="text-align: center;">Upcoming Events</p>

          <?php
          $res = $functions->mostRecent($db, 5);
          $remainingRows = 5;
          ?>

          <!-- On rows -->
          <table class="table table-hover eventTable">
            <thead>
              <tr style="background-color:#F7F7F9;">
                <th>#</th>
                <th>Event Name</th>
                <th>Event Location</th>
                <th>Event Date</th>
              </tr>
            </thead>
            <tbody class = "tableContents">
              <?php
              foreach ($res as $key => $value) :
                ?>
              <tr event="<?php echo $value['actionid']; ?>" <?php echo "id=\"row" . ($key+1) . "\"";
              if (($key+1)%2==0) { echo "style=\"background-color:#F7F7F9;\""; }?>>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value['eventname']; ?></td>
                <td><?php echo $value['location']; ?></td>
                <td><?php echo $value['startdate']; ?></td>
              </tr>

              <?php
              $remainingRows--;
              endforeach;

              for($i=1; $i<=$remainingRows; $i++):
                ?>

                <tr id="row<?php echo (5-$remainingRows+$i); ?>" style='text-align:center;'>
                  <td><?php echo $i+1 ?></td>
                  <td>--</td>
                  <td>--</td>
                  <td>--</td>
                </tr>

              <?php
              endfor;
              ?>
              
            </tbody>
          </table>
        </div><!--end jumbotro-->


        <div class="eventInfo pull-left" style="padding-top:50px; display: none; width:450px; height: 400px;">
          <p id="eventTitle" style = "font-size: 19px; font-weight: 220; text-align: center;">Event Details<p>
            <p class = "eventBody">
              Event Start Date: <span id="startDate"></span>
            </p>
            <p class = "eventBody">
              Event Join Date: <span id="joinDate"></span>
            </p>
            <p class = "eventBody">
              <i>Event Description: <span id="description"></span>
              </i>
            </p>
            <p class = "eventBody">
              Minimum members required: <span id="minMembers"></span>
            </p>
          </div>

      </div><!--end allcontainer-->

      <div class="clearfix"></div>

          <!-- On cells (`td` or `th`) -->
        <div class="recReviews jumbotron" style="margin-left:200px; padding-top:0;">
          <p style="text-align: center; margin-top:60px">Your Recent Reviews</p>
            <table class="table table-hover">
              <tbody class="tableContents" id="reviewTable" style="text-align:center";>
                <tr id="Rrow1">
                  <td>Friend 1</td>
                  <td>
                    <div class="ui medium star rating">
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                    </div>
                  </td>
                </tr>

                <tr id="Rrow2" style="background-color:#F7F7F9;">
                  <td>Friend 2</td>
                  <td> 
                    <div class="ui medium star rating">
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                    </div>
                  </td>
                </tr>
                <tr id="Rrow3" >
                  <td>Friend3</td>
                  <td> 
                    <div class="ui medium star rating">
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                    </div>
                  </td>
                </tr>
                <tr id="Rrow4" style="background-color:#F7F7F9;">
                  <td>Friend4</td>
                  <td> 
                    <div class="ui medium star rating">
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                    </div>
                  </td>
                </tr>
                <tr id="Rrow5" >
                  <td>Friend5</td>
                  <td> 
                    <div class="ui medium star rating">
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon active"></i>
                    <i class="icon"></i>
                    <i class="icon"></i>
                    </div>
                  </td>
                </tr>

              </tbody>
            </table>
        </div> 





          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <!-- Include all compiled plugins (below), or include individual files as needed -->  
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="content/javascript/semantic.min.js"></script>
  <link rel="stylesheet" href="jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css" />

  <script>
  $(".ui.dropdown").dropdown();
  $('.ui.accordion').accordion();
  </script>

  <script>
  $(document).ready(function() {
//     $('#row1')
//   .popup({
//     on: 'click',
//     content: '#row1'.text(),
//     position: 'right center',
//     target:'tr'
//   });
// });
  $( ".eventTable tr" ).click(function() {
  //$( ".eventInfo" ).fadeOut(300);
  //$( ".eventInfo" ).fadeIn( 300);

    var actionID = $(this).attr('event');
    displayEvent(actionID);

    for(var i=1; i<=5; i++) {
      if(i % 2 == 0) {
        document.getElementById('row'+i).style.background = "#F7F7F9";
      } 
      else {
        document.getElementById('row'+i).style.background = "#FFFFFF";
        }
    }

    
    var row = $(this).attr('id');
    var name = $('#' + row + ' td:nth-child(2)').text();
    var text1 = $('#' + row).text();
    document.getElementById(row).style.background = "#1E90FF";
    $( ".eventInfo" ).delay(250).show("slide", { direction: "right" }, 1000);
    $('#eventTitle').text(name);
    //$('#eventBody').text(text1);
  
  

      });
  });
  </script>
  <script>
    //$(document).ready(function() {
      //$(".recReviews tr").click(function() {
        //var name = $(this).attr('id');
        //document.write(name);
        $('.recReviews tr')
        .popup({
        position : 'right center',
        target   : $(this).attr('id'),
        title    : '<a href="events.php">Friend\'s Name</a><img width="80" height="80" style = "margin-left:130px;" src="images/thumbnail.jpg">',
        content  : 'I chose to review you really low because you are a sorry excuse for a planner',
        on: 'click',
        });
      //});
    //});
  </script>

</html>
