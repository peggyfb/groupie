<?php
/**
 * Classe qui définie un rôle en fonction d'un filtre ldap.
 *
 * @author Arnaud Salvucci <arnaud.salvucci@univ-amu.fr>
 */

namespace App\Bundle\RoleBundle\Service;

use Symfony\Component\Ldap\Ldap;

/**
 * Class LdapRole.
 */
class LdapRole
{
    /**
     * @var string le login du user
     */
    private $login;

    /**
     * @var mixed le service ldap
     */
    private $ldap;
    private $base_dn;
    private $rule;

    /**
     * LdapRole constructor.
     *
     * @param $login
     * @param $ldap
     * @param $rule
     */
    public function __construct($login, $ldap, $rule)
    {
        $this->login = $login;
        $this->ldap = $ldap['service'];
        $this->ldap->bind($ldap['params']['rel_dn'], $ldap['params']['pwd']);
        $this->base_dn = $ldap['params']['base_dn'];
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

        $rule = str_replace('login', $this->login, $this->rule['rule']);
        $query = $this->ldap->query($this->base_dn, $rule);
        $results = $query->execute()->count();
        if ($results > 0) {
            $role = $this->rule['name'];
        }

        return $role;
    }
}
