<?php
require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$hash_key = $_ENV['hash'];
$crypt_key = $_ENV['encryption'];

/**
*Fonction de hashage du mot de passe
**Cette fonction va permettre de retourner la string hashee avec la cle  de hashage passee
*@param string $mdp Le mot de passe a hasher
*@return string $hashed_mdp Retourne le mot de passe hashe
*/
function hasher_mdp (string $mdp): string {
	$hashed_mdp = hash_hmac(
	'sha256',
	$mdp,
	$hash_key
);
	return $hashed_mdp;
}

/**
*Fonction de comparaison
**Cette fonction va comparer un mot de passe avec un terme deja hashe
*@param string $mdp Le mot de passe a comparer
*@param string $hash Le terme deja hashe auquel on va comparer le mdp
*@return bool True Si le mot de passe hashe est identique au $hash
*/
function verifier_mdp(string $mdp, string $hash): bool {
	return hasher_mdp($mdp)==$hash;
}

/**
*Fonction de chiffrement
**Cette fonction va retourner la donnee passee en parametre chiffree avec la cle de chiffrement passee en parametre
*@param string $donnee La donnee a chiffrer
*@param string $cle_chiffrement La cle de chiffrement
*@return string $donnee_chiffre La donnee chiffree
*/
function chiffrer_donnee (string $donnee, string $cle_chiffrement): string {
	$donnee_chiffre = openssl_encrypt($donnee, 'aes-256-cbc', $cle_chiffrement);
	return $donnee_chiffre;
}

/**
*Fonction de dechiffrement
**Cette fonction va dechiffrer la donnee en parametre avec la cle de dechiffrement donnee
*@param string $donnee_chiffree La donnee a dechiffrer
*@param string $cle_dechiffrement La cle de dechiffrement
*@return string $donnee_claire La donnee dechiffree
*/
function dechiffrer_donnee (string $donnee_chiffree, string $cle_dechiffrement): string {
	$donnee_claire = openssl_decrypt($donnee_chiffree, 'aes-256-cbc', $cle_dechiffrement);
	return $donnee_claire;
}
