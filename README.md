

#Symfony FormationAFIB Décembre 2016




##Branche DataFixtures


Dans cette branche, on va permettre d'ajouter un jeu de données pour pouvoir faire fonctionner notre application.



###Pour ajouter les datafixtures:

`composer require --dev doctrine/doctrine-fixtures-bundle`


###Ensuite, on active le Bundle dans `app/appKernel.php`:



    // app/AppKernel.php
    // ...
    
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            // ...
            if (in_array($this->getEnvironment(), array('dev', 'test'))) {
                $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();
            }
    
            return $bundles
        }
    
        // ...
    }



###On écrit ensuite nos Fixtures


__Fichier src/AppBundle/DataFixtures/ORM/LoadLivreData.php__

    // src/AppBundle/DataFixtures/ORM/LoadLivreData.php
    
    namespace AppBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use AppBundle\Entity\Livre;
    
    class LoadLivreData implements FixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            $livre = new Livre();
            $livre->setIsbn("FCF82555FFFF");
            $livre->setTitre("1984");
            $livre->setDateparution( new \DateTime('1984-01-01'));
    
            $manager->persist($livre);
            $manager->flush();
        }
    }

__Fichier src/AppBundle/DataFixtures/ORM/LoadAuteurData.php__

    // src/AppBundle/DataFixtures/ORM/LoadAuteurData.php
    
    namespace AppBundle\DataFixtures\ORM;
    
    use Doctrine\Common\DataFixtures\FixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use AppBundle\Entity\Auteur;
    
    class LoadAuteurData implements FixtureInterface
    {
        public function load(ObjectManager $manager)
        {
            $auteur = new Auteur();
            $auteur->setIsbn("FCF82555FFFF");
    
            $manager->persist($livre);
            $manager->flush();
        }
    }


###Et on charge les Fixtures en base

`php app/console doctrine:fixtures:load`

Utilisez le suffixe **--append** si vous souhaitez simplement ajouter ces fixtures à vos données actuelles!
  
  