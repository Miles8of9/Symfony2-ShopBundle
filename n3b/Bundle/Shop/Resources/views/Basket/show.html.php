<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<ul>
    <?php foreach($basket->getItems() as $item): ?>
    <li>
        <?php echo $item->getQuantity(), 'x ', $item->getProduct() ?> 
        <a href="<?php echo $view['router']->generate('n3b_shop_basket_remove', array('itemId' => $item->getId())) ?>">X</a>
        <a href="<?php echo $view['router']->generate('n3b_shop_basket_increase', array('itemId' => $item->getId())) ?>">+</a>
        <a href="<?php echo $view['router']->generate('n3b_shop_basket_decrease', array('itemId' => $item->getId())) ?>">-</a>
    </li>
    <?php endforeach ?>
</ul>
<a href="<?php echo $view['router']->generate('n3b_shop_checkout_start') ?>">Оформить заказ</a>
<?php $view['slots']->stop() ?>