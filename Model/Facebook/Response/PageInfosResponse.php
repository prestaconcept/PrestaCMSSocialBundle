<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Model\Facebook\Response;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class PageInfosResponse
{
    /**
     * @var array
     */
    private $pageInfos;

    /**
     * @param array $pageInfos
     */
    public function __construct(array $pageInfos)
    {
        $this->pageInfos = $pageInfos + array(
            'likes' => 0,
        );
    }

    /**
     * @return array
     */
    public function getPageInfos()
    {
        return $this->pageInfos;
    }

    /**
     * @return int
     */
    public function getFanCounts()
    {
        return $this->pageInfos['likes'];
    }
}
