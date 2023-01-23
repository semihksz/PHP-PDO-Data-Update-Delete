<?php
//we include the config file.
require_once 'config.php';
//we add the codes in the listing file.
$list = $db->prepare("SELECT * FROM datainsert");
$list->execute();
$datalist = $list->fetchAll(PDO::FETCH_ASSOC);

//after pressing the delete button, we get the word we sent to the status with get.
if (isset($_GET['delete'])) {
    //we get the id number of the data we want to delete with get. we transfer it to the variable.
    $data = $db->prepare("DELETE FROM datainsert WHERE user_id={$_GET['user_id']}");
    //we are running the variable we transferred.
    $delete = $data->execute();
    //if the deletion process is successful, we print "no" if it is not "ok" in the case.
    if ($delete) {
        header("location:datadelete.php?deletionstatus=ok");
    } else {
        header("location:datadelete.php?deletionstatus=no");
    }
}






?>

<!-- We are creating a simple bootstrap table. -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Data Listing</title>
</head>

<body>
    <div class="container">
        <div class="card mt-5 p-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Usermail</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- we do the same operations as we do in the listing file. -->
                    <?php foreach ($datalist as $key => $datalisting) { ?>
                        <tr>
                            <th scope="row"><?php echo $datalisting['user_id'] ?></th>
                            <td><?php echo $datalisting['user_name'] ?></td>
                            <td><?php echo $datalisting['user_mail'] ?></td>
                            <td>
                                <!-- We are creating an edit button with a link. We get the id number we want to edit with get. -->
                                <a href="dataupdate.php?user_id=<?php echo $datalisting['user_id'] ?>" class="btn btn-success">Update</a>
                                <!-- we print delete in the status section and write the id number we want to delete along with the variable we have listed. -->
                                <a href="datadelete.php?delete=delete&user_id=<?php echo $datalisting['user_id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>