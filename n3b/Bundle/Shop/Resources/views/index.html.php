<?php $view->extend('::base.html.php') ?>
<?php $view['slots']->start('head') ?>
<title><?php echo $view['slots']->output('title', 'Title') ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
<?php $view['slots']->stop() ?>
<?php $view['slots']->start('body') ?>

<div id="wrapper">
	<a id="logo" class="blockCentralizer" href="<?php echo $view['router']->generate('shop_index') ?>">
		<img src="/css/images/logo.gif" alt="logo" title="logo" />
	</a>

	<div id="content">
		<?php $view['slots']->output('content') ?>
	</div>
</div>
<?php $view['slots']->stop() ?>

