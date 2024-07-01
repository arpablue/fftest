<?php
echo "Hola mundo\n";
$directorio_actual = getcwd();
echo "El directorio actual es: " . $directorio_actual ."\n"; // hahahah

//
$arguments = $argv;

for ($i = 0; $i < count($arguments); $i++)
{
    echo "Argumento $i: " . $arguments[$i] . "\n";
}