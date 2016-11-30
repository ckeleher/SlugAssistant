<?php
session_start();
if(!isset($_SESSION['google_data'])):header("Location:index.php");endif;
?>
<?php
if(!empty($_POST['submitted']))
{//if submitted, then validate

  $name = trim($_POST['name']);

  $address = trim($_POST['address']);

  $time = trim($_POST['time']);
  
  $error = false;
  
  if(empty($name))
  {
    $name_error='Class name is empty. Please enter your class name.';
    $error=true;
  }

  if(empty($address))
  {
    $address_error='Location name is empty. Please enter location name.';
    $error=true;
  }
  
  if(empty($_POST['time']))
  {
    $time_error ="Please select a time from the list";
    $error=true;
  }
  else
  {
    $time = $_POST['time'];
  }
  
  if(count($_POST['Dates']) != 1)
  {
    $dates_error = "Please select one date slot";
    $error=true;
  }

  $dates = $_POST['Dates'];
  
  if(empty($_POST['agree']))
  {
    $terms_error = "If you agree to the terms, please check the box below";
    $error=true;
  }
  else
  {
    $agree = $_POST['agree'];
  }
  
  if(false === $error)
  {  
     /*
     $event = new Google_Event();
     $event->setSummary('Appointment');
     $event->setLocation('Somewhere');
     $start = new Google_EventDataTime();
     $start->setDateTime('2016-11-20T10:00:00.000-07:00');
     $event->setStart($start);
     $end = new Google_EventDateTime();
     $end->setDateTime('2016-11-20T10:25:00.000-07:00');
     $event->setEnd($end);
     $event->attendees = $attendees;
     $createdEvent = $service->events->insert('primary', $event);
     echo $createdEvent->getId();
     */
     
     // trying to insert EVENT
     $event     = new Google_Service_Calendar_Event();
     $event->setSummary($Summary);
     $event->setLocation($Location);
     $start     = new Google_Service_Calendar_EventDateTime();
     $datatimeI = geratime(DataIT2DB($DateStart), $TimeStart);

     $start->setDateTime($datatimeI);
     $event->setStart($start);
     $end       = new Google_Service_Calendar_EventDateTime();
     $datatimeF = geratime(DataIT2DB($DateEnd), $TimeEnd);

     $end->setDateTime($datatimeF);
     $event->setEnd($end);
     $attendee1 = new Google_Service_Calendar_EventAttendee();
     //$attendee1->setEmail('web@ideart.it');
     $attendees = array($attendee1);
     $event->attendees = $attendees;
     $createdEvent = $service->events->insert('primary', $event);
     $_SESSION['eventID'] = $createdEvent->getId(); 
  }
}

