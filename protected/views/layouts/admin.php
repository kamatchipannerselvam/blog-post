<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/themes/classic/views/css/styles.css" rel="stylesheet" />
	<script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body class="sb-nav-fixed">
	<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
		<!-- Navbar Brand-->
		<a class="navbar-brand ps-3" href="index.html"><?php echo CHtml::encode(Yii::app()->name); ?></a>
		<!-- Sidebar Toggle-->
		<button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
	</nav>
		<!-- side nav section -->
		<div id="layoutSidenav">
            <div id="layoutSidenav_nav">
				<?php $this->renderPartial('/layouts/_sidebar'); ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <ol class="breadcrumb mb-4">
							<?php if(isset($this->breadcrumbs)):?>
								<?php $this->widget('zii.widgets.CBreadcrumbs', array(
									'links'=>$this->breadcrumbs,
								)); ?><!-- breadcrumbs -->
							<?php endif?>
                        </ol>
						<div id="content">
							<?php echo $content; ?>
						</div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
				<?php $this->renderPartial('/layouts/_footer'); ?>
                </footer>
            </div>
        </div>
<?php echo Yii::powered(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/classic/views/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
