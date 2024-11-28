<?php
    var_dump($_POST);
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
        <div class="col-8 text-primary"><h3>Voer een nieuwe achtbaan in:</h3></div>
        <div class="col-2"></div>
      </div>

      <form action="create.php" method="POST">
        <div class="mb-3">
            <label for="naamAchtbaan" class="form-label">Naam Achtbaan</label>
            <input name="achtbaan" type="text" class="form-control" id="naamAchtbaan" placeholder="Naam van de achtbaan">
        </div>
        <div class="mb-3">
            <label for="naamPretpark" class="form-label">Naam Pretpark</label>
            <input name="pretpark" type="text" class="form-control" id="naamPretpark" placeholder="Naam van het pretpark">
        </div>
        <div class="mb-3">
            <label for="naamLand" class="form-label">Land</label>
            <input name="land" type="text" class="form-control" id="naamLand" placeholder="Naam van het land">
        </div>
        <div class="mb-3">
            <label for="naamTopsnelheid" class="form-label">Topsnelheid</label>
            <input name="topsnelheid" type="number" class="form-control" id="naamLand" placeholder="Topsnelheid" min="0" max="200">
        </div>
        <div class="mb-3">
            <label for="naamHoogte" class="form-label">Hoogte</label>
            <input name="hoogte" type="number" class="form-control" id="naamHoogte" placeholder="Hoogte" min="0" max="200">
        </div>
        
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
       
      </form>


      

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>