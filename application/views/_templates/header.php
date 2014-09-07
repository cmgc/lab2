<!DOCTYPE html>
<html lang="en">
<head>
   <!--  <meta charset="utf-8"> -->
   <meta charset="windows-1251">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ДКР+лаб1,2,3,4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="<?php echo URL; ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/starter-template.css" rel="stylesheet">
    <!-- jQuery -->
   <!-- <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> -->
    <!-- our js -->
    <script src="<?php echo URL; ?>pulic/js/application.js"></script>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand active" href="<?php echo URL; ?>">Home</a>
        </div>
        <!--<div class="collapse navbar-collapse"> -->
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo URL . 'dashboard'; ?>">Dashboard</a></li>
            <li><a class="navbar-right" href="<?php echo URL . 'about'; ?>">About</a></li>
            
          </ul>
          
          <?php if (Session::get('user_logged_in')) { ?>
          <a class="navbar-right" href="<?php echo URL . 'login/logout'; ?>"><button type="button" class="btn btn-danger">Logout</button></a>
          
            <?php } else {?>
			 <form action="<?php echo URL; ?>login/register" class="navbar-form navbar-right">
			 <input type="hidden">
             <button type="submit" class="btn btn-primary"> New
             </button>
			 </form>
			 
            	<form class="navbar-form navbar-right" role="form" action="<?php echo URL; ?>login/login" method="post">
          <div class="form-group">
              <input type="text" name="user_name" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="user_password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            	</form>
            <?php } ?>
        </div><!--/.nav-collapse -->
      </div>
    </div>