<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
  <title><?= $title ?? 'LifeLists — Auth' ?></title>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="shortcut icon" href="common/images/favicon.ico">
	<link href="../public/css/login_register.css" rel="stylesheet" media="all">
	<link href="../public/css/base.css" rel="stylesheet" media="all">
	<link href="../public/css/layout.css" rel="stylesheet" media="all">
	<link href="../public/css/component.css" rel="stylesheet" media="all">
	<link href="../public/css/custom.css" rel="stylesheet" media="all">
	<link href="../public/css/auth.css" rel="stylesheet" media="all">
	<link href="../public/css/style.css" rel="stylesheet" media="all">
	<link href="../public/css/print.css" rel="stylesheet" media="print">
</head>
    <body class="auth-layout">
      <div class="auth-wrapper">
        <?= $content ?>    <!-- this is the view (app/views/auth/index.php) -->
      </div>
    </body>
</html>