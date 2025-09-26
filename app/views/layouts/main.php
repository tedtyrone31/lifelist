<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
  <title><?= $title ?? 'LifeLists' ?> | LifeList</title>

	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	
	<link rel="shortcut icon" href="common/images/favicon.ico">
	<link href="css/normalize.css" rel="stylesheet" media="all">
	<link href="css/base.css" rel="stylesheet" media="all">
	<link href="css/layout.css" rel="stylesheet" media="all">
	<link href="css/component.css" rel="stylesheet" media="all">
	<link href="css/style.css" rel="stylesheet" media="all">
	<link href="css/custom.css" rel="stylesheet" media="all">
	<link href="css/style_sp.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/drawer.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/print.css" rel="stylesheet" media="print">
	
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="js/iscroll.js"></script> 
	<script src="js/drawer.js"></script> 
	<script src="js/custom.js"></script>
</head>

<body id="top" class="drawer drawer--right">
  <div class="l_bg">
		<div class="l_container l_wrap clearfix">
			<button type="button" class="drawer-toggle drawer-hamburger">
				<span class="drawer-hamburger-icon"></span>
			</button>
      <div class="l_side_contents">
          <?php require __DIR__ . '/navbar.php'; ?>
      </div>

      <div class="l_main_contents">
				 <div class="l_main_content_wrap">
           <?= $content ?>
         </div>
			</div>
    </div>
  </div>
</body>
</html>

