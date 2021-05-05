<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>

        .wrapper {
            width: 800px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 200px;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class ="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Task Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Task</a>
                    </div>
                    <?php
                    require_once "config.php";
                    $sql = "SELECT * from tasks WHERE deleted_at IS NULL";
                    if ($result = $mysqli->query($sql)){
                        if ($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead>';
                                echo '<tr>';
                                    echo '<th>#</th>';
                                    echo '<th>Task Tile</th>';
                                    echo '<th>Task Content</th>';
                                    echo '<th>Task Created</th>';
                                echo '</tr>';
                            echo '</thead>';
                            while ($row = $result->fetch_array()){
                                echo '<tr>';
                                    echo '<td>' . $row["id"] . '</td>';
                                    echo '<td>' . $row["task_title"] . '</td>';
                                    echo '<td>' . $row["task_content"] . '</td>';
                                    echo '<td>';
                                    echo '<a href="readtask.php?id='.$row["id"].'" class="mr-3" title="View Task" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="updatetask.php?id='.$row["id"].'" class="mr-3" title="Update Task" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="deletetask.php?id='.$row["id"].'" class="mr-3" title="Delete Task" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo '</td>';
                                echo '</tr>';
                            }
                            echo "</tbody>";
                            echo "</table>";
                            $result->free();
                        }else{
                            echo '<div class="alert alert-danger"><em>No tasks found</em></div>';
                        }
                    }else{
                        echo "Something went wrong. Please try again.";
                    }
                    $mysqli->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>