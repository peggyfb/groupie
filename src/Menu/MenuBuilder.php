<?php

namespace App\Menu;

use App\Entity\Roles;
use App\Repository\RolesRepository;
use Doctrine\ORM\EntityManager;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

class MenuBuilder extends Container
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var
     */
    private $authorizationChecker;

    /**
     * MenuBuilder constructor.
     * @param FactoryInterface $factory
     * @param AuthorizationChecker $authorizationChecker
     * @param TokenStorage $tokenStorage
     */
    public function __construct(FactoryInterface $factory, AuthorizationChecker $authorizationChecker, TokenStorage $tokenStorage)
    {
        parent::__construct();
        $this->factory = $factory;
        $this->authorizationChecker = $authorizationChecker;
        $this->tokenStorage = $tokenStorage;
    }

    public function createSideBarMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('root');

//    ************
//    * Exemples *
//    ************
//
//        Ajout d'un item simple
//        ----------------------
//
//
//        Ajout d'un item si l'utilisateur est authentifié
//        ------------------------------------------------
//
        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
                $menu->addChild('Accueil',['route' => 'homepage',])
                    ->setExtras(['icon'=> 'home']);
        }

        if( $this->authorizationChecker->isGranted('ROLE_ADMIN') ||
            $this->authorizationChecker->isGranted('ROLE_DOSI') ||
            $this->authorizationChecker->isGranted('ROLE_GESTIONNAIRE')) {
            $menu->addChild('Recherche', ['route' => 'search',])
                ->setExtras(['icon' => 'search']);  // Recherche de groupes ou personnes
        }

        if( $this->authorizationChecker->isGranted('ROLE_ADMIN') ||
            $this->authorizationChecker->isGranted('ROLE_DOSI') ) {
            $menu->addChild('Groupes privés', ['route' => 'private',])
                ->setExtras(['icon' => 'lock']);  // Groupes privés
        }
//
//        Ajout d'un item si l'utilisateur est admin
//        ------------------------------------------
//
//        if ($this->authorizationChecker->isGranted('ROLE_ADMIN')){
//            $menu->addChild('Administration',['route' => 'admin'])
//                ->setExtras(['icon'=> 'key']);
//        }
        if( $this->authorizationChecker->isGranted('ROLE_ADMIN')) {
            $menu->addChild('Gestion des groupes', ['route' => 'gestion',])
                ->setExtras(['icon' => 'settings']);  // Ajout/modification/suppression de groupes par les admin
        }

        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('Aide', ['route' => 'homepage',])
                ->setExtras(['icon' => 'help']);  // Lien vers la bibliothèque d'icônes pour faire vos choix => https://material.io/tools/icons/?style=baseline
        }

        return $menu;
    }
}

