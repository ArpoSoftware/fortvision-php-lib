<?php

namespace Fortvision\Entity;

use Fortvision\Model\Config;

/**
 * @property string|null $firstName
 * @property string|null $lastName
 * @property string|null $email
 * @property string|null $phone
 * @property string $userId
 * @property string $publisherId
 * @property int|null $isLoggedIn
 * @property bool|null $isSubscribed
 * @method $this setFirstName($firstName)
 * @method $this setLastName($lastName)
 * @method $this setEmail($email)
 * @method $this setPhone($phone)
 * @method $this setUserId($userId)
 * @method $this setPublisherId($publisherId)
 * @method $this setIsLoggedIn($isLoggedIn)
 * @method $this setIsSubscribed($isSubscribed)
 */
class UserInfo extends AbstractEntity
{
    /**
     * @param $data
     */
    public function __construct($data = [])
    {
        if (!isset($data['publisherId'])) {
            $data['publisherId'] = Config::getPublisherId();
        }

        parent::__construct($data);
    }
}
