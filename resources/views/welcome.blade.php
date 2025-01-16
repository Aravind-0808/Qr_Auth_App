<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Verification App</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Student Verification</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-primary ms-2" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4 fw-bold text-primary">Welcome to the Student Verification App</h1>
            <p class="lead text-secondary mt-3">
                Simplify and secure student verification processes with our reliable platform.
            </p>
            <a href="/login" class="btn btn-primary btn-lg mt-4 me-2">Get Started</a>
            <a href="/register" class="btn btn-outline-primary btn-lg mt-4">Learn More</a>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container py-5">
        <h2 class="text-center text-primary mb-4">Why Choose Us?</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="p-3">
                    <i class="bi bi-lock-fill text-primary fs-1"></i>
                    <h4 class="mt-3">Secure</h4>
                    <p>Data privacy and security are our top priorities.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="p-3">
                    <i class="bi bi-speedometer2 text-primary fs-1"></i>
                    <h4 class="mt-3">Fast</h4>
                    <p>Quick verification with QR code scanning.</p>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="p-3">
                    <i class="bi bi-people-fill text-primary fs-1"></i>
                    <h4 class="mt-3">Reliable</h4>
                    <p>Trusted by educational institutions worldwide.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white text-center py-3">
        <p>&copy; 2025 Student Verification App. All rights reserved.</p>
    </footer>

    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
