<?php
    /**
     * We sluiten het configuratiebestand in bij de pagina
     * index.php
     */
    include('config/config.php');

    $dsn = "mysql:host=$dbHost;
            dbname=$dbName;
            charset=UTF8";

    /**
     * Maak een nieuw PDO-object aan zodat we een verbinding
     * kunnen maken met de mysql-server
     */
    $pdo = new PDO($dsn, $dbUser, $dbPass);

    /**
     * Dit is de zoekvraag voor de database zodat we 
     * alle achtbanen van Europa selecteren
     */
    $sql = "SELECT  ABVN.Naam
                   ,ABVN.NaamPretpark
                   ,ABVN.Land
                   ,ABVN.Topsnelheid
                   ,ABVN.Hoogte
    
            FROM AchtbanenVanEuropa AS ABVN
            
            ORDER BY ABVN.Hoogte DESC";
    

    /**
     * We moeten de sql-query voorbereiden voor de PDO class
     * door middel van de method prepare
     */
    $statement = $pdo->prepare($sql);

    /**
     * We voeren de geprepareerde sql-query uit
     */
    $statement->execute();

    /**
     * We krijgen de records binnen als een indexed-array
     * met daarin objecten
     */
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoogste Achtbanen van Europa</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <body>
    <div class="container mt-3">

      <div class="row mb-1">
        <div class="col-2"></div>
        <div class="col-8 text-primary"><h3>Hoogste Achtbanen van Europa</h3></div>
        <div class="col-2"></div>
      </div>

      <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-8">
          <h5>Nieuwe achtbaan 
              <a href="./create.php">
                <i class="bi bi-plus-square-fill text-danger"></i>
              </a>
          </h5>
        </div>
        <div class="col-2"></div>
      </div>

      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <table class="table table-hover">
              <thead>
                  <th>Naam Achtbaan</th>
                  <th>Naam Pretpark</th>
                  <th>Land</th>
                  <th>Topsnelheid</th>
                  <th>Hoogte</th>
              </thead>
              <tbody>
                  <?php foreach($result as $achtbaanInfo) : ?>
                        <tr>
                          <td><?= $achtbaanInfo->Naam ?></td>
                          <td><?= $achtbaanInfo->NaamPretpark ?></td>
                          <td><?= $achtbaanInfo->Land ?></td>
                          <td><?= $achtbaanInfo->Topsnelheid ?></td>
                          <td><?= $achtbaanInfo->Hoogte ?></td>                 
                        </tr>
                  <?php endforeach ?>
              </tbody>
          </table>
        </div>        
        <div class="col-2"></div>
      </div>

      


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>