<?php
  // ------------- BEGIN OF CUSTOMIZABLE INFO ------------------
  // email of the person receiving the contact form (your email)
  $to = 'parkerobx@gmail.com';
  // your site url (for info in the email)
  $site_url = 'https://tile-guy-usa.herokuapp.com/contact.php';
  $form_email_label = "Your email:";
  $form_message_label = "Your message:";
  $form_submit_label = "Send";
  $attack_detected = "Sending information to administrator";
  $missing_from =    "Please provide an email address";
  $invalid_from =    "Please provide a valid email address - like something@something.com";
  $missing_message = "Please insert some text in the message";
  $could_not_send =  "There was a problem while sending the email. Please try again a bit later.";
  // ------------- END OF CUSTOMIZABLE INFO ------------------
  $from_errors = array();
  $message_errors = array();
  $sending_error = array();
  function cleanEmail($email) {
    return trim(strip_tags($email));
  }
  function validEmail($email) {
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    return preg_match($pattern, cleanEmail($email));
  }
  function verifyFrom($from){
    if(empty($from))       { array_push($from_errors, $missing_from); }
    if(!validEmail($from)) { array_push($from_errors, $invalid_from); }
    return count($from_errors) == 0;
  }
  function verifyMessage($message) {
    if(empty($message))    { array_push($message_errors, $missing_message); }
    return count($message_errors) == 0;
  }
  if($_POST) {
    $from = $_POST['from'];
    $message = $_POST['message'];
    if (verifyFrom($from) && verifyMessage($message)) {
      $cleanFrom = cleanEmail($from);
      $subject = 'Contact - '. $site_url;
      $headers = "From: " . $cleanFrom . "\r\n";
      $headers .= "Reply-To: ". $cleanFrom . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      if (mail($to, $subject, $message, $headers)) {
        header('Location: thanks.html');
        die();
      } else {
        array_push($sending_errors, $could_not_send);
      }
    }
  }
?>

<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  <fieldset>
    <input type="text" id="email" name="email" />
    <label for="message"><?php echo $form_message_label ?></label>
    <textarea id="message" name="message" rows="5" cols="30"></textarea>
    <input type="submit"><?php echo $form_submit_label ?></input>
 </fieldset>
</form>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="Javascript/bootstrap.min.js"></script>
    <script src="Javascript/home.js"></script>
    

    <title>Tile Guy USA</title>

    <!-- Bootstrap core CSS -->
    <link href="Stylesheets/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="Stylesheets/contact.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top">
        <div class="container navbar-container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.html">Tile Guys USA</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="home.html">Home</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="contact.html">Contact</a></li>
              </li>
            </ul>
          </div>
          <div class="top-social">
            <ul id="top-social-menu">
              <li><a href="https://www.instagram.com/tileguysusa/"><i class="fa fa-instagram"></i></a></li>
              <li><a href="https://www.facebook.com/TileGuysUSA/?ref=br_rs"><i class="fa fa-facebook"></i></a></li>
              <li><a href="mailto:TileGuys@gmail.com">Gary@TileGuy.com</a></li>
              <li><a href="tel:+19105155129">(910)-515-5129</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="topspaces" style="padding-bottom: 30px;"></div>
     <section class="full-width-prettyback">
      <div class="container">
        <div class="row">
          <p class="work">Contact Us!</p>
          <p class="aboutwork">We love to meet new people and talk about projects.  Give us a call today to see how we can help!</p>
        </div>
      </div>
    </section>

    <div class="fluid-container">
      <div class="elementcenter">
        <div class="row">
          <div class="col-sm-6">
            <h3 style="text-align: center;">Contact Us For A Quote</h3>
            <div class="border"></div>
            <form class="form-horizontal" name="contactform" method="post" action="contact.php">
              <div class="label-text">
                <label for="first_name">Name</label><span class="required">*</span>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <input type="text" class="form-control" id="firstname" name="first_name" placeholder="First" required>
                </div>
                <div class="col-xs-6">
                  <input type="text" class="form-control" name="last_name" placeholder="Last" required>
                </div>
              </div>

              <div class="label-text">
                <label for="email">Email</label><span class="required">*</span>
                <div class="textbox-center">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
              </div>

              <div class="label-text">
                <label for="telephone">Phone Number</label>
                <div class="textbox-center">
                  <input type="phone" class="form-control" name="telephone" id="phone" placeholder="Phone Number">
                </div>
              </div>

              <div class="label-text">
                <label for="message">Message</label><span class="required">*</span>
                <div class="textbox-center">
                  <textarea class="form-control" rows="3" name="message" placeholder="Send a Message." required></textarea>
                </div>
              </div>
              <div class="">
                <button type="submit" class="btn btn-success">Send</button>
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <h3 style="text-align: center;">Tile Guys</h3>
            <div class="contactimage"></div>
          </div>
        </div>
      </div>
    </div>

    <section class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52793.909009589224!2d-77.90668114985966!3d34.2072018834287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89a9f5a20debaed5%3A0x5e66493884093032!2sWilmington%2C+NC!5e0!3m2!1sen!2sus!4v1497044928706" width="100%" height="450" fillcolor="0" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>

    <section class="contact-action">
    <div class="inner-action">
      <p>Don't See What You Need? Give Us A Call!<br><a href="tel:+19105155129">(910)-515-5129</a></p>
    </div>
  </section>

  <section class="footer">
    <div class="contact">
        <p class="tilefooter">The Tile Guys USA</p>
        <div class="tileguyline"></div>
        <div class="made-by-me">
          <a href="tel:+19105155129">(910)-515-5129</a>
          <a style="padding-left: 25px;" href="mailto:TileGuys@gmail.com">TileGuys@gmail.com</a>
        </div>
        <div class="social-links">
          <a href="twitter.com"><i class="fa fa-twitter"></i></a>
          <a href="https://www.instagram.com/tileguysusa/"><i class="fa fa-instagram"></i></a>
          <a href="https://www.facebook.com/TileGuysUSA/?ref=br_rs"><i class="fa fa-facebook"></i></a>
          <a href="google.com"><i class="fa fa-google-plus"></i></a>
        </div>
    </div>
  </section>
</body>
</html>