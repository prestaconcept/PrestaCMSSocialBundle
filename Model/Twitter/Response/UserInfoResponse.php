<?php
/**
 * This file is part of the PrestaCMSSocialBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSSocialBundle\Model\Twitter\Response;

/**
 * @author Benoît Lévêque <bleveque@prestaconcept.net>
 */
class UserInfoResponse
{
    /**
     * @var array
     */
    private $userInfo;

    /**
     * @param array $userInfo
     */
    public function __construct(array $userInfo)
    {
        $this->userInfo = $userInfo;
    }

    /**
     * @return array
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * @return int
     */
    public function getFollowersCount()
    {
        return isset($this->userInfo['followers_count']) ? $this->userInfo['followers_count'] : 0;
    }
}
