<?php

namespace n3b\Bundle\Shop\Exchange\Xml1C;

use n3b\Bundle\Shop\Exchange\Interfaces\ProductInterface;

class Good extends Prototype implements ProductInterface
{

    public function getId()
    {
        return (int) $this->proto->good_id_site;
    }

    public function getTitle()
    {
        return (string) $this->proto->good_name;
    }

    public function getArticle()
    {
        return (string) $this->proto->good_article;
    }

    public function getPrices()
    {
        $prices = array();

        if(!empty($this->proto->goot_retail_price))
            $prices[] = array(
                'type' => 'retail',
                'currency' => (string) $this->proto->good_retail_price_currency,
                'value' => (float) $this->proto->good_retail_price);

        if(!empty($this->proto->goot_wholesale_price))
            $prices[] = array(
                'type' => 'wholesale',
                'currency' => (string) $this->proto->good_wholesale_price_currency,
                'value' => (float) $this->proto->good_wholesale_price);

        return $prices;
    }

    public function getQuantity()
    {
        return (int) $this->proto->good_quantity;
    }

    public function getActive()
    {
        return 1;
    }
}
