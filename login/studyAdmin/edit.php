<?php
session_start();
require_once('config.php');
require_once("../securityHeaders.php");

if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    /* 入力値は「サニタイズ」（特殊文字の無害化）しておく */
    $studiedname = htmlspecialchars($_POST['studiedname'], ENT_QUOTES, "UTF-8");
    $category = htmlspecialchars($_POST['category'], ENT_QUOTES, "UTF-8");
    $level = htmlspecialchars($_POST['level'], ENT_QUOTES, "UTF-8");
    $laststudied = htmlspecialchars($_POST['laststudied'], ENT_QUOTES, "UTF-8");
    
    $result = mysqli_query($connect, "UPDATE $table_1 SET studiedname='$studiedname',category='$category',level='$level',laststudied='$laststudied' WHERE id=$id");
    header("Location:studyAdmin.php"); /* 処理後にどこのファイルに遷移するか */
    
}
?>
<?php
//error_reporting(0);
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($connect, "SELECT * FROM $table_1 WHERE id=$id");
 
while($row = mysqli_fetch_array($result))
{
    $studiedname = $row['studiedname'];
    $category = $row['category'];
    $level = $row['level'];
    $laststudied = $row['laststudied'];
}
?>
<html>
<head>
	<title><?= $theme.'編集フォーム';?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { font-family: "Sawarabi Gothic"; }
        .form-inline {
            border-radius: 5px;
            padding-left: 5px;
            background-color: #EEEEEE;
        }
        #inputLevel {
            width: 10%;
            background-color: white;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body onload="start()">
	<div class="container" style="width: 800px; margin-top: 100px;">
	    <a href="studyAdmin.php?=data-list" id="forIndex" class="btn btn-info"><?= $theme; ?>早見表へ</a><br>
		<div class="row">
			<h3><?= $theme.'編集フォーム';?></h3>
			<h4><b style="color: red;"></b></h4>
            <form action="" method="post">
                <p>
                    <label for="dayInto" title="Alt+Shift+D でこのテキストボックスにフォーカスします。">日付を選択して下さい　</label>
                    <input type="date" class="form-control" name="dayInto" id="dayInto"  min="2021-04-01" max="2999-03-31" required>
                </p>
                <br>
                    <input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
                    <label for="studiedname" title="Alt+Shift+N でこのテキストボックスにフォーカスします。">学習内容（＆範囲）</label>
                    <input type="text" class="form-control" name="studiedname" id="studiedname" value="<?php echo $studiedname;?>" required>
                <br>
                    <p><label>カテゴリー</label><input type="text" class="form-control" name="category" id="category" value="<?php echo $category;?>"></p>
                    <p>
                        <label for="inputLevel" title="Alt+Shift+F でこのテキストボックスにフォーカスします。">登録するフェーズ</label>　
                        <input type="number" class="form-inline" name="inputLevel" id="inputLevel" min="1" max="5" autocomplete="off" value="<?php echo $level;?>"><br>
                        <label>選択したフェーズ </label>
                        <input type="number" class="form-control" name="level" id="level" value="<?php echo $level;?>" readonly>
                    </p>
                    <p><label>選択した学習日</label><input type="text" class="form-control" name="laststudied" id="laststudied" value="<?php echo $laststudied;?>" readonly></p>
                <div class="form-group">
                    <input type="submit" value="Update" class="btn btn-primary btn-block" name="update">
                </div>
            </form>
		</div>
	</div>
<script>
// フェーズの新規登録
$("#inputLevel").on("blur",function(){
    var newLevel = $(this).val();
    $("#level").val(newLevel);
});
// tab & shift+tab 以外のキー入力を無効化
$("#inputLevel").on("keydown", function (e) {
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
      $("#dayInto").val(setToday);
    }
    // 日付の新規登録
    $("#dayInto").on("blur",function(){
        var newDate = $(this).val();
        $("#laststudied").val(newDate);
    });
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="../shortCuts.js"></script>
</body>
</html>