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
<body class="d-flex flex-column h-100">
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
                <div class="container px-5">
                    <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('site/index')?>"><span class="fw-bolder text-primary"><?php echo CHtml::encode(Yii::app()->name); ?></span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
						<?php echo $this->userinfo?$this->userinfo->username:null ?>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                            <li class="nav-item"><?php echo CHtml::link('Home', array('site/index'),array('class'=>'nav-link')); ?></li>
                            <li class="nav-item"><?php echo CHtml::link('Live', array('/live-posts'),array('class'=>'nav-link')); ?></li>
							<?php if(Yii::app()->user->isGuest){ ?>
                            <li class="nav-item"><?php echo CHtml::link('Login', array('site/login'),array('class'=>'nav-link')); ?></li>
                            <li class="nav-item"><?php echo CHtml::link('signup', array('site/signup'),array('class'=>'nav-link')); ?></li>
							<?php } else {?>
								<li class="nav-item"><?php echo CHtml::link('Dashboard', array('post/index'),array('class'=>'nav-link')); ?></li>
								<li class="nav-item"><?php echo CHtml::link('Logout', array('site/logout'),array('class'=>'nav-link')); ?></li>
							<?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <section class="bg-light py-5">
                <div class="container px-5">
					<div id="content" class="container-sm">
					<?php if(Yii::app()->user->hasFlash('success')): ?>
							<div class="alert alert-success">
								<?php echo Yii::app()->user->getFlash('success'); ?>
							</div>
						<?php endif; ?>

						<?php if(Yii::app()->user->hasFlash('error')): ?>
							<div class="alert alert-danger">
								<?php echo Yii::app()->user->getFlash('error'); ?>
							</div>
						<?php endif; ?>						
						<?php echo $content; ?>
					</div>
				</div>
			</section>
		<footer class="bg-white py-4 mt-auto">
		<?php $this->renderPartial('/layouts/_footer'); ?>
		</footer>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/themes/classic/views/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
