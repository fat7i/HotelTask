<?php

namespace Hotels\Libs\Writers;

use Hotels\Exceptions\FileException;


class HtmlWriter extends AbstractWriter
{

    /**
     * Write data into file
     * @return string filename as string
     * @throws FileException
     */
    public function write ()
    {
        $filename = $this->filePath . 'hotels-'. time().'.html';
        $fp = fopen($filename, 'w');

        $html = $this->buildHtml();


        try {
            fwrite($fp, $html);
        } catch (\Exception $e) {
            throw new FileException('Can not save file!.');
        }
        fclose($fp);

        return $filename;
    }

    /**
     * build a Html string from data array
     * @return string
     */
    public function buildHtml()
    {
        $output = "";

        foreach ( $this->data as $hotel)
        {
            if ($output=="") { // 1st loop? create table header form array $hotels keys
                $keys = array_keys($hotel);

                // make table header <th>
                array_walk($keys, function(&$value, $key, $tag) {
                    self::wrapStringWithHtmlTag($value, $key, $tag);
                }, 'th');

                $keys = implode( "\n", $keys);

                self::wrapStringWithHtmlTag($keys, '','tr');

                $output .= "\n\n" . $keys;
            }// close table header </tr>

            // create table row for each $hotel
            array_walk($hotel, function(&$value, $key, $tag) {
                self::wrapStringWithHtmlTag($value, $key, $tag);
            }, 'td');

            $hotel = implode( "\n", $hotel);

            // close hotel </tr>
            self::wrapStringWithHtmlTag($hotel, '','tr');

            $output .= "\n\n" . $hotel;
        }
        self::wrapStringWithHtmlTag($output, '','table');

        return $output;
    }

    /**
     * @param $string
     * @param $key
     * @param string $tag html tag without <>
     * @return string $string
     */
    public static function wrapStringWithHtmlTag (&$string, $key, $tag = 'body')
    {
        $string = "<{$tag}>{$string}</{$tag}>";
    }

}