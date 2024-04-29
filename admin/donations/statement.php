<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Usage Summary</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h2 class="my-4">Donation Usage Summary</h2>
    <div class="row">
        <div class="col-md-6">
            <h4>Add Monthly Record</h4>
            <form id="monthlyRecordForm">
                <div class="form-group">
                    <label for="monthSelect">Select Month:</label>
                    <select class="form-control" id="monthSelect">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="January">April</option>
                        <option value="February">May</option>
                        <option value="March">June</option>
                        <option value="January">July</option>
                        <option value="February">August</option>
                        <option value="March">September</option>
                        <option value="January">October</option>
                        <option value="February">November</option>
                        <option value="March">December</option>
                        <!-- Add options for other months -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="yearInput">Year:</label>
                    <input type="number" class="form-control" id="yearInput" placeholder="Enter Year">
                </div>
                <div class="form-group">
                    <label for="amountInput">Amount Used ($):</label>
                    <input type="number" class="form-control" id="amountInput" placeholder="Enter Amount">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Monthly Records</h4>
            <ul id="monthlyRecordsList" class="list-group">
                <!-- Monthly records will be displayed here -->
            </ul>
        </div>
    </div>

    <!-- Donation Receipt Records -->
    <div class="row mt-4">
        <div class="col-md-6">
            <h4>Add Donation Receipt Record</h4>
            <form id="donationReceiptForm">
                <div class="form-group">
                    <label for="donationMonthSelect">Select Month:</label>
                    <select class="form-control" id="donationMonthSelect">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="January">April</option>
                        <option value="February">May</option>
                        <option value="March">June</option>
                        <option value="January">July</option>
                        <option value="February">August</option>
                        <option value="March">September</option>
                        <option value="January">October</option>
                        <option value="February">November</option>
                        <option value="March">December</option>
                        <!-- Add options for other months -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="donationYearInput">Year:</label>
                    <input type="number" class="form-control" id="donationYearInput" placeholder="Enter Year">
                </div>
                <div class="form-group">
                    <label for="donationAmountInput">Donation Amount ($):</label>
                    <input type="number" class="form-control" id="donationAmountInput" placeholder="Enter Amount">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Donation Receipt Records</h4>
            <ul id="donationReceiptList" class="list-group">
                <!-- Donation receipt records will be displayed here -->
            </ul>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Load saved monthly records when the page loads
        loadMonthlyRecords();
        loadDonationReceipts();

        // Submit monthly record form
        $('#monthlyRecordForm').submit(function(event) {
            event.preventDefault();
            var month = $('#monthSelect').val();
            var year = $('#yearInput').val();
            var amount = $('#amountInput').val();
            if (month && year && amount) {
                saveMonthlyRecord(month, year, amount);
            } else {
                alert('Please fill in all fields.');
            }
        });

        // Submit donation receipt form
        $('#donationReceiptForm').submit(function(event) {
            event.preventDefault();
            var month = $('#donationMonthSelect').val();
            var year = $('#donationYearInput').val();
            var amount = $('#donationAmountInput').val();
            if (month && year && amount) {
                saveDonationReceipt(month, year, amount);
            } else {
                alert('Please fill in all fields.');
            }
        });
    });

    function saveMonthlyRecord(month, year, amount) {
        // Save monthly record to localStorage
        var monthlyRecord = { month: month, year: year, amount: amount };
        var monthlyRecords = JSON.parse(localStorage.getItem('monthlyRecords')) || [];
        monthlyRecords.push(monthlyRecord);
        localStorage.setItem('monthlyRecords', JSON.stringify(monthlyRecords));
        // Reload monthly records list
        loadMonthlyRecords();
        // Clear form fields
        $('#monthSelect').val('');
        $('#yearInput').val('');
        $('#amountInput').val('');
    }

    function saveDonationReceipt(month, year, amount) {
        // Save donation receipt to localStorage
        var donationReceipt = { month: month, year: year, amount: amount };
        var donationReceipts = JSON.parse(localStorage.getItem('donationReceipts')) || [];
        donationReceipts.push(donationReceipt);
        localStorage.setItem('donationReceipts', JSON.stringify(donationReceipts));
        // Reload donation receipt list
        loadDonationReceipts();
        // Clear form fields
        $('#donationMonthSelect').val('');
        $('#donationYearInput').val('');
        $('#donationAmountInput').val('');
    }

    function loadMonthlyRecords() {
        // Load monthly records from localStorage and display in the list
        var monthlyRecords = JSON.parse(localStorage.getItem('monthlyRecords')) || [];
        var monthlyRecordsList = $('#monthlyRecordsList');
        monthlyRecordsList.empty();
        monthlyRecords.forEach(function(record, index) {
            var listItem = $('<li class="list-group-item"></li>').text(`${record.month} ${record.year}: $${record.amount}`);
            var deleteButton = $('<button class="btn btn-danger btn-sm ml-2">Delete</button>').click(function() {
                deleteMonthlyRecord(index);
            });
            listItem.append(deleteButton);
            monthlyRecordsList.append(listItem);
        });
    }

    function loadDonationReceipts() {
        // Load donation receipt records from localStorage and display in the list
        var donationReceipts = JSON.parse(localStorage.getItem('donationReceipts')) || [];
        var donationReceiptsList = $('#donationReceiptList');
        donationReceiptsList.empty();
        donationReceipts.forEach(function(record, index) {
            var listItem = $('<li class="list-group-item"></li>').text(`${record.month} ${record.year}: $${record.amount}`);
            var deleteButton = $('<button class="btn btn-danger btn-sm ml-2">Delete</button>').click(function() {
                deleteDonationReceipt(index);
            });
            listItem.append(deleteButton);
            donationReceiptsList.append(listItem);
        });
    }

    function deleteMonthlyRecord(index) {
        var monthlyRecords = JSON.parse(localStorage.getItem('monthlyRecords')) || [];
        monthlyRecords.splice(index, 1);
        localStorage.setItem('monthlyRecords', JSON.stringify(monthlyRecords));
        loadMonthlyRecords();
    }

    function deleteDonationReceipt(index) {
        var donationReceipts = JSON.parse(localStorage.getItem('donationReceipts')) || [];
        donationReceipts.splice(index, 1);
        localStorage.setItem('donationReceipts', JSON.stringify(donationReceipts));
        loadDonationReceipts();
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












                       
