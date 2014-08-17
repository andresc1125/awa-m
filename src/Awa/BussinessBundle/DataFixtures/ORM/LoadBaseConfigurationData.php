<?php

namespace Awa\BussinessBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Awa\UserBundle\Entity\Role;
use Awa\UserBundle\Entity\User;
use Awa\BussinessBundle\Entity\Category;
use Awa\BussinessBundle\Entity\Currency;
use Awa\BussinessBundle\Entity\Platform;
use Awa\BussinessBundle\Entity\Distributor;


class LoadBaseConfigurationData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
      //Create Roles
      $roleUser = new Role();
      $roleUser->setName("ROLE_USER");
      $roleUser->setRole("ROLE_USER");
      $manager->persist($roleUser);
      $manager->flush();
    
      $roleAdmin = new Role();
      $roleAdmin->setName("ROLE_ADMIN");
      $roleAdmin->setRole("ROLE_ADMIN");
      $manager->persist($roleAdmin);
      $manager->flush();
      
      
      $roleUserAdmin = new Role();
      $roleUserAdmin->setName("ROLE_SUPER_ADMIN");
      $roleUserAdmin->setRole("ROLE_SUPER_ADMIN");
      $manager->persist($roleUserAdmin);
      $manager->flush();
      
      //create users
      
      $userAdmin = new User();
      $userAdmin->setUsername('admin');
      $userAdmin->setPassword('admin123=');
      $userAdmin->setEmail('ahcobos@yahoo.com');
      $userAdmin->setSalt("6567a8b89ec6a7f5832c5b134951e3e8");
      $userAdmin->setPassword("ec05019a50118b455f0b95677846319e816f8f8c");
      $userAdmin->addRole($roleAdmin);
      $userAdmin->addRole($roleUserAdmin);
      $manager->persist($userAdmin);
      $manager->flush();
      
      $userAndres = new User();
      $userAndres->setUsername('andres');
      $userAndres->setPassword('andres123=');
      $userAndres->setEmail("andresc1125@gmail.com");
      $userAndres->setSalt("4960a7b525bfca0c09bfeecf819975ed");
      $userAndres->setPassword("082bfe00b9d808413d294019fff1f38fad69b329");
      $userAndres->addRole($roleAdmin);
      $manager->persist($userAndres);
      $manager->flush();
      
      $userWilson = new User();
      $userWilson->setUsername('wilson');
      $userWilson->setPassword('wilson123=');
      $userWilson->setEmail("wilson@wilson.com");
      $userWilson->setSalt("58141762c8faeb5d2f468a4da0171cb3");
      $userWilson->setPassword("4d77a5fd65e8cd372df3fe38dfebcaf7de7c9d26");
      $userWilson->addRole($roleAdmin);
      $manager->persist($userWilson);
      $manager->flush();
      
      $userAndrea = new User();
      $userAndrea->setUsername('andrea');
      $userAndrea->setPassword('andrea123=');
      $userAndrea->setEmail("andrea@andrea.com");
      $userAndrea->setSalt("8207220a709200c6f7bc37921938f08a");
      $userAndrea->setPassword("7fb0abb66284e3fe4333eeda2009309a6cbaafdc");
      $userAndrea->addRole($roleAdmin);
      $manager->persist($userAndrea);
      $manager->flush();
      
      //Categories
      
      $gameCategory = new Category();
      $gameCategory->setName("Game");
      $manager->persist($gameCategory);
      $manager->flush();
      
      //Currency
      $usdCurrency =  new Currency();
      $usdCurrency->setName("USD");
      $manager->persist($usdCurrency);
      $manager->flush();
      
      //platforms
      $android =  new Platform();
      $android->setName("Android");
      $manager->persist($android);
      $manager->flush();
      
      $iOs =  new Platform();
      $iOs->setName("iOs");
      $manager->persist($iOs);
      $manager->flush();
      
      $blackberry =  new Platform();
      $blackberry->setName("Blackberry");
      $manager->persist($blackberry);
      $manager->flush();
      
      $windowsPhone =  new Platform();
      $windowsPhone->setName("Windows Phone");
      $manager->persist($windowsPhone);
      $manager->flush();
      
      //Distributors
      $distributor =  new Distributor();
      $distributor->setName("Awa");
      $distributor->setAuthorized(true);
      $manager->persist($distributor);
      $manager->flush();
      
    }
}