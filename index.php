<?php 
    require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./build/style.css" />
    <title>5pSolutions Market</title>
</head>
<body>
    <h3 class="text-center bg-info p-2">
        <span style="color: #EB6949">5</span>
        <span style="color: black">Point</span>
        <span style="color: white">Solutions</span>
    </h3>

    <div class="container-fluid">
        <?php 
            $result = $conn->query("SELECT * FROM products");
        ?>
        <div class="row">
            <!-- <div class="col-lg-3">
                <h5>Filter Product</h5>
                <hr>
                <h6 class="text-info">Selecteaza Nume</h6>
            </div> -->
            <div class="col-lg-9 col-md-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nume</th>
                            <th scope="col">Descriere</th>
                            <th scope="col">Pret</th>
                            <th scope="col">Actiune</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <th><?= $row['id']; ?></th>
                            <td><?= $row['nume']; ?></td>
                            <td><?= $row['descriere']; ?></td>
                            <td><?= $row['pret']; ?>&euro;</td>
                            <td>
                                <a href="index.php?edit=<?= $row['id'] ?>" class="btn btn-info">Edit</a>
                                <a href="index.php?delete=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3 col-md-3 row justify-content-center">
                <h2>Formular</h2>
                <form action="config.php" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-group">
                        <label for="nume">Nume Produs</label>
                        <input type="text" name="nume" id="nume" class="form-control" value="<?= $nume; ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="descriere">Descriere produs</label>
                        <textarea rows="4 cols="50" name="descriere" id="descriere" class="form-control"><?= $descriere; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pret">Pretul Produs</label>
                        <input type="text" name="pret" id="pret" class="form-control" value="<?= $pret; ?>" placeholder="&euro;"/>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <?php 
                            if($update == true) {
                                $disabledSave = 'disabled';
                                $disabledUpdate = '';
                            }
                            else
                            {
                                $disabledUpdate = 'disabled';
                                $disabledSave = '';
                            } 
                            ?>
                            <div class="col-md-6">
                                <button type="submit" name="save" class="btn btn-primary <?= $disabledSave; ?>">Adauga Produs</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="update" class="btn btn-info <?= $disabledUpdate; ?>">Salveaza Modificare</button>
                            </div>   
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>