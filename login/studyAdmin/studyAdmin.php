<?php
  session_start();
  require_once('../classes/UserLogic.php');
  require_once('../functions.php');
  require_once('../securityHeaders.php');
  
  //ログインしていなければログイン画面へ移す
  $result = UserLogic::checkLogin();
  
  if(!$result){
      header('Location: ../public/login_form.php');
      exit;
  }
  $_SESSION["user_data"]["inSession"] = $_SERVER['REQUEST_URI'];
  $login_user = $_SESSION['login_user'];

  $whatPage = 'わたしの学習記録管理帳';

    require_once('config.php');
    /** 
     * PHPでは、<?php echo '〇〇'; ?>と<?= '〇〇'; ?>は同様の意味である。
     * <?= ?>と間違えて<?php (中身にechoつけてない) ?>を使ってしまわないように注意。
     * <?php ?>だけだとドキュメントに値は出力されない。
     * <?= ?>のフィールド内では、文字列（変数に格納している場合も同）どうし、或いは文字列と数値とは、.（ドット）で繋ぐことができる。
     * （これはJavaScriptの「+」にあたる）
    */
?>

<!-- このファイルがデータ一覧を表示する大元のファイルといえる -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $theme.'早見表';?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { font-family: "Sawarabi Gothic"; }
    </style>
</head>
<body>
  <h2 align="center"><?= $whatPage; ?></h2>
  <p align="center" id="dateClock"></p>
  <p align="right" class="container">ログインユーザー：<?= h($login_user['name']); ?> さん</p>
<!--  <p>メールアドレス：<?= h($login_user['email']); ?></p> -->
<br>
<form action="logout.php" method="POST">
    <p class="container" align="right"><input type="submit" name="logout" class="btn btn-info" value="ログアウト"></p>
</form>
    <div class="container" style="">
        <h3 align="center"><?= $theme.'早見表'; ?></h3>
        <a href="addData.php?=add-record" id="forAdd" class="btn btn-info"><?= $theme.'登録フォームへ';?></a><br><br>
        <div id="table_corner" class="row">
            <table id="example" class="display" style="">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>学習内容（＆範囲）</th>
                        <th>カテゴリー</th>
                        <th>フェーズ</th>
                        <th>最近の学習日</th>
                        <th>編集 / 削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once("config.php");
                        $query ="SELECT * FROM $table_1 ORDER BY laststudied DESC";
                        $sql = mysqli_query($connect,$query);
                        while($row = mysqli_fetch_array($sql))
                        {

                    ?>
                    <tr>
                        <td><input type="hidden" value="<?php echo $row["id"];?>"></td>
                        <td><?php echo $row["studiedname"];?></td>
                        <td><?php echo $row["category"];?></td>
                        <td><?php echo $row["level"];?></td>
                        <td><?php echo $row["laststudied"];?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">編集</a>
                            <a href="delete.php?id=<?php echo $row['id'];?>" class="btn btn-danger" onClick="return confirm('ホントに削除してもいいですか')">削除</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
    	    
        </div>
    </div>
</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="dateClock.js"></script>
<script type="text/javascript">
$('#example').DataTable({
        responsive: true,
        lengthChange: true,
        info: false,
        searching: true,
        paging: true,
        pagingType: "full_numbers",
        lengthMenu: [ 10, 20, 50, 100 ],
        columnDefs: [
          { targets: 0, visible: false },
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Japanese.json"
        }
    });

var h3Width = document.querySelector("h3").clientWidth;
if(h3Width < 400){
    $("#table_corner").css("margin","0 5px");
    $("#table_corner").css("max-width","400px");
    $("#table_corner").css("overflow-x","scroll");
    $("#table_corner").css("white-space","nowrap");
}
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../shortCuts.js"></script>
</body>
</html>
