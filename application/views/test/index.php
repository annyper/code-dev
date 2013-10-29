 

    <?php echo $this->benchmark->elapsed_time();?>seg
    
    <?php echo $this->benchmark->memory_usage();?>
<br>
   <?php echo $this->benchmark->elapsed_time('perro', 'gato');?>