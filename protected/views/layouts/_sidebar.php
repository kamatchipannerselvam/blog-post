<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">User Management</div>
								<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
									<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
									Users
									<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
								</a>
								<div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
									<nav class="sb-sidenav-menu-nested nav">
										<?php echo CHtml::link('User List', array('user/index'),array('class'=>'nav-link')); ?>
										<?php echo CHtml::link('User Roles', '#' ,array('class'=>'nav-link')); ?>
									</nav>
								</div>
								<div class="sb-sidenav-menu-heading">Post Management</div>
								<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsePost" aria-expanded="false" aria-controls="pagesCollapsePost">
								<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>Posts
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapsePost" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
										<?php echo CHtml::link('All Posts', array('post/index'),array('class'=>'nav-link')); ?>
										<?php echo CHtml::link('Add new post', array('user/create'),array('class'=>'nav-link')); ?>
                                        </nav>
                                    </div>
                            </div>
                    	</div>
                </nav>
