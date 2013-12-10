<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Twig\Extension;

use Presta\CMSSocialBundle\Helper\Twitter\UrlizeTweetHelper;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class UrlizeTweetTwigExtension extends \Twig_Extension
{
    /**
     * @var UrlizeTweetHelper
     */
    private $helper;

    /**
     * @param UrlizeTweetHelper $helper
     */
    public function __construct(UrlizeTweetHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tweet_urlize';
    }

    /**
     * @param string $text
     *
     * @return string
     */
    public function filterTweet($text)
    {
        return $this->helper->urlize($text);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            'tweet_urlize' => new \Twig_SimpleFilter(
                'tweet_urlize',
                array($this, 'filterTweet'),
                array('pre_escape' => 'html', 'is_safe' => array('html'))
            )
        );
    }
}
