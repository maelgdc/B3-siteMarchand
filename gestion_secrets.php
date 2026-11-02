<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$cle = $_ENV['encryption'];

#Fonction de hashage de mot de passe
function hasher_mdp (string $mdp): string {
     $signature = hash_hmac(
    'sha256',
    $mdp,
    $_ENV['encryption']
);
	return $signature;
}

# Fonction de comparaison de mot de passe
function verifier_mdp(string $mdp, string $hash): bool {
	if(hasher_mdp($mdp)==$hash){
		return True;
	}else{return False;}
}
