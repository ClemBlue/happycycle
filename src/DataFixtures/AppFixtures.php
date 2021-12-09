<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Departement;
use App\Entity\Villes;
use App\Entity\Conteneur;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departement = new Departement();
        $departement->setName('Haute-Garonne');
        $manager->persist($departement);
        $api_url = 'https://data.toulouse-metropole.fr/api/records/1.0/search/?dataset=points-dapport-volontaire-dechets-et-moyens-techniques&q=&rows=5000&facet=commune&facet=flux';
        $json_data = file_get_contents($api_url);

        $response_data = json_decode($json_data);

        $villes_data = $response_data->records;
        $villesNames = [];
        foreach ($villes_data as $ville_data) {
            if (isset($ville_data->fields->commune)) {
                if (in_array($ville_data->fields->commune, $villesNames)) {
                } else {
                    array_push($villesNames, $ville_data->fields->commune);
                }
            } else {
                if (in_array('Commune de Toulouse', $villesNames)) {
                } else {
                    array_push($villesNames, 'Commune de Toulouse');
                }
            }
        }
        foreach ($villesNames as $value) {
            $ville =  new Villes();
            $ville->getDepartement('Haute-Garonne');

            $ville->setName($value);

            $ville->setDepartement($departement);

            $manager->persist($ville);
            $manager->flush();
            foreach ($villes_data as $benne_data) {
                if (isset($benne_data->fields->commune)) {
                    if ($benne_data->fields->commune == $value) {

                        $benne = new Conteneur();
                        $benne->getVille($benne_data->fields->commune);
                        $benne->setVille($ville);
                        $benne->setLon($benne_data->geometry->coordinates[0]);
                        $benne->setLat($benne_data->geometry->coordinates[1]);
                        $manager->persist($benne);
                    }
                } else {
                    if ('Commune de Toulouse' == $value) {
                        $benne = new Conteneur();
                        $benne->getVille('Commune de Toulouse');
                        $benne->setVille($ville);
                        $benne->setLon($benne_data->geometry->coordinates[0]);
                        $benne->setLat($benne_data->geometry->coordinates[1]);
                    }
                }
            }
        }
        $manager->flush();
    }
}