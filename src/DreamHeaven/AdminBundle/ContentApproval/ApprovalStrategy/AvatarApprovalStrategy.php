<?php

namespace DreamHeaven\AdminBundle\ContentApproval\ApprovalStrategy;

use DreamHeaven\AdminBundle\Document\PendingApprovalObject as PAO;
use DreamHeaven\AdminBundle\Document\ApprovalResult;
use DreamHeaven\HuashuoBundle\Document as D;

class AvatarApprovalStrategy extends PhotoApprovalStrategy {

    public function supports($type) {
        return PAO::TYPE_AVATAR == $type;
    }

    protected function init() {
        parent::init();

        $this->parameters->set('notify_author', true);
    }

    protected function process(ApprovalResult $result) {
        parent::process($result);

        $avatar = $this->idm->find(D\Photo::CLASS_NAME, $result->object_id);
        if (!$avatar) {
            return;
        }

        if (ApprovalResult::ACTION_REJECT == $result->action && $result->notify_author) {
            $this->doProcessAuthorProfile($avatar);
        }
    }

    protected function doProcessAuthorProfile($avatar) {
        $author = $this->idm->find(D\Profile::CLASS_NAME, $avatar->author_id);
        if (!$author) {
            return;
        }

        if ($author->avatar_id == $avatar->id) {
            $spm = $this->container->get('system_preference_manager');
            $defaultAvatarUrl = $spm->get('system.profile.default_avatar');
            $author->avatar_id = null;
            $author->picture = $defaultAvatarUrl;
            $this->idm->persist($author);
        }
    }

}
