<?php
session_start();
if(!isset($_SESSION['google_data'])):header("Location:index.php");endif;

mysql_connect("localhost", "sluguser", "slugpass") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("slugdatabase") or die(mysql_error());
    /* tutorial_search is the name of database we've created */
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
    <div class = container>
      <div class="row">
        <form class="col s12">
          <div class="row">
		  <form action="search.php" method="GET">
            <div class="input-field col s6">
              <i class="material-icons prefix">face</i>
              <input id="icon_prefix" type="text" name="first" class="validate">
              <label for="icon_prefix">First Name</label>
			  <a href="account.php" id="download-button" class="btn waves-effect waves-light ucsc-gold">Calendar</a>
            </div>
            <div class="input-field col s6">
              <i class="material-icons prefix">work</i>
              <input id="icon_telephone" type="tel" name="last" class="validate">
              <label for="icon_telephone">Last Name</label>
			  <!--<input type="submit" value="Search" />-->
			  <button class="btn waves-effect waves-light ucsc-blue" type='submit' value='Search'>Search<i class="material-icons right">send</i></button>
            </div>
			</form>
          </div>
        </form>
      </div>
    </div>
	<?php
  $last = $_GET['last']; 
	$first = $_GET['first'];
    // gets value sent over search form
     
    $min_length = 1;
    // you can set minimum length of the last if you want
     
    if(strlen($last) >= $min_length || strlen($first) >= $min_length){ // if last length is more or equal minimum length then
        
		$first = htmlspecialchars($first);
        $last = htmlspecialchars($last); 
        // changes characters used in html to their equivalents, for example: < to &gt;
        $first = mysql_real_escape_string($first); 
        $last = mysql_real_escape_string($last);
        // makes sure nobody uses SQL injection
		if(strlen($last) >= $min_length && strlen($first) >= $min_length){
			$raw_results = mysql_query("SELECT * FROM faculty
            WHERE (`First Name` LIKE '%".$first."%') OR (`Last Name` LIKE '%".$last."%')") or die(mysql_error());
		}
		else if(strlen($first) >= $min_length){
			$raw_results = mysql_query("SELECT * FROM faculty
            WHERE (`First Name` LIKE '%".$first."%')") or die(mysql_error());
		}
		else{
			$raw_results = mysql_query("SELECT * FROM faculty
            WHERE (`Last Name` LIKE '%".$last."%')") or die(mysql_error());
		}
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$last%' is what we're looking for, % means anything, for example if $last is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$last'
        // or if you want to match just full word so "gogohello" is out use '% $last %' ...OR ... '$last %' ... OR ... '% $last'
        echo "<table border='1' class='bordered' align='center' style='max-width:1100px;'>
		<thread>
		<tr>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Division</th>
		<th>Location</th>
		<th>Room/Time</th>
		
		</tr>
		</thread>";
        if(mysql_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            
            while($results = mysql_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
				
                echo "<tr>";
				echo "<td>" . $results['First Name'] . "</td>";
				echo "<td>" . $results['Last Name'] . "</td>";
				echo "<td>" . $results['Phone'] . "</td>";
				echo "<td>" . $results['Campus E-Mail'] . "</td>";
				echo "<td>" . $results['Division'] . "</td>";
				echo "<td>" . $results['Office Location'] . "</td>";
				echo "<td>" . $results['Room/Time'] . "</td>";
				echo "</tr>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
        }
        else{ // if there is no matching rows do following
            echo "No results";
        }
         
    }
    else{ // if last length is less than minimum
    }
	?>
      
      
      
     
      
      
      
      
      
      
      
    


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    </body>
	
  </html>
  
  
  
