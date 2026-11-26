<?php

echo "Configuration PHP chargée :<br>";

echo "error_log : " . ini_get('error_log') . "<br>";
echo "log_errors : " . ini_get('log_errors') . "<br>";

error_log("Test des logs depuis B3-siteMarchand");