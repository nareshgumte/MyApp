<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css"/>
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <!--<link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->request->baseUrl;           ?>/css/main.css" />-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/application.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-affix.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-alert.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-button.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-carousel.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-collapse.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-dropdown.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-modal.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-popover.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-scrollspy.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-tab.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-tooltip.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-transition.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-typeahead.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5b1.js"></script>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>  

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/renameit.js"></script>


<!--        <script type="text/javascript" src="http://platform.linkedin.com/in.js">
            api_key: <?php //echo Yii::app()->params['linkedInAccess'];             ?>
            authorize: true
            //scope: r_basicprofile r_emailaddress r_fullprofile r_network r_contactinfo rw_nus w_messages rw_groups
        </script>-->
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
        <div id="fb-root"></div> 

        <div class="container" id="page">
            <div class="navbar navbar-fixed-top">  
                <div class="navbar-inner">  

                    <div class="container">  
                        <ul class="nav">  
                            <li class="active">  
                                <a class="brand" href="#"><?= CHtml::encode(Yii::app()->name); ?></a>  
                            </li>  
                            <?php if (!Yii::app()->user->isGuest) { ?>
                                <li><?php echo CHtml::link('Home', array('/site/index')); ?></li>  
                                <li><?php echo CHtml::link('MyProfile', array('/profile/'. Yii::app()->user->id)); ?></li>  
                                <li><?php echo CHtml::link('ManageFriends', array('/site/manageFriends')); ?></li>  
                                <li><?php echo CHtml::link('change password', array('/site/changePassword')); ?></li>  
                                <li><?php echo CHtml::link('Logout (' . Yii::app()->user->name . ')', array('/site/logout')); ?></li> 
                                <?php
                            }else
                                echo "";
                            ?>
                        </ul>  
                    </div>  
                </div>  
            </div>  

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <!--            <div id="footer">
                            Copyright &copy; <?php echo date('Y'); ?> by IntroPost.<br/>
                            All Rights Reserved.<br/>
            
            
                        </div> footer -->

        </div><!-- page -->

    </body>
</html>
