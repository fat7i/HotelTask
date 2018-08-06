<?php

namespace Hotels\Libs\Writers;

use Hotels\Exceptions\FileException;


class XmlWriter extends AbstractWriter
{

    /**
     * @param array $hotels array of valid hotels
     * @return string filename as string
     * @throws FileException
     */
    public function write()
    {
        $filename = $this->filePath . 'hotels-'. time().'.xml';
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><hotels></hotels>');

        //convert $hotels array to xml obj
        self::arrayToXML($this->data, $xml);

        try {
            $xml->asXML($filename);
        } catch (\Exception $e) {
            throw new FileException('Can not save file!.');
        }

        return $filename;
    }

    /**
     * @param $hotels_array array of valid hotels
     * @param $xmlOBJ Passing xml object by Reference
     * @return XML Object
     */
    public static function arrayToXML($hotels_array, &$xmlOBJ)
    {
        foreach($hotels_array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xmlOBJ->addChild("$key");
                    self::arrayToXML($value, $subnode);
                }else{
                    $subnode = $xmlOBJ->addChild("hotel");
                    self::arrayToXML($value, $subnode);
                }
            }else {
                $xmlOBJ->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}