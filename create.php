<?php
require_once "config.php";

$task_title = "";
$task_content = "";
$created_at = "";

$title_error = "";
$content_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = trim($_POST['task_title']);

    //validation for title
    if (empty($title)){
        $title_error = "Please enter a title";
    }else{
        $task_title = $title;
    }
    $content = trim($_POST['task_content']);
    if (empty($content)){
        $content_error = "Please enter a title";
    }else{
        $task_content = $content;
    }
    $created_at = date('Y-m-d H:i:s');
    if (!empty($title_error) && !empty($content_error)){
        $sql = "INSERT INTO tasks (task_title, task_content, created_at) VALUES (?, ?, ?)";
    }
    $sql = "INSERT INTO tasks (task_title, task_content, created_at) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($mysqli, $sql)){
        mysqli_stmt_bind_param($stmt, "sss", $task_title, $task_content, $created_at);
    }
    if (mysqli_stmt_execute($stmt)){
        header("Location: index.php");
        exit();
    }else{
        echo "Something went wrong.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-6">Create Task</h2>
                    <p>Please fill up this form</p>
                    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="POST">
                        <div class="form-group">
                            <label>Task Title</label>
                            <input type="text" name="task_title" class="form-control <?php echo (!empty($title_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $task_title; ?>">
                        </div>
                        <div class="form-group">
                            <label>Task Content</label>
                            <input type="text" name="task_content" class="form-control <?php echo (!empty($content_error)) ? 'is-invalid' : ''; ?>" value="<?php echo $task_content; ?>">
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>