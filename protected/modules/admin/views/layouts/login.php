<!doctype html> 
<html>
<head>
	<meta charset="utf-8">
	<title>CMS</title>

	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/yui-grids/reset-fonts-grids.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/base.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/forms.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl ?>/css/theme.css">
	<style type="text/css">
		#LoginForm_username, #LoginForm_password {width:400px;}
	</style>
</head>
<body>
	<div id="doc3" class="yui-t" style="width:750px;margin:auto;margin-top:150px;">
		<div id="bd" class="marleft">
			<div id="yui-main">
	            <!-- Remove yui-b class for full wide -->
				<div class="yui-b marright">
					<!-- Main content -->
					
					<div id="content" class="yui-g">
						<?php if(file_exists(Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR.'install.php')): ?>
						<div style="color: red;padding: 10px;">
							<?php echo Yii::t('AdminModule.core', 'Нужно удалить файл install.php'); ?>
						</div>
						<?php endif ?>
						<?php
							echo $content;;
						?>
					</div>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>
