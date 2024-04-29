<?php
include("task_count.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "event";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the delete button is clicked
    if(isset($_POST['delete'])) {
        $task_id = $_POST['task_id'];
        // Delete the task from the database
        $sql_delete = "DELETE FROM tasks WHERE id = '$task_id'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Task deleted successfully";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting task: " . $conn->error;
        }
    } elseif(isset($_POST['task_id'])) { // Check if task_id is set (indicating an existing task being updated)
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        // Update the task status in the database
        $sql_update = "UPDATE tasks SET status = '$status' WHERE id = '$task_id'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Task status updated successfully";
        } else {
            echo "Error updating task status: " . $conn->error;
        }
    } else { // If delete button is not clicked and task_id is not set, add new task
        // Retrieve task data from the form
        $name = $_POST['name'];
        $task = $_POST['task'];
        $start_date = $_POST['start_date'];
        $due_date = $_POST['due_date'];
        $status = $_POST['status'];

        // Handle file upload
        $target_file = '';
        if(isset($_FILES["image"])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
            if(!in_array($imageFileType, $allowed_extensions)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Check if a task with the same status exists
        $sql_check = "SELECT * FROM tasks WHERE status = '$status'";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            // Update the count of the existing status
            $row = $result->fetch_assoc();
            $count = $row['count'] + 1;
            $sql_update_count = "UPDATE tasks SET count = '$count' WHERE status = '$status'";
            if ($conn->query($sql_update_count) === TRUE) {
                echo "Task count updated successfully";
            } else {
                echo "Error updating task count: " . $conn->error;
            }
        } else {
            // Insert the task data into the tasks table
            $sql = "INSERT INTO tasks (name, task, start_date, due_date, status, image, count) VALUES ('$name', '$task', '$start_date', '$due_date', '$status', '$target_file', 1)";
            if ($conn->query($sql) === TRUE) {
                echo "New task created successfully";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }
        #backbtn {
            display: block;
            margin: 20px auto;
            width: fit-content;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="my-4">Current Tasks</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Task</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Image</th>
                <th>Action</th> <!-- New column for action -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Establish connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Retrieve existing tasks from the database
            $sql = "SELECT * FROM tasks";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["task"] . "</td>";
                    echo "<td>" . $row["start_date"] . "</td>";
                    echo "<td>" . $row["due_date"] . "</td>";
                    echo "<td><form method='post' action='" . $_SERVER['PHP_SELF'] . "'><input type='hidden' name='task_id' value='" . $row["id"] . "'><select name='status' class='form-control' onchange='this.form.submit()'><option value='pending' " . ($row['status'] == 'pending' ? 'selected' : '') . ">Pending</option><option value='completed' " . ($row['status'] == 'completed' ? 'selected' : '') . ">Completed</option><option value='overdue' " . ($row['status'] == 'overdue' ? 'selected' : '') . ">Overdue</option></select></form></td>"; // Edit status dropdown with form
                    echo "<td><img src='" . $row["image"] . "' style='max-width: 100px;' /></td>";
                    echo "<td><form method='post' action='" . $_SERVER['PHP_SELF'] . "'><input type='hidden' name='task_id' value='" . $row["id"] . "'><button type='submit' name='delete' class='btn btn-danger'>Delete</button></form></td>"; // Delete button with form
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No tasks found</td></tr>";
            }
            $conn->close(); // Close the database connection
            ?>
        </tbody>
    </table>

    <h2 class="my-4">Add New Task</h2>

    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="task">Task:</label>
                <input type="text" class="form-control" id="task" name="task" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="overdue">Overdue</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <a href="/Medcancer/admin/index.php" class="btn btn-secondary mt-3" id="backbtn">Back to admin panel</a>
</div>

</body>
</html>
