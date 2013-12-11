<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Helper\Twitter;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class UrlizeTweetHelper
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function urlize($text)
    {
        $text = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#ui", "\\1<a href=\"\\2\">\\2</a>", $text);
        $text = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#ui", "\\1<a href=\"http://\\2\">\\2</a>", $text);
        $text = preg_replace("/@(\w+)/ui", "<a href=\"https://twitter.com/\\1\">@\\1</a>", $text);
        $text = preg_replace("/([^&]|^)#(\w+)/ui", "\\1<a href=\"https://twitter.com/search/\\2\">#\\2</a>", $text);

        return $text;
    }
}
