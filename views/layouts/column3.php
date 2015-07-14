<?php /* @var $this Controller */ 
$uri = Yii::app()->request->requestUri;
$string= trim($uri, "/");
$parts = explode("/", $string);
$parts = array_pop($parts);
// echo  array_pop($parts);

?>
<?php
switch(strtolower($parts)) {
	case 'validationdemo':
 		$this->beginContent('//product2/validationdemo'); 
 		break;
 	case 'index':
 		$this->beginContent('//product2/main');
 		break;
 	default:
 		$this->beginContent('//product2/main'); 
}

?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>
