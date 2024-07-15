<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "UTF-8" />
    <meta http-equiv = "X-UA-Compatible" content = "IE = edge" />
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0" />
    <title>تسجيل سيارة</title>
    <link rel = "stylesheet" href = "CSS/all.min.css" />
    <link rel = "stylesheet" href = "CSS/bootstrap.min.css" />
    <link rel = "stylesheet" href = "CSS/normalize.css" />
    <link rel = "stylesheet" href = "CSS/navbar.css" />
    <link rel = "stylesheet" href = "CSS/assignCar.css" />
    <link rel = "preconnect" href = "https://fonts.googleapis.com">
    <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
    <link href = "https://fonts.googleapis.com/css2?family=Noto+Sans+Symbols:wght@100;200;300;400;500&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel = "stylesheet">
</head>

<?php
include 'connect.php';
if (isset($_POST['carAssign']) && !empty(['carModel']) && !empty(['carNo']) && !empty(['quan'])) {
    $carModel = htmlspecialchars($_POST['carModel']);
    $carNo = htmlspecialchars($_POST['carNo']);
    $capacity = htmlspecialchars($_POST['quan']);
    $sendData = "INSERT INTO err_cars (car_model,car_no,car_capacity)
    VALUES ('$carModel','$carNo','$capacity')";
    $resultsendData = $conn->query($sendData);
    if (($resultsendData)) {
        echo
        "<script> alert('لقد تمت العملية بنجاح') 
        window.location.href = 'assignCar.php'
    </script>";
        exit();
    } else {
        echo  "<script> alert('برجاء المحاولة في وقت لاحق') </script>";
    }
}
$conn->close();
?>

<body>

    <div class = "navbar">
        <nav class = "navbar navbar-expand-lg">
            <div class = "container">
                <a class = "navbar-brand" href = "#"></a>
                <button class = "navbar-toggler" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navbarSupportedContent" aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
                    <span class = "icon"><i class = "fa-solid fa-bars"></i></span>
                </button>
                <div class = "collapse navbar-collapse" id = "navbarSupportedContent">
                    <ul class = "navbar-nav me-auto mb-2 mb-lg-0">
                        <li class = "nav-item">
                            <a class = "nav-link" aria-current = "page" href = "reqCar.php">طلب سيارة</a>
                        </li>
                        <li class = "nav-item">
                            <a class = "nav-link " aria-current = "page" href = "showCarReq.php">عرض طلبات السيارة</a>
                        </li>
                        <li class = "nav-item dropdown">
                            <a class = "nav-link dropdown-toggle" href = "#" role = "button" data-bs-toggle = "dropdown" aria-expanded = "false">
                                السيارات
                            </a>
                            <ul class = "dropdown-menu">
                                <li><a class = "dropdown-item" href = "assignCar.php">تسجيل سيارة</a></li>
                                <li><a class = "dropdown-item" href = "showCar.php">معرض السيارات</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <h3 class = "title">نموذج تسجيل سيارة</h3>
    <div class = "container form_data">
        <div class = "form">
            <form class = "form" name = "reqForm" id = "req" action = "assignCar.php" method = "POST">
                <br>
                <label class = "required">نوع السيارة:</label>
                <input type = "text" name = "carModel" autofocus />
                <br />
                <label class = "required">رقم السيارة:</label>
                <input type = "text" name = "carNo" />
                <br />
                <label class = "required" for = "">السعة:</label>
                <input id = "sizedInput" type = "number" name = "quan" min = "1" max = "15" />
                <br />
                <br />
                <input class = "btn send_btn" type = "submit" value = "تسجيل" name = "carAssign" />
            </form>
        </div>
    </div>
    <script src = "JS/assignCar.js"></script>
    <script src = "JS/bootstrap.bundle.min.js"></script>
</body>

</html>