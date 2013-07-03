<?php

require_once 'vendor/.composer/autoload.php';

$client = new Travis\Client();

$repository = $client->fetchRepository('l3l0/OpenSocialBundle');

echo $repository->getId() . "\n";
echo $repository->getSlug() . "\n";
echo $repository->getLastBuild()->getId() . "\n";
echo $repository->getBuilds()->findOneBy(array('number' => 2))->getId() . "\n";

echo 'Builds:' . "\n";
foreach ($repository->getBuilds() as $build) {
	echo "\t" . $build->getId() . "\n";
}