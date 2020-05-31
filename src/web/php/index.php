<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
    <title>書福</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<?php
    session_start();  // 啟用交談期
    $kw = "";
    if( isset($_POST['kw'])){
        $kw =  $_POST['kw'];
        if($kw != ""){  //Search
            // echo "<a href=""></a>";
            // $search = "search.php?kw".$kw;
            // header("Location: $search");
        }
        else{   //  useless
            echo '<script language="javascript">';
            echo 'alert("請輸入關鍵字");';
            echo '</script>';
        }
    }
?>
<?php
    // 建立MySQL的資料庫連接 
    $dsn = "mysql:dbname=bookstore;host=220.132.211.121;port=3306";
    $username = "ZYS";
    $pass = "qwe12345";
    try {
        // 建立MySQL伺服器連接和開啟資料庫 
        $link = new PDO($dsn, $username, $pass);
        // 指定PDO錯誤模式和錯誤處理
        $link->setAttribute(PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "連接失敗: " . $e->getMessage();
    }

?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <div id="header" class="text-center">
        <a class="col-6" href=".\index.php" style="color: rgb(203, 212, 209); font-size: 1.2cm; font-weight: 500;">書福</a>
    </div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="nav-link" href=".\index.php">首頁 <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href=".\cart.php"> 購物車 <span class="sr-only">(current)</span></a>
                </li>
                <li>
                    <form class="form-inline" action=".\search.php">
                        <input class="form-control mr-sm-2" type="text" id="kw" name="kw" placeholder="Search" required>
                        <a class="btn btn-outline-success my-2 my-sm-0" href=".\search.php" role="button">
                            搜尋</a>
                    </form>
                </li>
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <a class="btn btn-outline-success my-2 my-sm-0" href=".\signup.php" role="button">
                    註冊</a>
            </form>
            <form class="form-inline mt-2 mt-md-0">
                <a class="btn btn-outline-success my-2 my-sm-0" href=".\login.php" role="button">
                    登入</a>
            </form>
        </div>
    </nav>
    <br><br>
    <h4 align="center" style=font-weight:bold;>推薦</h4>
    <div align="center" class="container bg-dark text-white">
        <?php
            $numbers = range (1,20);
            //shuffle 將陣列順序隨即打亂
            shuffle ($numbers);
            //array_slice 取該陣列中的某一段
            $num=11;
            $product = array_slice($numbers,0,$num);
            for ($i=0; $i < 10; $i++) { 
                $pid = $product[$i];
                $sql = "SELECT * FROM product WHERE ID = $pid";
                $link->query('SET NAMES utf8');
                // 送出查詢的SQL指令
                if ( $result = $link->query($sql) ) { 
                // 取得記錄數
                    $total_records = $result->rowCount();
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    echo "<div class='col-sm-4'>";
                    echo "<br>".$row['Name']."<br>";
                    echo "<div  class='card'>";
                    echo '<br><a href=".\product.php?pid='.$pid.'"><img  align="center" src="../product_img/'.$pid.'.jpg" width = "255" height = "300"></a>';
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</body>
</html>