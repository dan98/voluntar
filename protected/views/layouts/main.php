<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="page">

		<?php $this->widget('booster.widgets.TbNavbar',array(
            'brand' => CHtml::encode(Yii::app()->name),
            'fixed' => 'top',
            'fluid' => true,
            'items' => array(
                array(
                    'class' => 'booster.widgets.TbMenu',
                    'encodeLabel'=>false,
                    'type' => 'navbar',
                    'type' => 'navbar',
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('./')),
                        array('label'=>(Yii::app()->user->getState('role') == '1' ? '<i class="fa fa-circle" id="admin-circle"></i>' : '').' Me', 'url'=>array('/me')),
                        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>'Contact', 'url'=>array('/site/contact')),
                        array('label'=>'Login', 'url'=>array('/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    )
                )
            )
		)); ?>
        <script>
                function flashtext(ele,col) {
                var tmpColCheck = document.getElementById( ele ).style.color;

                if (tmpColCheck === 'rgb(119, 119, 119)') {
                    document.getElementById( ele ).style.color = col;
                } else {
                    document.getElementById( ele ).style.color = 'rgb(119, 119, 119)';
                }
                return  document.getElementById( ele );
            }
            setInterval(function() {
                flashtext('admin-circle','#d9534f');
            }, 1200 ); //
        </script>

        <div class="container">
            <?php if(isset($this->breadcrumbs)):?>
                <?php $this->widget('booster.widgets.TbBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                )); ?>
            <?php endif?>

            <?php echo $content; ?>
        </div>

</div>

</body>
</html>