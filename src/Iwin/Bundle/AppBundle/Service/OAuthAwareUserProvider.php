<?php
namespace Iwin\Bundle\AppBundle\Service;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use Iwin\Bundle\AppBundle\Entity\UserRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

/**
 * TODO: write "OAuthAwareUserProvider" info
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class OAuthAwareUserProvider implements
    OAuthAwareUserProviderInterface
{
    protected $repoUser;

    /**
     * @param UserRepository $repoUser
     */
    public function __construct(
        UserRepository $repoUser
    ) {
        $this->repoUser = $repoUser;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $social = $response->getResourceOwner()->getName();
        $user =  $this->repoUser->findBySocial(
            $social,
            $response->getResponse()['id']
        );
        if (!$user){
            throw new UsernameNotFoundException();
        }
        return $user;
    }
}