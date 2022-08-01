<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="public/style/properties.css">
    <link rel="stylesheet" href="public/style/searchResults.css">
    <link rel="stylesheet" href="public/style/profile.css">
    <link rel="stylesheet" href="public/style/signUp.css">
    <link rel="stylesheet" href="public/style/modal.css">
    <link rel="stylesheet" href="public/style/indexView.css">
    <link rel="stylesheet" href="public/style/header.css">
    <link rel="stylesheet" href="public/style/footer.css">
    <link rel="stylesheet" href="public/style/postProperty.css">
    <link rel="stylesheet" href="public/style/bookingCalendar.css">
    <link rel="stylesheet" href="public/style/nouislider.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300&family=Montserrat:wght@300&family=Quicksand:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/style/reservations.css">
    <link rel="stylesheet" href="cancellationModal.css">
    <script src="https://kit.fontawesome.com/949df75f70.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.0/dist/index.umd.min.js"></script>


</head>

<body class="flexColumn">
    <?php require "header.php"; ?>
    <?= $content; ?>
    <?php require "footer.php"; ?>
</body>

</html>