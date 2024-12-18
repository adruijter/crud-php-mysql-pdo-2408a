<?php
    
    if (isset($_POST['submit'])) {
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


    $sql = "INSERT INTO AchtbanenVanEuropa
            (
                Naam
                ,NaamPretpark
                ,Land
                ,Topsnelheid
                ,Hoogte
                ,IsActief
                ,Opmerking
                ,DatumAangemaakt
                ,DatumGewijzigd
            )
            VALUES
            (    :naamAchtbaan
                ,:naamPretpark
                ,:land
                ,:topsnelheid
                ,:hoogte
                , 1
                , NULL
                , SYSDATE(6)
                , SYSDATE(6)
            )";
  /**
   * Maak het sql-statement klaar voor PDO
   */
  $statement = $pdo->prepare($sql);

  /**
   * Schoonmaken filteren van het $_POST array
   */
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  /**
   * Het binden van de $_POST- waarden aan de placeholders in de $sql-query
   */
  $statement->bindValue(':naamAchtbaan', trim($_POST['achtbaan']), PDO::PARAM_STR);
  $statement->bindValue(':naamPretpark', trim($_POST['pretpark']), PDO::PARAM_STR);
  $statement->bindValue(':land', trim($_POST['land']), PDO::PARAM_STR);
  $statement->bindValue(':topsnelheid', trim($_POST['topsnelheid']), PDO::PARAM_INT);
  $statement->bindValue(':hoogte', ($_POST['hoogte']), PDO::PARAM_INT);

  /**
   * Voer de query uit.
   */
  $statement->execute();

  /**
   * Maak de succesmelding zichtbaar
   */
  $display = 'flex';

  /**
   * Stuur de gebruiker door naar de index pagina
   */
  header('Refresh:3; url=index.php');
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
            De achtbaan is opgeslagen, u wordt doorgestuurd naar de homepagina
          </div>
        </div>
        <div class="col-3"></div>
      </div>

      <div class="row mb-1">
        <div class="col-3"></div>
        <div class="col-6 text-primary"><h3>Voer een nieuwe achtbaan in:</h3></div>
        <div class="col-3"></div>
      </div>

      
      <div class="row">
          <div class="col-3"></div>
          <div class="col-6">              
              <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="naamAchtbaan" class="form-label">Naam Achtbaan</label>
                    <input name="achtbaan" type="text" class="form-control" id="naamAchtbaan" placeholder="Naam van de achtbaan" value="<?= $_POST['achtbaan'] ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamPretpark" class="form-label">Naam Pretpark</label>
                    <input name="pretpark" type="text" class="form-control" id="naamPretpark" placeholder="Naam van het pretpark" value="<?= $_POST['pretpark'] ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamLand" class="form-label">Land</label>
                    <input name="land" type="text" class="form-control" id="naamLand" placeholder="Naam van het land" value="<?= $_POST['land'] ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamTopsnelheid" class="form-label">Topsnelheid</label>
                    <input name="topsnelheid" type="number" class="form-control" id="naamLand" placeholder="Topsnelheid" min="0" max="255" value="<?= $_POST['topsnelheid'] ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="naamHoogte" class="form-label">Hoogte</label>
                    <input name="hoogte" type="number" class="form-control" id="naamHoogte" placeholder="Hoogte" min="0" max="255" value="<?= $_POST['hoogte'] ?? ''; ?>">
                </div>
                
                <div class="d-grid gap-2">
                    <button name="submit" value="submit" type="submit" class="btn btn-primary btn-lg">Verzenden</button>
                </div>
               
              </form>
        </div>
        <div class="col-3"></div>
      </div>


      

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>