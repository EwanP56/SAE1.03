#!/usr/local/bin/php

<?php

   $today = date("d-m-Y H:i")

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>

   <section>

      <?php
         $file = fopen("region.conf", "r");
         $ligne = fread($file, filesize("region.conf"));
         $ligne = explode("\n", $ligne);

         foreach ($ligne as $key => $value) {
            $value = explode(",", $value);
            if (strtoupper($value[0]) == $argv[1]) {
               $nomReg = $value[1];
               $nbHab = $value[3];
               $nbDep = $value[4];
               $superf = $value[2];
            }
         }
      ?>

      <div>
         <?php echo "<img src=" . '"' . "../logo/" . $argv[1] . ".png" . '"' . 'alt="">'; ?>
         <h1><?php echo $nomReg ?></h1>
      </div>
      <div>
         <p><?php echo $nbHab ?> habitants pour <?php echo $superf ?>Km²</p>
         <p><?php echo $nbDep ?> départements</p>
      </div>

      <div class="bottom"><p><?php echo $today; ?></p></div>
   </section>

   <section>
      <div>
         <?php

            $file = fopen("resultat/" . $argv[1] . "/texte.dat", "r");
            $name = fread($file, filesize("resultat/" . $argv[1] . "/texte.dat"));
            $name = explode("\n", $name);

            foreach ($name as $key => $value) {
               echo $value;
            }
            fclose($file);
         ?>
      </div>
      <table>
         <thead>
            <tr>
               <th>Produit</th>
               <th>Ventes du trimestre</th>
               <th>CA du trimestre</th>
               <th>Ventes du même trimestre année précédente</th>
               <th>CA du même trimestre année précédente</th>
               <th>Evolution du CA (valeur absolue)</th>
            </tr>
         </thead>
         <tbody>
            <?php 
               $file = fopen("resultat/" . $argv[1] . "/stats.dat", "r");
               $name = fread($file, filesize("resultat/" . $argv[1] . "/stats.dat"));
               $name = explode("\n", $name);
   
               foreach ($name as $key => $value) {
                  echo $value;
               }
            ?>
         </tbody>
      </table>
      
      <div class="bottom"><p><?php echo $today; ?></p></div>
   </section>
   <section>
      <h1>Nos meilleurs vendeurs du trimestre</h1>
      <?php 
               $file = fopen("resultat/" . $argv[1] . "/comm.dat", "r");
               $name = fread($file, filesize("resultat/" . $argv[1] . "/comm.dat"));
               $name = explode("\n", $name);
               foreach ($name as $key => $value) {
                  if ($value != "") {
                     $value = explode("/", $value);
                     $initiale = strtolower($value[0]);
                     $value = explode("=", $value[1]);
                     echo "<div><img src=" . '"' . "../pp/" . $initiale . ".png" . '"' . 'alt="">' . "<p>$value[0] : $value[1] de CA</p></div>";
                  }
               }
            ?>
      <div class="bottom"><p><?php echo $today; ?></p></div>
   </section>

   <section>
      <?php echo "<img src=" . '"../qrcode/' . strtolower($argv[1]) . '.png"' . "/>" ?>
      <?php echo "<a href=" . '"' . "https://bigbrain.biz/" . strtolower($argv[1]) . '"' . ">https://bigbrain.biz/" . strtolower($argv[1]) . "</a>"; ?>
      <div class="bottom"><p><?php echo $today; ?></p></div>
   </section>
</body>
</html>