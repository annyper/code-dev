<?php if (isset($nav)): ?>

	<ul class="nav navbar-nav">
		<li class="<?php if ($nav == 'gtr') { echo 'active';}?>"><a href="<?php echo site_url('gtr'); ?>">GTR CDEs </a></li>
		<?php if (isset($oficina)): ?>
			<li class="<?php if ($nav == 'analytics') { echo 'active';}?>"><a href="<?php echo site_url('analytics/index/' . $oficina); ?>">Analytics CDE</a></li> 
		<?php endif ?>
		<li class="<?php if ($nav == 'analytics') { echo 'active';}?>"><a href="<?php echo site_url('analytics'); ?>">Analytics</a></li>
		<li class="<?php if ($nav == 'reportes') { echo 'active';}?>"><a href="<?php echo site_url('app/'); ?>">Reportes</a></li>
		<li class="<?php if ($nav == 'sms') { echo 'active';}?>"><a href="<?php echo site_url('app/#/SMS'); ?>">Directorio SMS</a></li>
		
		<li><a href="http://10.66.6.241:3000/checklist/#/checklist/8deedcd3508f2d84eafb4317e4dfb1ee">Checklist</a></li>
	</ul>


<?php endif ?>
