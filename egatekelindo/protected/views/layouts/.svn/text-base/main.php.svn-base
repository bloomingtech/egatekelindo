<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => 'Master', 'url' => array('/site/page', 'view' => 'master')),
                        array('label' => 'Transaction', 'url' => array('/site/page', 'view' => 'transaction'))
                        ,
                        array('label' => 'Gudang', 'url' => array('/site/page', 'view' => 'warehouse')),
                        array('label' => 'Finance', 'url' => array('/site/page', 'view' => 'finance')),
                        array('label' => 'Report', 'url' => array('/site/page', 'view' => 'report')),
                        array('label' => 'Revisi', 'url' => array('/site/page', 'view' => 'management')
                        ),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
                <?php
//                $this->widget('zii.widgets.CMenu', array(
//                    'items' => array(
//                        array('label' => 'Master', 'url' => array('/site/page', 'view' => 'master'), 'visible' => Yii::app()->user->checkAccess('master')),
//                        array('label' => 'Transaction', 'url' => array('/site/page', 'view' => 'transaction'), 
//                            'visible' =>
//                            Yii::app()->user->checkAccess('transaction') ||
//                            Yii::app()->user->checkAccess('saleOrderCreate') ||
//                            Yii::app()->user->checkAccess('estimationCreate') ||
//                            Yii::app()->user->checkAccess('budgetingCreate') ||
//                            Yii::app()->user->checkAccess('workOrderDrawingCreate') ||
//                            Yii::app()->user->checkAccess('workOrderProductionCreate') ||
//                            Yii::app()->user->checkAccess('requirementCreate')
//                        )
//                        ,
//                        array('label' => 'Gudang', 'url' => array('/site/page', 'view' => 'warehouse')),
//                        array('label' => 'Finance', 'url' => array('/site/page', 'view' => 'finance')),
//                        array('label' => 'Report', 'url' => array('/site/page', 'view' => 'report')),
//                        array('label' => 'Revisi', 'url' => array('/site/page', 'view' => 'management'), 'visible' =>
//                            Yii::app()->user->checkAccess('transaction') ||
//                            Yii::app()->user->checkAccess('saleOrderEdit') ||
//                            Yii::app()->user->checkAccess('estimationEdit') ||
//                            Yii::app()->user->checkAccess('budgetingEdit') ||
//                            Yii::app()->user->checkAccess('workOrderDrawingEdit') ||
//                            Yii::app()->user->checkAccess('workOrderProductionEdit') ||
//                            Yii::app()->user->checkAccess('requirementEdit')
//                        ),
//                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
//                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
//                    ),
//                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

            <?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by PT. EGA Tekelindo Prima. All Rights Reserved.<br/>
                Powered by <?php echo CHtml::link('BloomingTech', 'http://www.bloomingtech.com'); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
