<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>السيارات</title>
    <link rel="stylesheet" href="CSS/all.min.css" />
    <link rel="stylesheet" href="CSS/bootstrap.min.css" />
    <link rel="stylesheet" href="CSS/normalize.css" />
    <link rel="stylesheet" href="CSS/navbar.css" />
    <link rel="stylesheet" href="CSS/showCar.css" />
    <link rel="stylesheet" href="CSS/showModal.css" />
    <script src="https://kit.fontawesome.com/54008e4028.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Symbols:wght@100;200;300;400;500&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

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
    <h3 class="title">معرض السيارات</h3>
    <div class="container form-data">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class='col-1'>م</th>
                        <th class='col-3'>اسم السيارة:</th>
                        <th class='col-2'>رقم السيارة:</th>
                        <th class='col-1'>سعة السيارة:</th>
                        <th class='col-2'>تحكم</th>
                    </tr>
                </thead>
                <?php
                include 'connect.php';
                $sequence = 1;
                $shownData = "SELECT * FROM err_cars";
                $resultShownData = $conn->query($shownData);
                if (!$resultShownData) {
                    die("Error getting data from database" . $connection->error);
                }
                while ($row = $resultShownData->fetch_assoc()) {
                    echo "
                                <tbody>
                                <tr>
    <td>" . $sequence . "</td>
    <td>" . $row['car_model'] . "</td>
    <td>" . $row['car_no'] . "</td>
    <td>" . $row['car_capacity'] . "</td>    
    <td> 
    <span class='icons'>
        <a href='editCar.php?ID=" . $row['ID'] . "'> <i class='fa-solid fa-pen-to-square edit'></i></a>
        <a href='showCar.php?Confirmation=TRUE&ID=" . $row['ID'] . "'><i class='fa-solid fa-ban open_modal'></i></a>
    </span>
    </td>
            </tr>
            </tbody>";
                    $sequence++;
                }
                if (isset($_GET["ID"])) {
                    $ID = $_GET["ID"];
                }
                if (isset($_GET["ID"]) && isset($_GET["Confirmation"]) && $_GET["Confirmation"] == 'TRUE') {
                    echo "
            <div id='myModal' class='modal d-block' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-body text-center'>
                            <p>هل انت متأكد من حذف السيارة؟</p>
                        </div>
                        <div class='modal-footer'>
                            <a href='showCar.php'>
                                <i class='fa-solid fa-circle-xmark'></i>
                            </a>
                            <a href='showCar.php?DELETED=DELETE&ID=$ID'>
                                <i class='fa-solid fa-circle-check'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            ";
                }
                if (isset($_GET["ID"]) && isset($_GET["DELETED"]) && $_GET["DELETED"] == 'DELETE') {
                    $deleteData = " DELETE FROM err_cars WHERE ID = $ID ";
                    $resultDeleteData = $conn->query($deleteData);
                    if (($resultDeleteData)) {
                        echo
                        "<script>
                alert('لقد تمت العملية بنجاح')
                window.location.href = 'showCar.php'
            </script>";
                        exit();
                    } else {
                        echo "<script>
                alert('برجاء المحاولة في وقت لاحق')
            </script>";
                    }
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
    <script src="JS/bootstrap.bundle.min.js"></script>
</body>

</html>