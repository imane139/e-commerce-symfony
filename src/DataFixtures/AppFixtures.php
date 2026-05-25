<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Catégorie Électronique
        $cat1 = new Category();
        $cat1->setName('Électronique');
        $manager->persist($cat1);

        // Catégorie Vêtements
        $cat2 = new Category();
        $cat2->setName('Vêtements');
        $manager->persist($cat2);

        // Catégorie Maison
        $cat3 = new Category();
        $cat3->setName('Maison');
        $manager->persist($cat3);

        // Produits Électronique
        $p1 = new Product();
        $p1->setName('Smartphone XL');
        $p1->setDescription('Un excellent smartphone avec grand écran et batterie longue durée.');
        $p1->setPrice('599.99');
        $p1->setCategory($cat1);
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setName('Laptop Pro');
        $p2->setDescription('Laptop performant pour les professionnels.');
        $p2->setPrice('999.99');
        $p2->setCategory($cat1);
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setName('Casque Audio');
        $p3->setDescription('Son de haute qualité avec réduction de bruit.');
        $p3->setPrice('149.99');
        $p3->setCategory($cat1);
        $manager->persist($p3);

        // Produits Vêtements
        $p4 = new Product();
        $p4->setName('T-shirt Classic');
        $p4->setDescription('T-shirt confortable en coton 100%.');
        $p4->setPrice('19.99');
        $p4->setCategory($cat2);
        $manager->persist($p4);

        $p5 = new Product();
        $p5->setName('Jean Slim');
        $p5->setDescription('Jean slim tendance et confortable.');
        $p5->setPrice('49.99');
        $p5->setCategory($cat2);
        $manager->persist($p5);

        // Produits Maison
        $p6 = new Product();
        $p6->setName('Lampe Design');
        $p6->setDescription('Lampe moderne pour votre salon.');
        $p6->setPrice('79.99');
        $p6->setCategory($cat3);
        $manager->persist($p6);

        $manager->flush();
    }
}
