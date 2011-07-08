<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<h1><?php //echo $selectedCatTag ?></h1>
<ul>
<?php foreach($categories as $k => $tag): ?>
    <li>
    <a href="<?php echo $view['router']->generate('n3b_shop_catalog_products', array('slugStr' => $tag->getSlug()))?>">
        <?php echo $tag ?>
    </a>
    <?php if($tag->getChildren()):?>
        <ul>
			<?php foreach($tag->getChildren() as $child):?>
			<li>
                <a href="<?php echo $view['router']->generate('n3b_shop_catalog_products', array('slugStr' => $child->getSlug()))?>">
                    <?php echo $child ?>
                </a>
            </li>
			<?php endforeach;?>
        </ul>
    <?php endif;?>
	</li>
<?php endforeach;?>
</ul>
<h2>Бренды:</h2>
<ul>
<?php foreach ($brands as $k => $tag): ?>
    <li>
        <a href="<?php echo str_replace('%2C', ',', $view['router']->generate('n3b_shop_catalog_products', array('slugStr' => $tag->generateSlugStr($slugs))))?>">
            <?php echo $tag ?>
        </a>
	</li>
<?php endforeach;?>
</ul>
<h2>товары:</h2>
<ul>
    <?php foreach($products as $product): ?>
    <li>
        <a href="<?php echo $view['router']->generate('n3b_shop_catalog_product', array('slug' => $product->getSlug()))?>"><?php echo $product ?></a>
        <?php foreach($product->getPrices() as $price): ?>
            <?php if($price->getPrice()->getId() == 2 && 0): ?>
                <?php echo ($price->getValue() * $price->getCurrency()->getValue()) ?>
            <?php else: ?>
                <?php echo ($price->getValue() * $price->getCurrency()->getValue()) ?>
            <?php endif ?>
        <?php endforeach ?>
        <a href="<?php echo $view['router']->generate('n3b_shop_basket_add', array('productId' => $product->getId()))?>">купить</a>
    </li>
    <?php endforeach ?>
</ul>
<?php $view['slots']->stop() ?>
