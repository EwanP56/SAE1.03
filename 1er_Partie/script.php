#!/usr/bin/php
<?php
$path = $argv[2] . "/";
mkdir("$path", 0777, true);
foreach (glob("$argv[1]/*.txt") as $filename) {
    $file = fopen("$filename", "r");
    $name = fread($file, filesize("$filename"));
    $name = explode("\n", $name);
    foreach ($name as $key2 => $value) {
        $value = rtrim($value);
        $egal = explode("=", $value);
        if (strtoupper($egal[0]) == 'CODE') {
            $code = $egal[1];
            echo $code . "\n";
        }
    }

    mkdir("$path/$code", 0777, true);
    $outputFile = fopen($path."/".$code."/texte.dat", "w");

    $trim = date("m") % 3;
    $annee = date("Y");
    fwrite($outputFile, "<h1>Résultats trimestriels 0$trim-$annee</h1>\n");

    foreach ($name as $key => $value) {
        $value = rtrim($value);

        if (strtoupper(explode("=", $value)[0]) == "TITRE") {
            fwrite($outputFile, "<h2>" . explode("=", $value)[1] . "</h2>\n");
        } 
        elseif (strtoupper(explode("=", $value)[0]) == "SOUS_TITRE") {
            fwrite($outputFile, "<h3>" .explode("=", $value)[1] . "</h3>\n");
        } 
        elseif (strtoupper($value) == "DEBUT_TEXTE" || strtoupper($value) == "DéBUT_TEXTE") {
            for($i=$key+1; strtoupper(rtrim($name[$i])) != "FIN_TEXTE"; $i++) { 
                echo $name[$i] . "\n";
                fwrite($outputFile, "<p>" . $name[$i] . "</p>\n");
            }
        } 
        elseif (strtoupper($value) == "DEBUT_STATS" || strtoupper($value) == "DéBUT_STATS") {
            fclose($outputFile);
            $outputFile = fopen($path."/".$code."/stats.dat", "w");
            for($i=$key+1; strtoupper(rtrim($name[$i])) != "FIN_STATS"; $i++) {
                $tabStats = explode(',', $name[$i]);
                $taux_evo = (($tabStats[4] - $tabStats[2]) / $tabStats[2]) * 100;
                foreach ($tabStats as $stat) {
                    fwrite($outputFile, "<td>" . $stat."</td>;");
                }
                fwrite($outputFile, "<td>" . round($taux_evo, 2) . "</td>");
                fwrite($outputFile, "\n");
            }
        }
        elseif (strtoupper(explode(":", $value)[0]) == "MEILLEURS") {
            fclose($outputFile);
            $values = array();
            $outputFile = fopen($path."/".$code."/comm.dat", "w");
            $line = preg_replace('/.*(MEILLEURS:)/i', '', $value);
            $data = explode(",", $line);
            $values = array_merge($values,$data);

            usort($values, function($a, $b) {
                preg_match('/([0-9]+)/', $a, $matchesA);
                preg_match('/([0-9]+)/', $b, $matchesB);
                $numA = (int) $matchesA[1];
                $numB = (int) $matchesB[1];
                return $numB - $numA;
            });
            for ($i=0; $i < 3; $i++) { 
                fwrite($outputFile, "<p>" . $values[$i] . "</p>\n");
            }
            fclose($outputFile);
        }
    }

}
?>