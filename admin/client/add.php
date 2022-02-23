<?php 

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Contact</title>
  </head>
  <body>
   <div class="container">
   <h1 class="text-center">Ajouter un contact</h1>
        <form action="action.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-control" id="nom">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Mail :</label>
                <input type="mail" name="mail" class="form-control" id="mail">
            </div>
            <div class="mb-3">
                <label for="objet" class="form-label">Objet :</label>
                <input type="text" name="objet" class="form-control" id="objet">
            </div>
            <div class="mb-3">
                <label for="msg" class="form-label">Message :</label>
                <textarea name="msg" class="form-control" id="msg" rows="3"></textarea>
            </div>
            <div class="mb-3 text-center">
                <input type="submit" name="btn_add_contact" class=" btn btn-primary">
            </div>

        </form>
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>