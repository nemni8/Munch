<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="keywords" content="<?php if ( ! empty($meta_keys)) echo $meta_keys ?>" />
	<meta name="description" content="<?php if ( ! empty($meta_desc)) echo $meta_desc ?>" />
	<title><?php if(!empty($meta_title)): ?><?php echo $meta_title ?><?php endif ?></title>
	<script type="text/javascript">var base_url = '<?php echo url::base() ?>';</script>
<?php
// template css, javascript, meta data
if (isset($styles))  foreach ($styles as $style) echo HTML::style($style, array('media'=>'screen'), TRUE), "\n";
if (isset($scripts)) foreach ($scripts as $script) echo HTML::script($script), "\n";
if (isset($metas))   foreach ($metas as $meta) echo HTML::meta($meta), "\n";
?>
</head>

<body class="">
	<div id="wrapper" class="">
		<div id="wrapper_inner" class="">
			<div id="nav"><?php echo $nav ?></div>
			<div id="header"><?php echo $header ?></div>

			<div id="content" class="">
				<?php echo $content ?>
			</div>

			<div id="panel">
				<?php echo $panel ?>
			</div>

			<div class="clear"></div>
			<div id="footer"><?php echo $footer ?></div>
		</div>
	</div>

	<?php echo View::factory('profiler/stats') ?>
</body>
</html>