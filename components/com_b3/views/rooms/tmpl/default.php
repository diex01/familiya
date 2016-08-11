<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
$data = $this->data;
$link = JRoute::_( "index.php?option=com_b3&view=rooms&id={$data->id}" );
?>
<div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ID' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->id; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'NUBMER' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->nubmer; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ROOMS_COUNT' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->rooms_count; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'BEDROOMS_COUNT' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->bedrooms_count; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'LEVEL' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->level; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'VIEW' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->view; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'ARTICLE' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->article; ?></span>
	</div>
	<div class="jcb_fieldDiv">
		<span class="jcb_fieldLabel"><?php echo JText::_( 'PUBLISHED' ); ?></span>
		<span class="jcb_fieldValue"><?php echo $data->published; ?></span>
	</div>

</div>
