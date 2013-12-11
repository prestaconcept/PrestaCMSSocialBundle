<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Tests\Parser\Twitter;

use Presta\CMSSocialBundle\Parser\Twitter\TweetParser;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class TweetParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTweetDataProvider
     */
    public function testParse($tweet, $expectedTweet)
    {
        $parser = new TweetParser();
        $this->assertEquals($expectedTweet, $parser->parse($tweet));
    }

    /**
     * @return array
     */
    public function getTweetDataProvider()
    {
        return array(
            array(
                array(
                    'text' => 'RT @foo: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus…',
                    'retweeted_status' => array(
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                        'user' => array(
                            'screen_name' => 'foo',
                        )
                    )
                ),
                'RT @foo: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.'
            ),
            array(
                array(
                    'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.',
                ),
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus.'
            ),
        );
    }
}
