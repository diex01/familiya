<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
?>
<div class="contentpane">
	<div><h4>Some interesting informations</h4></div>
	Home
	<?php 
	if(is_object($this->menu)){// if component is rendered through menu
		var_dump($this->params); 	
	}
	?>
</div>
