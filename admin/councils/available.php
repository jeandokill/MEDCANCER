<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Councils</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Available Councils</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profile Picture</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection file
                    include_once "db_connect.php";

                    // SQL query to fetch all available councils
                    $sql = "SELECT * FROM councils";

                    // Execute the query
                    $result = mysqli_query($conn, $sql);

                    // Check if there are any councils available
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>"; // Add ID column
                            echo "<td><img src='" . $row["profilePicture"] . "' alt='" . $row["firstName"] . "' class='img-fluid rounded' style='max-width: 100px; max-height: 100px;'></td>";
                            echo "<td class='firstName'>" . $row["firstName"] . " " . $row["lastName"] . "</td>";
                            // Add more table cells for other council information as needed
                            echo "<td>
                                <a href='view_councils.php?id=" . $row["id"] . "' class='btn btn-sm btn-info viewBtn'><i class='fas fa-eye'></i></a>
                                <a href='edit_councils.php?id=" . $row["id"] . "' class='btn btn-sm btn-primary editBtn'><i class='fas fa-edit'></i></a>
                                <a href='delete_council.php?id=" . $row["id"] . "' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></a>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        // If no councils are available
                        echo "<tr><td colspan='4'>No available councils.</td></tr>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript to handle the click event on the edit icon and populate the modal with council information
        $(document).on('click', '.editBtn', function () {
            // Get the council's information from the table
            var firstName = $(this).closest('tr').find('.firstName').text();
            var lastName = firstName.split(' ').pop(); // Get last name
            firstName = firstName.replace(' ' + lastName, ''); // Get first name
            // Populate the modal input fields with the council's information
            $('#editFirstName').val(firstName);
            $('#editLastName').val(lastName);
            // Show the modal
            $('#editCouncilModal').modal('show');
        });
    </script>
</body>

</html>
