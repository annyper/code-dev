<!DOCTYPE html>
<html lang="es">
	<head>
		<title>COC - <?php echo $title ?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="<?php echo base_url("bootstrap/img/icon.png"); ?>">
 		<link rel="stylesheet" href="<?php echo base_url("bootstrap/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("font-awesome/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/lasd.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("bootstrap/css/templates.css"); ?>">

        <link rel="stylesheet" href="http://eonasdan.github.io/bootstrap-datetimepicker/content/bootstrap-datetimepicker.css">
        <link rel="stylesheet" href="<?php echo base_url("jquery-ui-1.10.3.custom/css/smoothness/jquery-ui-1.10.3.custom.min.css"); ?>">
        
        <!--<script src="<?php  echo base_url("bootstrap/js/jquery-2.1.0.min.js"); ?>"></script>-->
		<style type="text/css">
        	body {
            /*background: rgba(189, 221, 235, 0.2);*/
			background: url("<?php echo base_url('bootstrap/img/tigoLogin9.png'); ?>") 
          no-repeat bottom center fixed rgba(189, 221, 235, 0.2);
          }
        </style>

        <script src="<?php  echo base_url("bootstrap/js/jquery-2.1.0.min.js"); ?>"></script>
		<script src="<?php echo base_url("bootstrap/js/general.js"); ?>"></script>
	</head>


<body data-spy="scroll" data-target="#sidebar-wrapper" data-offset="100">
	<nav class="navbar navbar-default navbar-default-azul" role="navigation">

		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand tooltipShow" href="#" data-toggle="tooltip" data-placement="bottom" title="Ahora somos 1">Une-Tigo</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php $this->load->view('templates/nav-principal'); ?>

			<ul class="nav navbar-nav">
				<?php if (isset($oficina)): ?>
					<li class="<?php if ($nav == 'analytics') { echo 'active';}?>"><a href="<?php echo site_url('analytics/index/' . $oficina); ?>">Analytics </a></li> 
				<?php endif ?>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($oficina)): ?>
					<li>
						<a href="<?php echo site_url('gtr/cde/' . $oficina); ?>"><strong>CDE: </strong> <?php echo str_replace("-", " ", $oficina); ?></a>
					</li>
				<?php endif ?>
		      <li>
		      <?php if (isset($ip_info) && !empty($ip_info)): ?>
		      	<?php $ip_digiturno = str_replace("\SQLEXPRESS", "", $ip_info['SER_SDSTRSERVIDOR']); ?>
		      	<a href="<?php echo "http://" . $ip_digiturno . ":8888"; ?>" class="navbar-link" target="_blank">
		      		<i class="fa fa-link fa-lg"></i> Ip: <?php echo $ip_digiturno; ?>
		      	</a>
		      <?php endif ?>
		      </li>
		      
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dashboard <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          <li><a href="<?php echo site_url('gtr'); ?>">GTR</a></li>
		          <li><a href="<?php echo site_url('reporte'); ?>">REPORTE KPI</a></li>
		          <li class="divider"></li>
		          <li><a href="#">MONITOREOS</a></li>
		        </ul>
		      </li>
		    </ul>

		  </div><!-- /.navbar-collapse -->
		
	</nav>
