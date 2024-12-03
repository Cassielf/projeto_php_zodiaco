<link rel="stylesheet" href="assets/css/style.css">

<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <h1 class="text-center">Qual é o seu signo?</h1>
    <p class="text-center">Informe sua data de nascimento para descobrir.</p>
    <form id="signo-form" method="POST" action="show_zodiac_sign.php" class="mt-5">
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" required>
        </div>
        <div class="d-grid gap-2 col-2 mx-auto">
            <button type="submit" class="btn btn-dark w-100">Descobrir Signo</button>
        </div>
    </form>
</div>
<?php include('layouts/footer.php'); ?>
</body>
</html>
