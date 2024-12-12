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

if (isset($_POST['submit'])) {
    /**
     * De sql-query om een achtbaan record te wijzigen
     */
    $sql = "UPDATE AchtbanenVanEuropa AS AVE
            SET
                 AVE.Naam = :naamAchtbaan
                ,AVE.NaamPretpark = :naamPretpark
                ,AVE.Land = :land
                ,AVE.Topsnelheid = :topsnelheid
                ,AVE.Hoogte = :hoogte
            
            WHERE AVE.Id = :id";
    /**
     * Maak het sql-statement klaar voor PDO
     */
    $statement = $pdo->prepare($sql);

    /**
     * Koppel de placeholders aan de waarden die we hebben
     */
    $statement->bindValue(':naamAchtbaan', trim($_POST['achtbaan']), PDO::PARAM_STR);
    $statement->bindValue(':naamPretpark', trim($_POST['pretpark']), PDO::PARAM_STR);
    $statement->bindValue(':land', trim($_POST['land']), PDO::PARAM_STR);
    $statement->bindValue(':topsnelheid', trim($_POST['topsnelheid']), PDO::PARAM_INT);
    $statement->bindValue(':hoogte', trim($_POST['hoogte']), PDO::PARAM_INT);
    $statement->bindValue(':id', trim($_POST['Id']), PDO::PARAM_INT);

    /**
     * Voer de query uit
     */
    $statement->execute();

    /**
     * Geef een melding dat het wijzigen is gelukt
     */
    $display = 'flex';

    /**
     * Stuur de gebruiker door naar de index.php pagina
     */
    header('Refresh:4; url=index.php');



} else {
/**
 * De sql-query om een achtbaan record op te vragen.
 */
$sql = "SELECT  AVE.Id
               ,AVE.Naam
               ,AVE.NaamPretpark
               ,AVE.Land
               ,AVE.Topsnelheid
               ,AVE.Hoogte
    
            FROM AchtbanenVanEuropa AS AVE
            
            WHERE AVE.Id = :id";

/**
 * We moeten de sql-query voorbereiden voor de PDO class
 */
$statement = $pdo->prepare($sql);

/**
 * We koppelen aan de placeholder :id de waarde die we
 * via het $_GET-array hebben binnengekregen
 */
$statement->bindValue(':id', $_GET['Id'], PDO::PARAM_INT);

/**
 * We voeren de geprepareerde sql-query uit
 */
$statement->execute();

/**
 * We krijgen de records binnen als een indexed-array
 * met daarin objecten
 */
$result = $statement->fetch(PDO::FETCH_OBJ);
}
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
      <div class="row" style="display:<?= $display ?? 'none'; ?>">
        <div class="col-3"></div>
        <div class="col-6">
          <div class="alert alert-success text-center" role="alert">
            De wijziging is doorgevoerd, u wordt doorgestuurd naar de homepagina
          </div>
        </div>
        <div class="col-3"></div>
      </div>

      <div class="row mb-1">
        <div class="col-3"></div>
        <div class="col-6 text-primary"><h3>Wijzig de achtbaangegevens</h3></div>
        <div class="col-3"></div>
      </div>

      
      <div class="row">
          <div class="col-3"></div>
          <div class="col-6">              
              <form action="update.php" method="POST">
                <div class="mb-3">
                    <label for="naamAchtbaan" class="form-label">Naam Achtbaan</label>
                    <input name="achtbaan" type="text" class="form-control" id="naamAchtbaan" placeholder="Naam van de achtbaan" value="<?= $result->Naam ?? $_POST['achtbaan']; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamPretpark" class="form-label">Naam Pretpark</label>
                    <input name="pretpark" type="text" class="form-control" id="naamPretpark" placeholder="Naam van het pretpark" value="<?= $result->NaamPretpark ?? $_POST['pretpark']; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamLand" class="form-label">Land</label>
                    <input name="land" type="text" class="form-control" id="naamLand" placeholder="Naam van het land" value="<?= $result->Land ?? $_POST['land']; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamTopsnelheid" class="form-label">Topsnelheid</label>
                    <input name="topsnelheid" type="number" class="form-control" id="naamLand" placeholder="Topsnelheid" min="0" max="255" value="<?= $result->Topsnelheid ?? $_POST['topsnelheid']; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamHoogte" class="form-label">Hoogte</label>
                    <input name="hoogte" type="number" class="form-control" id="naamHoogte" placeholder="Hoogte" min="0" max="255" value="<?= $result->Hoogte ?? $_POST['hoogte']; ?>">
                </div>

                <input type="hidden" name="Id" value="<?= $result->Id ?? $_POST['Id']; ?>">
                
                <div class="d-grid gap-2">
                    <button name="submit" value="submit" type="submit" class="btn btn-primary btn-lg">Wijzigen</button>
                </div>
               
              </form>
        </div>
        <div class="col-3"></div>
      </div>


      

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>