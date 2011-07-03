<?php $view->extend('::index.html.php') ?>
<?php $view['slots']->start('content') ?>
<ul>
<?php foreach($tags as $k => $tag): ?>
    <?php if($tag->getType()->getTitle() == 'Категория'): ?>
    <li>
    <a href="<?php echo $view['router']->generate('shop_catalog_tag', array('slugStr' => $tag->getSlug()))?>">
        <?php echo $tag ?>
    </a>
    <?php if($tag->getChildren()):?>
        <ul>
			<?php foreach($tag->getChildren() as $child):?>
			<li>
                <a href="<?php echo $view['router']->generate('shop_catalog_tag', array('slugStr' => $child->getSlug()))?>">
                    <?php echo $child ?>
                </a>
            </li>
			<?php endforeach;?>
        </ul>
    <?php endif;?>
	</li>
    <?php unset($tags[$k]) ?>
    <?php else: ?>
    <?php break ?>
    <?php endif ?>
<?php endforeach;?>
</ul>
<?php $view['slots']->stop() ?>