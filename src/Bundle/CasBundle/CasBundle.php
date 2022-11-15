<?php

namespace App\Bundle\CasBundle;

use App\Bundle\CasBundle\DependencyInjection\Compiler\OverrideCasAuthCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AmuCasBundle.
 */
class CasBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideCasAuthCompilerPass());
    }
}
