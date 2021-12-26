<?php
  session_start();
  require_once('../classes/UserLogic.php');
  require_once("../securityHeaders.php");
  
  
  if(!$logout = filter_input(INPUT_POST, 'logout')){
    header( "Location: ../public/login_form.php" );  
    exit('不正なリクエストです。');
  }
  
  //セッションが切れていたらログインしてくれとメッセージを出す。
  $result = UserLogic::checkLogin();
  if(!$result){
    header( "Location: ../public/login_form.php" );
    exit('セッションがタイムアウトしました。ログインしなおして下さい。');
  }

  //ログアウトする
  UserLogic::logout();

  $theme = 'ログアウト';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $theme; ?></title>
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body { font-family: "Sawarabi Gothic"; }
    </style>
</head>
<body>
<div class="container">
  <h2 align="center"><?= $theme; ?>完了</h2>
  <br>
  <p align="center"><b><?= $theme; ?>しました。</b></p>
</div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    setTimeout(function(){
      window.location.href = '../public/login_form.php';
    }, 3*1000);
  </script>
</body>
</html>
