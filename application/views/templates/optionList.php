<?php
if(isset($todo) and $todo){
?>
<option value="0">Todo...</option>
<?php 
}
if(isset($list) and is_array($list) ){
	foreach ($list as $key => $option){
		?>
		<option value = "<?php echo $option['value'];?>"> <?php echo $option['name']; ?></option>
		<?php		  
	}
}

?>