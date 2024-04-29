<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grant Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="my-4">Grant Management</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Sponsor</th>
                <th>Channel</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="grantTableBody">
            <!-- Existing rows and dynamically added rows will be placed here -->
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" onclick="addGrant()">Add Grant</button>
</div>

<!-- Bootstrap Modal for PIN Verification -->
<div class="modal fade" id="pinModal" tabindex="-1" role="dialog" aria-labelledby="pinModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pinModalLabel">Enter PIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="password" class="form-control" id="pinInput" placeholder="Enter PIN">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="verifyPIN()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Load data from localStorage when the page loads
    window.onload = function() {
        var savedData = localStorage.getItem('grantData');
        if (savedData) {
            document.getElementById('grantTableBody').innerHTML = savedData;
        }
    };

    function addGrant() {
        var tbody = document.getElementById('grantTableBody');
        var rowCount = tbody.rows.length;

        var newRow = tbody.insertRow(rowCount);
        newRow.innerHTML = `
            <td>${rowCount + 1}</td>
            <td contenteditable="true">2024-02-01</td>
            <td contenteditable="true">Sponsor</td>
            <td contenteditable="true">Channel</td>
            <td contenteditable="true">$0</td>
            <td class="actions-cell">
                <button class="btn btn-danger delete-button" onclick="verifyAction(this, 'delete')">Delete</button>
            </td>
        `;

        saveGrantData(); // Save grant data after adding a new row
    }

    function deleteGrant(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);
        saveGrantData();
    }

    function verifyAction(element, action) {
        $('#pinModal').modal('show');
        $('#pinModal').data('action', action);
        $('#pinModal').data('element', element);
    }

    function verifyPIN() {
        var pinInput = document.getElementById('pinInput').value;
        if (pinInput === '2021') {
            var action = $('#pinModal').data('action');
            var element = $('#pinModal').data('element');

            if (action === 'delete') {
                deleteGrant(element);
            }

            $('#pinModal').modal('hide');
        } else {
            // If PIN is incorrect, do not perform the action
            $('#pinModal').modal('hide');
            alert('Incorrect PIN. You are not allowed to perform this action.');
        }
    }

    function saveGrantData() {
        // Save the updated grant data to localStorage
        localStorage.setItem('grantData', document.getElementById('grantTableBody').innerHTML);
    }
</script>

<a href="/Medcancer/admin/index.php" class="btn btn-secondary mt-3" id="backbtn">Back to admin panel</a>
        <style>
            #backbtn
             {
                display: block;
                margin: auto;
                margin-top: 20px; 
                margin-right: 50%;
                margin-left: 30%;
                background-color: blue;
                
                /* You can adjust the margin-top as needed */
            }
        </style>
    </div>

</body>
</html>
