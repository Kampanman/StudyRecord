<?php
  /* 下記2つでセッションを開始できる */
  session_start();
  $err = $_SESSION;
  if(isset($err)){
    if(strpos($_SESSION["user_data"]["inSession"],'studyAdmin') !== false){
      header('Location: ../studyAdmin/studyAdmin.php');
      exit;
    }
  }

  $_SESSION = array();
  session_destroy();
  /* 上記2つでセッションをリセットできる */

  $theme_1 = 'ログイン';
  $index_name = '学習記録管理帳';
  $index_pageurl = 'myStudyDayLogs';
  
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="login_form_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
  <title><?= $theme_1; ?>画面</title>
</head>

<body>
<div class="form-area">
  <div class="container">
    <h2 align="center"><?= $theme_1; ?>フォーム</h2>
      <?php if(isset($err['msg'])): ?>
        <p><?php echo $err['msg']; ?></p>
      <?php endif; ?>
    <form action="login.php" method="post">
      <p>
        <label for="email">メールアドレス</label>
        <input class="form-control" type="email" name="email" id="email" autocomplete="off" placeholder="Alt+M でカーソルを合わせられます。">
      </p>
      <p>
        <label for="password">パスワード</label>
        <input class="form-control" type="password" name="password" id="password" autocomplete="off" placeholder="Alt+P でカーソルを合わせられます。">
      </p>
      <?php if(isset($err['password'])): ?>
      <p align="center"><span style="color: red"><?php echo $err['password']; ?></span></p>
      <?php endif; ?>
      <p align="center"><input type="submit" id="logIn" class="btn btn-primary" title="Alt+L でカーソルを合わせられます。" value="<?= $theme_1; ?>" disabled></p>
    </form>
    <p align="center" hidden><a href="signup_form.php">新規登録はこちらから</a></p>
  </div>
  <br>
  <div class="fade-img-box">
     <img src="../../../myPictures/beawtifulFlowers_01.jpeg" alt="">
     <img src="../../../myPictures/beawtifulFlowers_02.jpeg" alt="">
     <img src="../../../myPictures/blueocean_01.jpeg" alt="">
     <img src="../../../myPictures/bluesky_01.jpeg" alt="">
     <img src="../../../myPictures/bluesky_02.jpeg" alt="">
   </div>
</div>
  <script type="text/javascript" src="login_form_scripts.js"></script>
  <script type="text/javascript" src="../shortCuts.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
</body>
</html>