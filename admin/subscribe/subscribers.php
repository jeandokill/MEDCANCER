<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <title>Subscribers</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Subscribers</h2>
        <form action="sendmail.php" method="post" id="emailForm" enctype="multipart/form-data">
            <div class="form-group">
                <label for="selectAll">Select All</label>
                <input type="checkbox" id="selectAll">
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Fetch subscribers from the database
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "newsletter";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT id, email FROM subscribers";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["email"]. "</td><td><input type='checkbox' name='selected[]' value='" . $row["email"]. "' class='emailCheckbox'></td></tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <!-- Add email title, subject, message, and attachment fields -->
            <div class="form-group">
                <label for="emailTitle">Email Title</label>
                <input type="text" class="form-control" id="emailTitle" name="emailTitle">
            </div>
            
            <div class="form-group">
                <label for="emailMessage">Email Message</label>
                <textarea class="form-control" id="emailMessage" rows="5" name="emailMessage"></textarea>
            </div>
            <div class="form-group">
                <label for="attachment">Attachment</label>
                <input type="file" class="form-control-file" id="attachment" name="attachment">
            </div>
            <button type="submit" class="btn btn-primary" onclick="prepareEmailList()">Send Email</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#selectAll').change(function() {
                $('.emailCheckbox').prop('checked', $(this).prop('checked'));
            });
        });

        function prepareEmailList() {
            var selectedEmails = [];
            $('.emailCheckbox:checked').each(function() {
                selectedEmails.push($(this).val());
            });
            $('#emailForm').append('<input type="hidden" name="selectedEmails" value="' + selectedEmails.join(',') + '">');
        }
    </script>
</body>
</html>
