<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$hash_key = $_ENV['hash'];
$crypt_key = $_ENV['encryption'];

#Fonction de hashage de mot de passe
function hasher_mdp (string $mdp): string {
     $signature = hash_hmac(
    'sha256',
    $mdp,
    $hash_key
);
	return $signature;
}

# Fonction de comparaison de mot de passe
function verifier_mdp(string $mdp, string $hash): bool {
	return hasher_mdp($mdp)==$hash;
}

#Fonction de chiffrement
function chiffrer_donnee (string $donnee, string $cle_chiffrement): string {
	$donnee_chiffre = openssl_encrypt($donnee, 'aes-256-cbc', $cle_chiffrement);
	return $donnee_chiffree;
}

#Fonction de dechiffrement
function dechiffrer_donnee (string $donnee_chiffree, string $cle_dechiffrement): string {
	$donnee_claire = openssl_decrypt($donnee_chiffree, 'aes-256-cbc', $cle_dechiffrement);
	return $donnee_claire;
}
