<hr/>
	<?php
		if(isset($js))
		{
			foreach ($js as $key) 
			{
				echo '<script type="text/javascript" src="'.base_url().'assets/js/'.$key.'.js"></script>';
				echo "\n\t";
			}
		}
	?>
</body>
</html>