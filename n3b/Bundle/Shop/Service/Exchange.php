<?php

namespace n3b\Bundle\Shop\Service;

use Symfony\Component\HttpFoundation\Response;

class Exchange
{
    protected $services;
    protected $config;
    protected $batch = 1000;

    public function __construct($services, $config)
    {
        $this->services = $services;
        $this->config = $config->get('n3b_shop');
    }

    public function recieve()
    {
        try {
            //if($this->services['request']->getMethod() != 'POST')
            //    throw new \Exception('Only "POST" method allowed');
            //$obj = simplexml_load_string(file_get_contents('php://input'));
            $obj = new \SimpleXMLElement(\file_get_contents(__DIR__ . '/../Resources/package.xml'));

            $exchangeOrder = array(
//                'rate_exchange' => 'Currency',
                'serv_center' => 'ServiceCenter',
                'warranty' => 'Warranty',
                'category' => 'Tag',
                'brand' => 'Tag',
                'tag' => 'Tag',
                'good' => 'Product',
            );

            $iterations = 0;

            foreach($exchangeOrder as $xmlNode => $entity) {

                if(array_key_exists($xmlNode, $obj)) {
                    $importerName = 'n3b\Bundle\Shop\Exchange\\' . $entity . 'Importer';
                    $protoName = 'n3b\Bundle\Shop\Exchange\Xml1C\\' . \n3b\Bundle\Util\String::camelize($xmlNode);

                    if(!isset($importer) || !$importer instanceof $importerName)
                        $importer = new $importerName($this->services['em']);

                    foreach($obj->$xmlNode as $nodeObj) {
                        $importer->import(new $protoName($nodeObj));

                        $iterations++;

                        if($iterations % $this->batch == 0) {
                            $this->services['em']->flush();
                            $this->services['em']->clear();
                        }
                    }
                }
            }

            $this->services['em']->flush();
            
        } catch(\Exception $e) {

            return new Response($e->getMessage());
        }

        return new Response('OK');
    }
}
