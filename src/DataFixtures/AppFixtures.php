<?php

namespace App\DataFixtures;

use App\Entity\Garment;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Create admin user
        for ($i = 0; $i < 10; $i++) {
            $admin = new User();
            $admin->setFirstName($faker->firstName);
            $admin->setLastName($faker->lastName);
            $admin->setEmail($faker->email);
            $admin->setPassword($this->passwordHasher->hashPassword($admin, 'password'));
            $admin->setRoles([$faker->randomElement(['ROLE_ADMIN', 'ROLE_USER', 'ROLE_CLIENT'])]);
            $manager->persist($admin);
        }



        for ($i = 0; $i < 15; $i++) {
            $order = new Order();
            $order->setOrderDate($faker->dateTimeThisYear);
            $order->setDeliveryDate($faker->dateTimeThisYear);
            $order->setStatus($faker->randomElement(['in progress', 'ready']));
            $order->setAmount($faker->randomFloat(2, 20, 100));
            $order->setPaymentDate($faker->dateTimeThisYear);
            $order->setPaymentMethod($faker->randomElement(['cash', 'card']));
            $order->setUser($faker->randomElement([$admin]));




            $manager->persist($order);
        }
        $services = [];
        $serviceNames = ['Washing', 'Ironing', 'Dry Cleaning', 'Folding'];

        foreach ($serviceNames as $service) {
            $service = new Service();
            $service->setName($faker->randomElement($serviceNames));
            $service->setPrice(mt_rand(500, 2000) / 100);
            // $this->addReference($service,'service' );// Random price between 5 and 20

            $manager->persist($service);
            $services[] = $service;

        }

        for ($i = 0; $i < 30; $i++) {
            $garment = new Garment();
            $garment->setDescription($faker->sentence);
            $garment->setType($faker->randomElement(['Shirt', 'Pants', 'Dress']));
            $garment->setMaterial($faker->randomElement(['Cotton', 'Wool', 'Silk']));
            $garment->addService($faker->randomElement([$service]));

            // Set relationships if needed

            $manager->persist($garment);
        }
        for ($i = 0; $i < 20; $i++) {

            $item = new Item();
            $item
                ->setServiceQuantity($faker->numberBetween(1, 10))
                ->setTotal($faker->numberBetween(1, 100))
                ->setService($faker->randomElement([$service]))
                ->setUser($faker->randomElement([$admin]))
                ->setGarment($faker->randomElement([$garment]));
            $manager->persist($item);
        }






        $manager->flush();
    }
}
