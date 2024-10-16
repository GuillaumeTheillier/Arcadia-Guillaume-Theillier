<?php

require_once('src/model/animals.php');

/**
 * Create race in database. Check that the new race doesn't exist.
 * @param string $new New race to create.
 * @return int Race id.
 */
function addRace(string $new): int
{
    $newNotAcc = removeAccent($new);
    $animalRepository = new AnimalsRepository;
    $raceList = animalRepository()->getRace();

    foreach ($raceList as $race) {
        $label = $race['label'];
        $label = strtolower($label);
        removeAccent($label);
        $raceOrg[] = $label;
    }

    if (in_array($newNotAcc, $raceOrg, true)) {
        throw new Exception('Cette race existe déjà.');
    }
    $animalRepository->createRace($new);
    return animalRepository()->getIdRace($new);
}

/**
 * Remove all accents on string.
 * @param string $l 
 * @return string 
 */
function removeAccent(string $l): string
{
    $str = htmlentities($l, ENT_NOQUOTES, 'utf-8');
    $str = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $str);
    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
    return preg_replace('#&[^;]+;#', '', $str);
}
