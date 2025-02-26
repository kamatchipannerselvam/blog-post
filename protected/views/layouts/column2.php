<?php $this->beginContent('//layouts/main'); ?>
<div class="container overflow-hidden text-center">
  <div class="row gx-5">
    <div class="col">
     <div class="card p-3 pb-5">
	 <?php if(isset($this->breadcrumbs)):?>
		<div class="d-flex">
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		</div>
		<?php endif?>
		<?php echo $content; ?>
	 </div>
    </div>
  </div>
</div>
<?php $this->endContent(); ?>
<div>
</div>
