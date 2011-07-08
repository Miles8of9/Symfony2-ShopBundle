<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<form id="newUser" method="post" <?php echo $view['form']->enctype($form) ?>>
    <?php echo $view['form']->errors($form) ?>
    <?php echo $view['form']->rest($form) ?>
    <input type="submit" />
</form>
<?php $view['slots']->stop() ?>
