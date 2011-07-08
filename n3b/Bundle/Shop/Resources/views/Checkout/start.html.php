<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
Оформляем заказ

<form action="<?php echo $view['router']->generate('n3b_shop_checkout_start') ?>" method="post" <?php echo $view['form']->enctype($form) ?>>
<?php echo $view['form']->errors($form) ?>
<?php echo $view['form']->rest($form) ?>
<input type="submit" />
</form>
<?php $view['slots']->stop() ?>