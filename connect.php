<?php

$dsn = 'mysql57.empower-util.sakura.ne.jp';  //ホスト名を入力して下さい。
$username = 'empower-util';  //ユーザーネームを入力して下さい。
$password = 'i4237137ns';  //パスワードを入力して下さい（ない場合は入力不要）。
$dbname = 'empower-util_mydb'; //データベースサーバー名を入力して下さい。

/* ローカル環境の場合
$dsn = 'localhost';
$username = 'root';
$password = '';
$dbname = 'crud';
*/

/* どこかのサーバーを利用している場合
$dsn = 'mysql57.xxxx.xx.ne.jp'; (← 例)
$username = 'xxxx-xxx'; (← 例)
$password = 'xyxyxyxy'; (← 例)
$dbname = 'yyyy_mydb'; (← 例)
*/

$connect = mysqli_connect($dsn,$username,$password,$dbname);
/* これが、index,edit,deleteに出てきた第一引数$connectの正体だった */