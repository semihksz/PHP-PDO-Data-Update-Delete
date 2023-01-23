<?php
//we include the config file.
require_once 'config.php';

//We list the data with the id number that came with get.
$data = $db->prepare("SELECT * FROM datainsert WHERE user_id={$_GET['user_id']}");
//We run the variable we created.
$data->execute();
//we just brought the data we wanted and transferred it to the variable.
$user = $data->fetch(PDO::FETCH_ASSOC);
//we convert the keyword in the array into a variable.
extract($user);

//we are creating a query and typing the name of our update button here.
if (isset($_POST['dataupdate'])) {
    //we do the update process and write the data we want to update after the SET expression.
    $data = $db->prepare("UPDATE datainsert SET
    user_name=:user_name,
    user_mail=:user_mail WHERE user_id=:user_id
    ");

    //we edit the data from the post as an array in the execute command and run it. we transfer this to a variable.
    $update = $data->execute([
        'user_name' => $_POST["user_name"],
        'user_mail' => $_POST["user_mail"],
        'user_id'   => $_POST["user_id"]
    ]);
    /*we are creating a query with the variable we have passed, and if the operation is running successfully, 
    we want it to redirect to the page with the listed data and write that the operation was successful at the status point. */
    if ($update) {
        header("location:datadelete.php?update=ok");
    } else {
        header("location:dataupdate.php?update=no");
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

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <div class="card p-5">

            <form method="POST">

                <div class="form-group">
                    <!-- we type hidden in the type section so that the id number is not changed and we make it invisible.
                    we write the id that comes with get in the value section.-->
                    <input type="hidden" value="<?php echo $_GET['user_id'] ?>" name="user_id" class="form-control">
                </div>

                <div class="form-group">
                    <label>Username</label>
                    <!-- in the extract part, we make the variable name we convert and the name of the data we want to change the same. -->
                    <input type="text" value="<?php echo $user_name ?>" name="user_name" class="form-control">
                </div>

                <div class="form-group">
                    <label>Usermail</label>
                    <!-- in the extract part, we make the variable name we convert and the name of the data we want to change the same. -->
                    <input type="email" value="<?php echo $user_mail ?>" name="user_mail" class="form-control">
                </div>

                <button type="submit" name="dataupdate" class="btn btn-primary">Update</button>

            </form>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>