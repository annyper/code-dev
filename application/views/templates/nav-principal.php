<?php if (isset($nav) && isset($oficina)): ?>

	<ul class="nav navbar-nav">
		<li class="<?php if ($nav == 'gtr') { echo 'active';}?>"><a href="<?php echo site_url('test/cde/' . $oficina); ?>">GTR CDEs </a></li>
    	<li class="<?php if ($nav == 'analytics') { echo 'active';}?>"><a href="<?php echo site_url('analytics/index/' . $oficina); ?>">Analytics </a></li>     			
	</ul>

<?php endif ?>
