<?php
/**
 * Created by PhpStorm.
 * User: denoix
 * Date: 16/04/18
 * Time: 10:25
 */

namespace App\Bundle\CasBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class OverrideCasAuthCompilerPass implements CompilerPassInterface
{

    /**
     * Overwrite project specific services
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $defNewService = $container->getDefinition('phpcasguard.cas_authenticator');
        $defNewService ->setClass('App\Bundle\CasBundle\Security\AmuCasAuthenticator');

    }
}