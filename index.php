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
    <div class="section no-pad-bot" id="index-banner">
      <div class="container">
        <br><br>
        <h1 class="header center ucsc-gold-text">Slug Assistant</h1>
        <div class="row center">
          <h5 class="header col s12 light">A Tool for Students to Create and Customise their Schedule</h5>
        </div>
        <div class="row center">
            <?php
              include_once("config.php");
              include_once("includes/functions.php");

              //print_r($_GET);die;

              if(isset($_REQUEST['code'])){
                $gClient->authenticate();
                $_SESSION['token'] = $gClient->getAccessToken();
                header('Location: ' . filter_var($redirectUrl, FILTER_SANITIZE_URL));
              }

              if (isset($_SESSION['token'])) {
                $gClient->setAccessToken($_SESSION['token']);
              }

              if ($gClient->getAccessToken()) {
                $userProfile = $google_oauthV2->userinfo->get();
                //DB Insert
                $gUser = new Users();
                $gUser->checkUser('google',$userProfile['id'],$userProfile['given_name'],$userProfile['family_name'],$userProfile['email'],$userProfile['gender'],$userProfile['locale'],$userProfile['link'],$userProfile['picture']);
                $_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
                header("location: account.php");
                $_SESSION['token'] = $gClient->getAccessToken();
              } else {
                $authUrl = $gClient->createAuthUrl();
              }

              if(isset($authUrl)) {
                echo '<a href="'.$authUrl.'"><img src="images/google.png" alt=""/></a>';
              } else {
                echo '<a href="logout.php?logout">Logout</a>';
              }

              ?>
        </div>
        <br><br>

      </div>
    </div>


    <div class="container">
      <div class="section">

        <!--   Icon Section   -->
        <div class="row">
          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center ucsc-blue-text"><i class="material-icons">face</i></h2>
              <h5 class="center">Students working for Students</h5>

              <p class="light">We want to create the most plesureable and easy experience available to students so they can schedule their busy lives. Your time at school should be focused on you, not worrying about your schedule.</p>
            </div>
          </div>
          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center ucsc-blue-text"><i class="material-icons">mail_outline</i></h2>
              <h5 class="center">Email Notifications</h5>

              <p class="light">We aim to not only give you a tool to create a schedule for yourself, but send you notifications for when you should be at a specific location.</p>
            </div>
          </div>

          <div class="col s12 m4">
            <div class="icon-block">
              <h2 class="center ucsc-blue-text"><i class="material-icons">insert_emoticon</i></h2>
              <h5 class="center">Love your new robot overlords</h5>

              <p class="light">The robots are coming. Run.</p>
            </div>
          </div>
        </div>

      </div>
      <br><br>

      <div class="section">

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
      <!-- <div class="footer-copyright">
        <div class="container">
        Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
      </div> -->
    </footer>


    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    </body>
  </html>
