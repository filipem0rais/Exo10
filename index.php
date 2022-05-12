<?php
declare(strict_types=1);
include_once "myDB.php";


?>
<html>
<head>
    <title>Favoris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row">

        <?php
        $db = new myDB();
        $stmt = $db->getAllCategories();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $category) {
            if ($db->checkCategorieEmpty($category['idCategory'])) {


                echo ' <table class="table">
            <thead>
            <h1>' . $category['catName'] . '</h1>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">URL</th>
            </tr>
            </thead>
            <tbody>';
                $links = $db->getCategorie($category['idCategory']);
                foreach ($links->fetchAll(PDO::FETCH_ASSOC) as $result) {
                    echo ' <tr>
                <th scope="row">' . $result['idLink'] . '</th>
                <td>' . $result['linkNom'] . '</td>
                <td>' . $result['linkUrl'] . '</td>
            </tr>';
                }
                echo '</tbody>
        </table>';
            }
        }
        ?>
    </div>
    <div class="row">
        <form action="database.php" method="post">
            <div class="form-group col-md-4">
                <label for="addFav">Ajouter Favori</label>
                <input name="nom" type="text" class="form-control" id="addFav"
                       placeholder="Nom du favori" required>
            </div>
            <div class="form-group col-md-4">
                <label for="addFav">Ajouter URL</label>
                <input name="url" type="text" class="form-control" id="addURL"
                       placeholder="URL" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputCategory">Category</label>
                <select name="categorie" id="inputCategory" class="form-control" required>
                    <option selected>Choose...</option>
                    <?php
                    $stmt = $db->getAllCategories();
                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $result) {
                        echo '<option value="' . $result['idCategory'] . '">' . $result['catName'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</div>
</body>
</html>
