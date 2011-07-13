<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<h2>
    Личный кабинет
</h2>

Здравствуйте, <?php echo $customer->getUsername() ?>
<br />
<br />
Заказы:
<ul>
    <?php foreach($customer->getOrders() as $order): ?>
    <li>
        <?php echo $order->getCreated()->format('D, M Y') ?>
        <ul>
            <?php foreach($order->getItems() as $item): ?>
            <li>
                <?php echo $item->getProduct()->getTitle() ?> x<?php echo $item->getQuantity() ?>
            </li>
            <?php endforeach ?>
        </ul>
    </li>
    <?php endforeach ?>
</ul>
<?php $view['slots']->stop() ?>
