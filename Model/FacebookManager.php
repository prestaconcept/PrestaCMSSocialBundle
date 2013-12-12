<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Model;

use Presta\CMSSocialBundle\Model\Facebook\Response\PageInfosResponse;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class FacebookManager
{
    /**
     * @var \Facebook
     */
    private $facebook;

    /**
     * @param \Facebook $facebook
     */
    public function __construct(\Facebook $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @param string $pageId
     *
     * @throws \RuntimeException
     *
     * @return PageInfosResponse
     */
    public function getPageInfos($pageId)
    {
        try {
            $pageInfos = $this->facebook->api('/' . $pageId);
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Unable to find the page with id %s', $pageId));
        }

        return new PageInfosResponse($pageInfos);
    }
}
