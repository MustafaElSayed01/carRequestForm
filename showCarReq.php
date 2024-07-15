<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>عرض طلب السيارة</title>
    <link rel="stylesheet" href="CSS/all.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/navbar.css" />
    <link rel="stylesheet" href="CSS/showCarReq.css" />
    <script src="https://kit.fontawesome.com/54008e4028.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Symbols:wght@100;200;300;400;500&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<?php
include 'connect.php';
$id = '00000928';
$bid = '000';
$shownData = "SELECT SUBSTRING_INDEX(e.namea,' ',4) AS EMP_Name, s.namea AS EMP_Sub, b.namea AS EMP_Branch, g.namea AS EMP_Govern, er.emp_branch_code AS BID, er.emp_code AS ID, er.num_field1 AS Cap, er.date_field1 AS Since, er.date_field2 AS Till, er.txt_field1 AS fromCity, er.txt_field2 AS toCity, er.txt_field3 AS Comment
FROM hr_employee AS e JOIN hr_subsction AS s JOIN hr_branch AS b JOIN hr_govern AS g JOIN erm_requsts AS er 
ON e.subsction_code = s.CODE AND e.current_branch = b.CODE AND b.govern_code = g.CODE 
WHERE e.code = $id AND e.branch_code = $bid AND er.request_type_code = '019'";
$resultShownData = $conn->query($shownData);
if ($resultShownData->num_rows > 0) {
    $rowSD = $resultShownData->fetch_assoc();
}
if (isset($_GET["pickCar"]) && $_GET["pickCar"] == 'true') {
                            echo "
            <div id='myModal' class='modal d-block' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body text-center'>
                            <p>اختر السياره المناسبة</p>
                        </div>
                        <div class='modal-footer'>
                            <a href='showCarReq.php'>
                                <i class='fa-solid fa-circle-xmark'></i>
                            </a>
                            <a href='showCarReq.php?confirm=true'>
                                <i class='fa-solid fa-circle-check'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            ";
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
                            <a class="nav-link " aria-current="page" href="reqCar.php">طلب سيارة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="showCarReq.php">عرض طلبات السيارة</a>
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
    <h3 class="title">طلب سيارة</h3>
    <div class="container form_data">
        <div class="form">
            <form class="form" id="req" action="reqCar.php" method="POST" onsubmit="return validateForm()">
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
                <label class=" down">الذهاب</label>
                <br />
                <label>من:</label>
                <span><?php echo $rowSD["fromCity"] ?> </span>
                <label>الى:</label>
                <span><?php echo $rowSD["toCity"] ?> </span>
                <br />
                <label class="down">التاريخ</label>
                <br />
                <label>من:</label>
                <span><?php echo $rowSD["Since"] ?> </span>
                <label>الى: </label>
                <span><?php echo $rowSD["Till"] ?> </span>
                <br>
                <label>عدد الأشخاص: </label>
                <span><?php echo $rowSD["Cap"] ?> </span>
                <br />
                <label>السبب: </label>
                <span><?php echo $rowSD["Comment"] ?> </span>
                <hr>
                <span class="icons">
                    <a href="showCarReq.php?pickCar=true"> <i class="fa-solid fa-check accept"></i></a>
                    <a href=""> <i class="fa-solid fa-xmark refuse"></i></a>
                </span>
            </form>
        </div>
    </div>
    <script src="JS/bootstrap.bundle.min.js"></script>
</body>

</html>