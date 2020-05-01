<?php

namespace App\DataFixtures;

use App\Entity\Boisson;
use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Formation;
use App\Entity\Menu;
use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * L'encodeur de mot de passe
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for($u = 0; $u < 10; $u++) {
            $user = new User();

            $hash = $this->encoder->encodePassword($user,"password");

            $user->setFirstName($faker->firstName())
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setPassword($hash);

            $manager->persist($user);

            for ($m = 0; $m < mt_rand(5, 20); $m++) {

                $commande = new Commande();
                $menu = new Menu();

                $commande->setDateCommande($faker->dateTimeBetween('-6 months'))
                    ->setNumTable($faker->randomDigit)
                    ->setUser($user);

                $manager->persist($commande);




                $menu->setNom($faker->randomElement(['Ndolé', 'Poulet', 'Porc', 'riz sauce tomate', 'spaghetti sauté']))
                    ->setImage($faker->imageUrl($width = 640, $height = 480));

                $manager->persist($menu);
            }
            for ($c = 0; $c < mt_rand(5, 20); $c++){
                for ($c1 = 0; $c1 < mt_rand(5, 20); $c1++) {
                    $categorie = new Categorie();

                    $categorie->setNom($faker->randomElement(['Brasserie', 'Guiness Company']))
                        ->setDescription($faker->paragraph($nbSentences = 3, $variableNbSentences = true));

                    $manager->persist($categorie);

                    for ($b = 0; $b < mt_rand(5, 20); $b++) {
                        $boisson = new Boisson();
                        $boisson->setNom($faker->randomElement(['Kadji', 'Guiness', 'Amstel']))
                            ->setQuantite($faker->randomDigitNotNull)
                            ->setCategorie($categorie);

                        $manager->persist($boisson);
                    }
                }


            }

            for ($f = 0; $f < mt_rand(5, 20); $f++){
                for ($cl = 0; $cl < mt_rand(5, 20); $cl++) {
                    $formation = new Formation();
                    $formation->setNom($faker->randomElement(['Natation', 'Serveur', 'Restauration']))
                        ->setDuree($faker->randomNumber($nbDigits = NULL, $strict = false))
                        ->setUser($user);

                    $manager->persist($formation);

                    $client = new Client();
                    $client->setFirstName($faker->firstName())
                        ->setAdresse($faker->city)
                        ->setLastName($faker->lastName)
                        ->setNumero($faker->randomNumber($nbDigits = NULL, $strict = false));

                    $manager->persist($client);

                    for ($r = 0; $r < mt_rand(5, 20); $r++) {
                        $reservation = new Reservation();

                        $reservation->setDescription($faker->sentence($nbWords = 6, $variableNbWords = true))
                            ->setClient($client)
                            ->setDateReservation($faker->dateTimeBetween('-6 months'))
                            ->setReservationSalle($faker->randomDigit)
                            ->setReservationTable($faker->randomDigit);

                        $manager->persist($reservation);
                    }
                }
            }

        }

        $manager->flush();
    }
}
