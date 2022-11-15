<?php
/**
 * Classe qui définie un rôle en fonction d'une adresse ip ou d'une plage d'adresse ip.
 *
 * @author Arnaud Salvucci <arnaud.salvucci@univ-amu.fr>
 */

namespace App\Bundle\RoleBundle\Service;

use Symfony\Component\HttpFoundation\IpUtils;

/**
 * Class IpRole.
 */
class IpRole
{
    /**
     * IpRole constructor.
     *
     * @param $ip
     * @param $rule
     */
    public function __construct($ip, $rule)
    {
        $this->ip = $ip;
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

        if (IpUtils::checkIp($this->ip, $this->rule['rule'])) {
            $role = $this->rule['name'];
        }

        return $role;
    }
}
