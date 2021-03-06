<?php

namespace App\Service\Formater;

class XMLFormater implements Formater
{
    /**
     * @inheritDoc
     */
    public function format(array $datas): string
    {
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
        $node = $xml->addChild('result');

        $this->arrayToXml($datas, $node);

        return $xml->asXML();
    }

    /**
     * convert a multidimentional array to valid XML
     * @param array $array
     * @param $xml
     */
    private function arrayToXml(array $array, &$xml)
    {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subNode = $xml->addChild("$key");
                    $this->arrayToXml($value, $subNode);
                } else {
                    $this->arrayToXml($value, $xml);
                }
            } else {
                $xml->addChild("$key","$value");
            }
        }
    }
}