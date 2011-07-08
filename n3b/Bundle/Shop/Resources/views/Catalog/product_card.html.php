<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<pre>
<?php print_r($product) ?>
</pre>
<?php $view['slots']->stop() ?>
