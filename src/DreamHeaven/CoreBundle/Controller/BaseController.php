<?php

namespace DreamHeaven\CoreBundle\Controller;

use DreamHeaven\Component\Controller\Controller;

class BaseController extends Controller {

    /** @var Profile2 */
    protected $currentUser = false;

    /**
     * 
     * @abstract 获得当前用户
     * @return Profile2 
     */
    public function getCurrentUser() {
        if ($this->currentUser !== false) {
            return $this->currentUser;
        }
        if (!$this->security->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->currentUser = null;
            return null;
        }
        return $this->currentUser = $this->getCurrentUserAccount();
    }

}