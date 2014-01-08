<!DOCTYPE html>
<html lang="es">
	<head>
		<title><?php echo $title ?> - GTR Project</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<link rel="stylesheet" href="<?php  echo base_url("bootstrap/css/bootstrap.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("font-awesome/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/lasd.css"); ?>">
        
        <link rel="stylesheet" href="<?php echo base_url("jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.min.css"); ?>">
        <script src="<?php  echo base_url("bootstrap/js/jquery.js"); ?>"></script>
        <script src="<?php  echo base_url("jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"); ?>"></script>
		<style type="text/css">
        	body {
            background: rgba(189, 221, 235, 0.2);

          }
        </style>
	</head>


<body data-spy="scroll" data-target="#nav-ejemplo" data-offset="100">
	<nav class="navbar navbar-default navbar-default-azul" role="navigation">

		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Unity Tigo</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php $this->load->view('templates/nav-principal'); ?>

			<ul class="nav navbar-nav navbar-right">
		      <li>
		      <?php if (isset($ip_info)): ?>
		      	<?php $ip_digiturno = str_replace("\SQLEXPRESS", "", $ip_info['SER_SDSTRSERVIDOR']); ?>
		      	<a href="<?php echo "http://" . $ip_digiturno . ":8888"; ?>" class="navbar-link" target="_blank">
		      		<i class="fa fa-link fa-lg"></i> Ip: <?php echo $ip_digiturno; ?>
		      	</a>
		      <?php endif ?>
		      </li>
		      
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="#">Action</a></li>
		          <li><a href="#">Another action</a></li>
		          <li><a href="#">Something else here</a></li>
		          <li class="divider"></li>
		          <li><a href="#">Separated link</a></li>
		        </ul>
		      </li>
		    </ul>

		  </div><!-- /.navbar-collapse -->
		
	</nav>

