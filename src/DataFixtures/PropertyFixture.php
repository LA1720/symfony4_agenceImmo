<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Property;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i <100; $i++){
            $property = new Property();
            $property
                    ->setTitle($faker->word(3, true))
                    ->setDescription($faker->sentences(3, true))
                    ->setSurface($faker->numberBetween(20, 350))
                    ->setRooms($faker->numberBetween(2, 10))
                    ->setBedrooms($faker->numberBetween(1, 10))
                    ->setFloor($faker->numberBetween(1, 15))
                    ->setPrice($faker->numberBetween(10000, 10000000))
                    ->setHeat($faker->numberBetween(0, count(Property::HEAT) - 1))
                    ->setCity($faker->city)
                    ->setAddress($faker->address)
                    ->setPostalCode($faker->postcode)
                    ->setSold(false);
            $manager->persist($property); // now load your fixture by php bin/console doctrine:fixtures:load => yes and ckeck in your navigator
            
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush(); 
    }
}
