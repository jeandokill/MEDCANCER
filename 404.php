<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .logo {
            margin-bottom: 30px;
        }
        .error-container {
            text-align: center;
        }
        .error-title {
            font-size: 6rem;
            margin-bottom: 20px;
            color: #dc3545; /* Red color */
        }
        .error-text {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #6c757d; /* Gray color */
        }
        .btn-go-home {
            font-size: 1.2rem;
            padding: 10px 20px;
            background-color: #007bff; /* Blue color */
            border: none;
            border-radius: 5px;
            color: #fff; /* White color */
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-go-home:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }
    </style>
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="/Medcancer/Home/assets/img/FAVICON.JPG">
</head>
<body style="background-color:black;">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6 text-center error-container">
                <img style="width: 150px;" src="/Medcancer/Home/assets/img/FAVICON.JPG" alt="Logo" class="logo">
                <h1 class="display-1 error-title">404</h1>
                <p class="lead error-text">Oops! Page not found.</p>
                <a href="/Medcancer/Home/index.php" class="btn btn-go-home">Go Home</a>
            </div>
        </div>
    </div>
</body>
</html>
