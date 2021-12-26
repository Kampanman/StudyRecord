<?php
  /**
   * 先にsession_start();を記述することで、
   * セッションを有効にした状態で
   * 「require_once」を適用させる事が出来る。
   */
  session_start();
  require_once('../classes/UserLogic.php');

  // エラーメッセージ
  $err = [];

  // バリデーション
  if(!$email = filter_input(INPUT_POST, 'email')){
    $err['email'] = 'メールアドレスを入力してください。';
  }
  if(!$password = filter_input(INPUT_POST, 'password')){
    $err['password'] = 'パスワードを入力してください。';
  };

  if(isset($err)){
    if(strpos($_SESSION["user_data"]["inSession"],'studyAdmin') !== false){
      header('Location: ../studyAdmin/studyAdmin.php');
      exit;
    }
  }

  if(count($err) > 0){
    // エラーがあった場合は戻す
    $_SESSION = $err;
    header('Location: login_form.php');
    return; /* 戻る際に処理を止める */
  }
  // ログイン成功時の処理
  $result = UserLogic::login($email, $password);
  if($result == true){
    $_SESSION["user_data"]["inSession"] = "start";
  }
  // ログイン失敗時の処理
  if(!$result){
    header('Location: login_form.php');
    return; /* 戻る際に処理を止める */
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet">
    <style>
        body { font-family: "Sawarabi Gothic"; }
    </style>
  <title>ログイン完了</title>
</head>
<body>
<div align="center" class="container">
  <h2>ログイン完了</h2>
  <br>
  <p><b>ログインしました。</b></p>
</div>
  <script>
    setTimeout(() => {
      location.href = "../studyAdmin/studyAdmin.php";
    }, 3000);
  </script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
</body>
</html>
