<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE = edge" />
    <meta name="viewport" content="width = device-width, initial-scale = 1.0" />
    <title>طلب سيارة</title>
    <link rel="stylesheet" href="CSS/all.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/navbar.css" />
    <link rel="stylesheet" href="CSS/reqCar.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Symbols:wght@100;200;300;400;500&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<?php
include 'connect.php';
$id = '00000928';
$bid = '000';
$reqDay = Date('Y-m-d', strtotime('+2 days'));
$shownData = "SELECT SUBSTRING_INDEX(e.namea,' ',4) AS EMP_Name, s.namea AS EMP_Sub, b.namea AS EMP_Branch, g.namea AS EMP_Govern
    FROM hr_employee AS e JOIN hr_subsction AS s JOIN hr_branch AS b JOIN hr_govern AS g
    ON e.subsction_code = s.CODE AND e.current_branch = b.CODE AND b.govern_code = g.CODE
    WHERE e.code = $id AND e.branch_code = $bid";
$resultShownData = $conn->query($shownData);
if ($resultShownData->num_rows > 0) {
    $rowSD = $resultShownData->fetch_assoc();
}
$querySerial = "SELECT max(serial) as serial FROM erm_requsts WHERE request_type_code = '019' ";
$resultSerial = $conn->query($querySerial);
if ($resultSerial->num_rows > 0) {
    $rowSerial = $resultSerial->fetch_assoc();
}
if (isset($_POST['carReq'])) {
    if (empty($_POST['goTo']) || empty($_POST['goFrom']) || empty($_POST['dateTo']) || empty($_POST['dateFrom']) || empty($_POST['quan'])) {
        header('Location:reqCar.php');
        exit;
    } else {
        $rowSerial['serial']++;
        $goTo = htmlspecialchars($_POST['goTo']);
        $goFrom = htmlspecialchars($_POST['goFrom']);
        $dateTo = htmlspecialchars($_POST['dateTo']);
        $dateFrom = htmlspecialchars($_POST['dateFrom']);
        $quan = htmlspecialchars($_POST['quan']);
        $reason = htmlspecialchars($_POST['reason']);
        $sendData = "INSERT INTO erm_requsts (serial, request_type_code,emp_branch_code,emp_code,num_field1,date_field1,date_field2,txt_field1,txt_field2,txt_field3)
    VALUES ('$rowSerial[serial]','019','$bid','$id','$quan','$dateFrom','$dateTo','$goTo','$goFrom','$reason')";
        $resultsendData = $conn->query($sendData);
        if (($resultsendData)) {
            echo
            "<script> alert('لقد تمت العملية بنجاح');
                window.location.href = 'reqCar.php'
            </script>";
            exit();
        } else {
            echo  "<script> alert('برجاء المحاولة في وقت لاحق') </script>";
        }
    }
}
$conn->close();
?>

<body>
    <div class="navbar">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon"><i class="fa-solid fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="reqCar.php">طلب سيارة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="showCarReq.php">عرض طلبات السيارة</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                السيارات
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="assignCar.php">تسجيل سيارة</a></li>
                                <li><a class="dropdown-item" href="showCar.php">معرض السيارات</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <h3 class="title">نموذج طلب سيارة</h3>
    <div class="container form_data">
        <form autocomplete="off" class=" form" id="req" action="reqCar.php" method="POST">
            <div class="contained row col-12">
                <span class="centered titled">بيانات مقدم الطلب</span>
                <br />
                <div class="col-lg-3 col-sm-12">
                    <label>الإسم:</label>
                    <span> <?php echo $rowSD["EMP_Name"] ?> </span>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label>الوظيفة:</label>
                    <span> <?php echo $rowSD["EMP_Sub"] ?> </span>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label>الفرع:</label>
                    <span> <?php echo $rowSD["EMP_Branch"] ?> </span>
                </div>
                <div class="col-lg-3 col-sm-12">
                    <label>المحافظة:</label>
                    <span> <?php echo $rowSD["EMP_Govern"] ?> </span>
                </div>
            </div>
            <hr />
            <span class="titled moved">بيانات الطلب</span>
            <hr />
            <label class="required down">الذهاب</label>
            <br />
            <label>من:</label>
            <input type="text" name="goFrom" autofocus />
            <br>
            <label>الى:</label>
            <input type="text" name="goTo" />
            <br />
            <label class="required down">التاريخ</label>
            <br />
            <label>من:</label>
            <input type="date" name="dateFrom" id="dateFrom" min='<?php echo $reqDay; ?>' onchange="myFunction()" />
            <span id="dayAlert"></span>
            <br>
            <label>الى: </label>
            <input type="date" name="dateTo" id="dateTo" min='<?php echo $reqDay; ?>' onchange="myFunction()" />
            <span id="dayAlert1"></span>
            <br>
            <label class="required">عدد الأشخاص:</label>
            <input id="sizedInput" type="number" name="quan" min="1" max="15" />
            <br />
            <label class="sized">السبب:</label>
            <textarea name="reason" cols="40" rows="5" form="req"></textarea>
            <br />
            <input class="btn send_btn" type="submit" value="ارسال" name="carReq" />
        </form>
    </div>
    <script src="JS/reqCar.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
</body>

</html>