<?php
/**
 * Created by PhpStorm.
 * User: denoix
 * Date: 29/03/18
 * Time: 13:39
 */

namespace App\Bundle\CasBundle\Security\User;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use App\Bundle\RoleBundle\Service\Role;

class CasUser implements UserInterface, EquatableInterface
{
    private $username;
    private $password;
    private $salt;
    private $roles;
    private $roleService;
    private $options;

    public function __construct($username, $password, $salt, array $roles, Role $roleService = null, array $options = null)
    {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = $roles;
        $this->roleService = $roleService;
        $this->options = $options;
    }

    public function getRoles()
    {
        if ($this->roleService) {
            $roles = $this->roleService->getRoles($this->username, $this->options);
        }

        // guarantees that a user always has at least one role for security
        $roles[] = 'ROLE_CAS_AUTHENTICATED';

        $this->roles = array_unique($roles);
        return $this->roles;
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof CasUser) {
            return false;
        }


        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    public function __toString()
    {
        return (string) $this->getUsername();
    }
}