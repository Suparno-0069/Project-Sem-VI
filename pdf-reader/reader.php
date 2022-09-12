<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/readerStyle.css">
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <title>E-book Viewer</title>
</head>

<body>

    <div class="top-bar">
        <span class="page-info">
            Page <span id="page-num"></span> of <span id="page-count"></span>
        </span>

    </div>
    <button class="btn" id="prev-page"> Previous Page</button>
    <canvas id="pdf-render"></canvas>
    <button class="btn" id="nxt-page"> Next Page</button>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
    <script>
        <?php include "reader-sc.php"; ?>
    </script>
</body>

</html>