<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Album;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // utilisateur 1 : role user
        $user = new Utilisateur();
        $user
            ->setUsername('elon-musk')
            ->setRoles(['ROLE_USER'])
            ->setEmail('emusk@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user, 'AIBOmlde1458,'));
        $manager->persist($user);
        $album = new Album();
        $album
            ->setTitre('Album Space X')
            ->setDescription('Description album Space X')
            ->setSlug('album-space-x')
            ->setIsPublic(false)
            ->setUtilisateur($user);
        $manager->persist($album);

        // utilisateur 2 : role admin
        $user = new Utilisateur();
        $user
            ->setUsername('mark-zuckenberg')
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('mzuckenberg@gmail.com')
            ->setPassword($this->passwordEncoder->encodePassword($user, 'PCMXlzke4721,'));
        $manager->persist($user);
        $album = new Album();
        $album
            ->setTitre('Album Facebook')
            ->setDescription('Description album Facebook')
            ->setSlug('album-facebook')
            ->setIsPublic(true)
            ->setUtilisateur($user);
        $manager->persist($album);

        $manager->flush();
    }
}
