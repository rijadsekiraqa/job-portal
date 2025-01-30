<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Review</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info text-center" role="alert">
            <h4 class="alert-heading">Llogaria juaj është në shqyrtim</h4>
            <p>Faleminderit për durimin tuaj.Llogaria juaj aktualisht po shqyrtohet nga ekipi ynë. Ju lutemi prisni derisa t'ju caktohet një rol.</p>
            <hr>
            <p class="mb-3">Ju lutem provoni perseri me vone.</a>.</p>
            <!-- Buttons Section -->
            <div class="d-flex justify-content-center gap-2">
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Dil</button>
                </form>
                <!-- Back to Login Button -->
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
