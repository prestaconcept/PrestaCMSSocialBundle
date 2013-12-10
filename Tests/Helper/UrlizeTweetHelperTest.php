<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Tests\Helper;

use Presta\CMSSocialBundle\Helper\Twitter\UrlizeTweetHelper;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class UrlizeTweetHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTweetDataProvider
     */
    public function testUrlize($text, $expectedValue)
    {
        $helper = new UrlizeTweetHelper();
        $this->assertEquals($expectedValue, $helper->urlize($text));
    }

    /**
     * @return array
     */
    public function getTweetDataProvider()
    {
        return array(
            array(
                '@mentions',
                '<a href="https://twitter.com/mentions">@mentions</a>',
            ),
            array(
                '#hashtags',
                '<a href="https://twitter.com/search/hashtags">#hashtags</a>',
            ),
            array(
                '#hashtagsWithDîacrìtics',
                '<a href="https://twitter.com/search/hashtagsWithDîacrìtics">#hashtagsWithDîacrìtics</a>',
            ),
            array(
                'www.google.com',
                '<a href="http://www.google.com">www.google.com</a>',
            ),
            array(
                'http://www.google.com',
                '<a href="http://www.google.com">http://www.google.com</a>',
            )
        );
    }
}
