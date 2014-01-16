<?php
namespace DreamHeaven\AdminBundle\Controller;

use DreamHeaven\AdminBundle\Document\Impersonator;
use DreamHeaven\HuashuoBundle\Document\Profile;
use Symfony\Component\HttpFoundation\Response;

class ImpersonatorController extends BaseController
{
    public function ajaxIndexAction()
    {
        $securityContext = $this->get('security.context');
        if (!$securityContext->isGranted('ROLE_ALLOWED_TO_SWITCH'))
        {
            $content = json_encode(array('error' => 'invalid_request', 'error_description' => '当前用户没有扮演权限'));
            return new Response($content, 403);
        }

        $currentUser = $this->getCurrentUser();
        $hdm = $this->get('huashuo.document_manager');
        $adm = $this->get('doctrine.odm.mongodb.admin_document_manager');
        $userManager = $this->get('fos_user.user_manager');
        $profileRepo = $hdm->getRepository(Profile::CLASS_NAME);

        $cursor = $adm->createQueryBuilder(Impersonator::CLASS_NAME)
                    ->field('user_id')->equals($currentUser->id)
                    ->sort('created_at', 'desc')
                    ->getQuery()
                    ->execute();

        $impersonatedUserInfos = array();
        foreach ($cursor as $impersonatedUser) 
        {
            $user = $userManager->findUserBy(array('id' => $impersonatedUser->impersonated_user_id));
            $info = $profileRepo->getUserInfo($impersonatedUser->impersonated_user_id);
            $info['username'] = $user->getEmail();

            if ($this->isActiveImpersonatedUser($impersonatedUser->impersonated_user_id)) 
            {
                $info['active'] = true;
            }
            $info['has_news'] = $this->hasNews($impersonatedUser->impersonated_user_id);

            $impersonatedUserInfos[] = $info;
        }

        $content = json_encode($impersonatedUserInfos);
        return new Response($content);
    }

    protected function isActiveImpersonatedUser($impersonatedUserId)
    {
        $currentUser = $this->getCurrentUser();
        return $currentUser->id == $impersonatedUserId;
    }

    protected function hasNews($userId)
    {
        $usm = $this->get('user_stat_manager');
        if ($usm->get($userId, 'unread_message_count') > 0) 
        {
            return true;
        }
        if ($usm->get($userId, 'friendship_request_count') > 0) 
        {
            return true;
        }

        if ($usm->get($userId, 'notification_count') > 0) 
        {
            return true;
        }

        return false;
    }
}
