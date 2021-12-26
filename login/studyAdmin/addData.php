<?php 
session_start();
require_once("config.php");
require_once("../securityHeaders.php");
?>
<?php
    if(isset($_POST["submit"]))
    { /* 下のname="submit"のボタンを押すと次のSQL処理が為される */
    	//post all value
    	extract($_POST);
    	$query = "INSERT INTO $table_1 (`studiedname`, `category`, `level`, `laststudied`) VALUES ('".$studiedname."', '".$category."', '".$level."', '".$laststudied."' );";
    	/* idが「Auto Increment」になっている為、SQL構文の中に入れてしまう（値にNULLを指定する等）とエラーになるぞ！ */

    	mysqli_query($connect,$query); /* $connectの中に$queryのデータを格納する */
    	header("location:studyAdmin.php"); /* 終了後にどこのファイルに遷移するか */
    }

?>

<html>
<head>
	<title><?= $theme.'登録';?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        .form-inline {
            border-radius: 5px;
            padding-left: 5px;
            background-color: #EEEEEE;
        }
        .info:hover{
            cursor: pointer;
            color: blue;
            font-weight: 600;
        }
        #level {
          width: 10%;
          background-color: white;
        }
    </style>
</head>

<body onload="start()">
	<div class="container" style="">
	<div class="row">
    <h3><?= $theme.'登録フォーム';?></h3>
    <h4><b style="color: red;"></b></h4>
	<div class="container"> 
    	<p><a href="studyAdmin.php?=data-list" id="forIndex" class="btn btn-info"><?= $theme; ?>参照</a></p><br>

			<p>
				<button type="button" class="btn btn-warning" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					検索テーブルを開く／検索テーブルを閉じる
				</button>
			</p>
			
    	<!-- アコーディオンエリア -->
    	<div class="collapse container" id="collapseExample">
            <div class="row col-sm-5">
              <table id="categoryList" class="display table table-striped" style="">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>カテゴリー</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  /**
                   * データテーブルによるstudiednameカラム検索機能
                   */
                      require_once("config.php");
                      $query ="SELECT DISTINCT category FROM $table_1 ORDER BY category ASC";
                      $sql = mysqli_query($connect,$query);
                      while($row = mysqli_fetch_array($sql))
                      {
    
                  ?>
                  <tr>
                    <td><input type="hidden" value="<?php echo $row["id"];?>"></td>
                    <td><span class="info"><?php echo $row["category"];?></span></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
    	</div>
    	<!-- アコーディオンエリアここまで -->
        <br>
            <form action="" method="post">
                  <br>
                  <label title="Alt+Shift+N でこのテキストボックスにフォーカスします。">学習内容（＆範囲） </label>
                  <input type="text" class="form-control" name="studiedname" id="studiedname" placeholder="学習内容（＆範囲）を入力して下さい。" autocomplete="off" required><br>
                  <label>カテゴリー </label>
                  <input type="text" class="form-control" name="category" id="category" placeholder="学習事項のカテゴリーを入力して下さい。" autocomplete="off"><br>
                  <label title="Alt+Shift+F でこのテキストボックスにフォーカスします。">最近の学習フェーズ </label>
                  <input type="number" class="form-inline" name="level" id="level" min="1" max="5" autocomplete="off" value="1"><br>
                  <label title="Alt+Shift+D でこのテキストボックスにフォーカスします。">最近の学習日 </label>
                  <input type="date" class="form-control" name="laststudied" id="laststudied" min="2021-04-01" max="2999-03-31" required><br>
                <p align="center"><input type="submit" name="submit" class="btn btn-info" value="これで登録する"></p>
            </form>
        </div>
    </div>
    </div>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $('#categoryList').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Japanese.json"
      },
    });
</script>
<script>
    // クリックしたカテゴリー名を#categoryの値とする
    $(".info").click(function(){
      var category = $(this).text();
      $("#category").val(category);
    });
    // tab & shift+tab 以外のキー入力を無効化
    $("#level").on("keydown", function (e) {
        if (e.keyCode == 9) return true;
        else return false;
    });

    function start(){
      // 現在に日付を日付ボックスにセット
      var today = new Date();
      today.setDate(today.getDate());
      var yyyy = today.getFullYear();
      var mm = ("0"+(today.getMonth()+1)).slice(-2);
      var dd = ("0"+today.getDate()).slice(-2);
      var setToday = yyyy+'-'+mm+'-'+dd;
      $("#laststudied").val(setToday);
    }

</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../shortCuts.js"></script>
</body>
</html>

