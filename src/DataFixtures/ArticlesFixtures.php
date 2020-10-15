<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class ArticlesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = faker\Factory::create('fr_FR');

        // Générer un ensemble de catégories
        for ($g=0;$g<8;$g++) {
            $type[$g] = new Type();
            $type[$g]->setNom($faker->word());
            $manager->persist($type[$g]);
            for ($i = 0; $i < 20; $i++) {

                $article = new Articles();
                $article->setNom($faker->word())
                    ->setImage($faker->imageUrl(300, 200))
                    ->setRedacteur($faker->word())
                    ->setContenu($faker->text())
                    ->setType($type[$g])
                    ->setCreatedAt($faker->dateTime());

                $manager->persist($article);
            }
        }

        $manager->flush();
    }
}
