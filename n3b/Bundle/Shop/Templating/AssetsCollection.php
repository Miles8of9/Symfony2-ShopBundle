<?php

namespace n3b\Bundle\Shop\Templating;

use Symfony\Component\Templating\Helper\Helper;

class AssetsCollection extends Helper
{
    protected $assets = array(
        'js' => array(),
        'css' => array(),
    );

    public function add($type, $urls)
    {
        $this->assets[$type] = array_merge($this->assets[$type], $urls);
    }

    public function get($type)
    {
        if(isset($this->assets[$type]))
            return $this->assets[$type];

        return array();
    }

    public function getName()
    {
        return 'assets';
    }
}
