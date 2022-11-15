<?php
/**
 * Classe qui définie un rôle en fonction d'un login ou d'un tableau de login.
 *
 * @author Arnaud Salvucci <arnaud.salvucci@univ-amu.fr>
 */

namespace App\Bundle\RoleBundle\Service;

/**
 * Class LoginRole.
 */
class LoginRole
{
    /**
     * LoginRole constructor.
     *
     * @param $login
     * @param $rule
     */
    public function __construct($login, $rule)
    {
        $this->login = $login;
        $this->rule = $rule;
    }

    /**
     * Retourne le role de l'utilisateur si la règle match.
     *
     * @return string
     */
    public function getRole()
    {
        $role = '';

        if (in_array($this->login, $this->rule['rule'])) {
            $role = $this->rule['name'];
        }

        return $role;
    }
}
