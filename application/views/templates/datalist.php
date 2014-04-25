<?php if (isset($listaCDEs) && !empty($listaCDEs)):  ?>

			<form class="navbar-form " id="listaCDEform" role="search">
		      <div class="">
		      <div class="form-group">
		      	<div class="input-group">
			        <input list="cdes" id="listaCDE" class="form-control" placeholder="Buscar Centros de experiencia">

			        <span class="input-group-btn">
			        	<a class="btn btn-primary" id="listaCDEbutton" href="#" role="button"><i class="fa fa-search fa-lg"></i> <span style="color: rgba(111, 111, 111, 0)">.</span></a>
				    </span>
				</div>

				
				<datalist id="cdes">
					<?php foreach ($listaCDEs as $key => $value): ?>
						<?php
							//echo $value['regional'];
							//$cde = str_replace(" /12", "", $value['cde']); 
							$cde = substr($value['cde'], 4);
							$cde = str_replace("TIGO ", "", $cde); 

						?>

						<option class="well-white fontSize1" value="<?php echo $cde; ?>">
				  	<?php endforeach; ?>
				</datalist>
		      </div>
		      </div>

		    </form>

<?php endif; ?>



