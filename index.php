<?php

//To Handle Session Variables on This Page
session_start();


//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal By Tejas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo logo-bg">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Job</b> Portal By Tejas</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="jobs.php">Jobs</a>
          </li>
          <li>
            <a href="#candidates">Candidates</a>
          </li>
          <li>
            <a href="#company">Company</a>
          </li>
          <li>
            <a href="#about">About Us</a>
          </li>
          <?php if(empty($_SESSION['id_user']) && empty($_SESSION['id_company'])) { ?>
          <li>
            <a href="login.php">Login</a>
          </li>
          <li>
            <a href="sign-up.php">Sign Up</a>
          </li>  
          <?php } else { 

            if(isset($_SESSION['id_user'])) { 
          ?>        
          <li>
            <a href="user/index.php">Dashboard</a>
          </li>
          <?php
          } else if(isset($_SESSION['id_company'])) { 
          ?>        
          <li>
            <a href="company/index.php">Dashboard</a>
          </li>
          <?php } ?>
          <li>
            <a href="logout.php">Logout</a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header bg-main">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center index-head">
            <h1>All <strong>JOBS</strong> In One Place</h1>
            <p>One search, global reach</p>
            <p><a class="btn btn-success btn-lg" href="jobs.php" role="button">Search Jobs</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-bottom-20">
            <h1 class="text-center">Latest Jobs</h1>            
            <?php 
          /* Show any 4 random job post
           * 
           * Store sql query result in $result variable and loop through it if we have any rows
           * returned from database. $result->num_rows will return total number of rows returned from database.
          */
          $sql = "SELECT * FROM job_post Order By Rand() Limit 4";
          $result = $conn->query($sql);
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
              $sql1 = "SELECT * FROM company WHERE id_company='$row[id_company]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>
            <div class="attachment-block clearfix">
              <img class="attachment-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQf4ZwozTRxpHqQric8RamA31iudonpSssQIA&s" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>/Month</span></h4>
                <div class="attachment-text">
                    <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
                </div>
              </div>
            </div>
          <?php
              }
            }
            }
          }
          ?>

          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Candidates</h1>
            <p>Finding a job just got easier. Create a profile and apply with single mouse click.</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="https://img.freepik.com/free-vector/woman-hold-magnifier-various-occupation-avatar_81522-2180.jpg?t=st=1723716688~exp=1723720288~hmac=deef99bece50e2ddd613cddf3118b36b2251a8752bb395775b52da89904ddd11&w=740" alt="Browse Jobs">
              <div class="caption">
                <h3 class="text-center">Browse Jobs</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="data:image/jpeg;base64,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" alt="Apply & Get Interviewed">
              <div class="caption">
                <h3 class="text-center">Apply & Get Interviewed</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail candidate-img">
              <img src="data:image/jpeg;base64,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" alt="Start A Career">
              <div class="caption">
                <h3 class="text-center">Start A Career</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="company" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Companies</h1>
            <p>Hiring? Register your company for free, browse our talented pool, post and track job applications</p>            
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="data:image/jpeg;base64,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" alt="Browse Jobs">
              <div class="caption">
                <h3 class="text-center">Post A Job</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="img/manage.jpg" alt="Apply & Get Interviewed">
              <div class="caption">
                <h3 class="text-center">Manage & Track</h3>
              </div>
            </div>
          </div>
          <div class="col-sm-4 col-md-4">
            <div class="thumbnail company-img">
              <img src="img/hire.png" alt="Start A Career">
              <div class="caption">
                <h3 class="text-center">Hire</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="statistics" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>Our Statistics</h1>
          </div>
        </div>
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM job_post";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Job Offers</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
                  <?php
                      $sql = "SELECT * FROM company WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Registered Company</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
             <?php
                      $sql = "SELECT * FROM users WHERE resume!=''";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>CV'S/Resume</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-list"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
               <?php
                      $sql = "SELECT * FROM users WHERE active='1'";
                      $result = $conn->query($sql);
                      if($result->num_rows > 0) {
                        $totalno = $result->num_rows;
                      } else {
                        $totalno = 0;
                      }
                    ?>
              <h3><?php echo $totalno; ?></h3>

              <p>Daily Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
    </section>

    <section id="about" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center latest-job margin-bottom-20">
            <h1>About US</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="https://img.freepik.com/free-vector/woman-hold-magnifier-various-occupation-avatar_81522-2180.jpg?t=st=1723716688~exp=1723720288~hmac=deef99bece50e2ddd613cddf3118b36b2251a8752bb395775b52da89904ddd11&w=740" class="img-responsive" style="width: 100%; height: auto;">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <h2> Welcome to Job Portal By Tejas! </h2>
            <p>
            At Job Portal By Tejas, our mission is to revolutionize the way employers and job seekers connect. Founded with a vision to streamline the job search process, we are committed to providing a user-friendly platform that bridges the gap between talented professionals and top employers.
            </p>
            <p>
              <h2> Who We Are </h2>
            We are a dedicated team of professionals with a passion for creating innovative solutions in the recruitment space. Our diverse backgrounds in technology, human resources, and business development drive our commitment to building a platform that meets the needs of both job seekers and employers.
            </p>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2024-2025 Job Portal.</strong> All rights
    reserved.
    </div>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