?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <title>Slug Assistant</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>
  <body>
    <nav class="ucsc-blue" role="navigation">
      <div class="nav-wrapper container"><a id="logo-container" href="account.php" class="brand-logo">Slug Assistant</a>
        <ul class="right hide-on-med-and-down">
              <?php
                echo '<li><a href="logout.php?logout" id="download-button" class="btn waves-effect waves-light ucsc-gold">Logout</a></a></li>';
              ?>
            
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a href="login.html">Log In</a></li>
          <li><a href="#">About Us</a></li>
	      <li><a href="searchPretty.php">Search Faculty</a></li>
	      <li><a href="account.php">Calendar</a></li>
	      <li><a href="finals.php">Finals Schedule</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
      </div>
    </nav>
    <br>
    <div class = container>
      <div class="wrapper">
      <div>
        <?php 
          echo '<iframe src="https://calendar.google.com/calendar/embed?src='.$_SESSION['google_data']['email'].'" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>'
        ?>
       </div>
       <div>
       </div>
       <div id="wrap">
        <form method="post" action='?' id="cakeform" >
              <fieldset>
                <div class="inpupt-field col s12">
                  <span class='error'><?php echo $time_error?></span>
                  <select id="time" name='time'>
                    <option value="" disabled="disabled" selected="selected">Select a time</option>
                    <option <?php echo $time=='1'?'selected':''; ?> >8:00–9:05</option><!-- MWF START -->
                    <option <?php echo $time=='2'?'selected':''; ?> >9:20-10:25</option>
                    <option <?php echo $time=='3'?'selected':''; ?> >10:40–11:45</option>
                    <option <?php echo $time=='4'?'selected':''; ?> >12:00–1:05</option>
                    <option <?php echo $time=='5'?'selected':''; ?> >1:20–2:25</option>
                    <option <?php echo $time=='6'?'selected':''; ?> >2:40–3:45</option>
                    <option <?php echo $time=='7'?'selected':''; ?> >4:00–5:05</option>
                    <option <?php echo $time=='8'?'selected':''; ?> >5:20–6:55</option> <!-- MWF END -->
                    <option <?php echo $time=='9'?'selected':''; ?> >8:00–9:35</option> <!-- MW START -->
                    <option <?php echo $time=='10'?'selected':''; ?> >7:10–8:45</option> <!-- MW END -->
                    <option <?php echo $time=='11'?'selected':''; ?> >8:00–9:35</option> <!-- TTH START -->
                    <option <?php echo $time=='12'?'selected':''; ?> >9:50–11:25</option>
                    <option <?php echo $time=='13'?'selected':''; ?> >11:40–1:15</option>
                    <option <?php echo $time=='14'?'selected':''; ?> >1:30–3:05</option>
                    <option <?php echo $time=='15'?'selected':''; ?> >3:20–4:55</option>
                    <option <?php echo $time=='16'?'selected':''; ?> >5:20–6:55</option>
                    <option <?php echo $time=='17'?'selected':''; ?> >7:10–8:45</option> <!-- TTH END -->
                  </select>
                  <label for="time">Select time:</label >
                </div>
                <div>
                  <label >Dates:</label>
                    <span class='error'><?php echo $dates_error ?></span>
                      <p>
                        <input type="checkbox" id="test1" value="M-W-F" name='Dates[]' 
                        <?php echo (in_array('M-W-F',$dates)) ?'checked':'' ?> />
                        <label for="test1">M-W-F</label>
                      </p>
                      <p>
                        <input type="checkbox" id="test2" value="T-TH" name='Dates[]' 
                        <?php echo (in_array('T-TH',$dates)) ?'checked':'' ?> />
                        <label for="test2">T-TH</label>
                      </p>
                      <p>
                        <input type="checkbox" id="test3" value="M-W" name='Dates[]' 
                        <?php echo (in_array('M-W',$dates)) ?'checked':'' ?> />
                        <label for="test3">M-W</label>
                      </p>
                </div>
                <div>
                  <label for='name'>Class Name</label>
                  <input type="text" id="name" name='name' value='<?php echo htmlentities($name) ?>' />
                  <span class='error'><?php echo $name_error ?></span>
                  <br/>
                  <label for='address'>Location</label>
                    <input type="text" id="address" name='address' value='<?php echo htmlentities($address) ?>' />
                    <span class='error'><?php echo $address_error ?></span>
                </div>
              </fieldset>
            </div>
            <div class="col 13 s12">
            <p>
              <button class="btn waves-effect waves-light ucsc-blue" type='submit' name='submitted' value='Submit'>Submit<i class="material-icons right">send</i></button>
            </p>
            <p>
              <a href="searchPretty.php" id="download-button" class="btn waves-effect waves-light ucsc-gold">Search Faculty</a>
            </p>
            <p>
              <a href="finals.php" id="download-button" class="btn waves-effect waves-light ucsc-blue">Finals</a>
            </p>
          </div>
        </form>
    </div>
      </div>
    </div>
    <footer class="page-footer ucsc-gold">
      <div class="container">
        <div class="row">
          <div class="col l6 s12">
            <h5 class="white-text">Team Slug Tech</h5>
            <p class="grey-text text-lighten-4">We are a team of four UC Santa Cruz students working to create a superior scheduling solution for students.</p>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Github and About pages??</h5>
            <ul>
              <li><a class="white-text" href="#!">Links to fill out later</a></li>
              <li><a class="white-text" href="#!">Link 2</a></li>
              <li><a class="white-text" href="#!">Link 3</a></li>
              <li><a class="white-text" href="#!">Link 4</a></li>
            </ul>
          </div>
          <div class="col l3 s12">
            <h5 class="white-text">Maybe Personal Bio's or something</h5>
            <ul>
              <li><a class="white-text" href="#!">RJ</a></li>
              <li><a class="white-text" href="#!">Clayton</a></li>
              <li><a class="white-text" href="#!">Bryan</a></li>
              <li><a class="white-text" href="#!">Michael</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/slugtech2.js"></script>
    <!-- Attempting to create an event -->
    </body>
  </html>
