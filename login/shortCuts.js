// 現在表示している画面のURL取得
var url = document.URL;
console.log(url);

// ショートカットキーアクション
  document.onkeydown = kd;
  document.onkeyup = ku;
  var keyStatus = {}; //keyのステータス
  function kd(event){
    //console.log(event.keyCode);
    keyStatus[event.keyCode] = true;

    // ログイン認証画面
    if(url.indexOf("login_form")>-1){
      // Alt+M
      if (keyStatus[18] && keyStatus[77]) {
        // public/login_form.phpのアドレス入力欄にフォーカス
        document.getElementById("email").focus();
      }
      // Alt+P
      if (keyStatus[18] && keyStatus[80]) {
        // public/login_form.phpのパスワード入力欄にフォーカス
        document.getElementById("password").focus();
      }
      // Alt+L
      if (keyStatus[18] && keyStatus[76]) {
        // public/login_form.phpのログインボタンにフォーカス
        document.getElementById("logIn").focus();
      }
    }

    // マイページトップ
    if(url.indexOf("Admin.php")>-1){
      return;
    }
    // 新規登録ページ
    if(url.indexOf("add")>-1){
      // Alt+Shift+N
      if (keyStatus[18] && keyStatus[16] && keyStatus[78]) {
        // 学習内容（＆範囲）にフォーカス
        document.getElementById("studiedname").focus();
      }
      // Alt+Shift+F
      if (keyStatus[18] && keyStatus[16] && keyStatus[70]) {
        // フェーズにフォーカス
        document.getElementById("level").focus();
      }
      // Alt+Shift+D
      if (keyStatus[18] && keyStatus[16] && keyStatus[68]) {
        // 最近の学習日欄にフォーカス
        document.getElementById("laststudied").focus();
      }

    }
    // レコード編集ページ
    if(url.indexOf("edit")>-1){
      // Alt+Shift+D
      if (keyStatus[18] && keyStatus[16] && keyStatus[68]) {
        // 日付入力欄にフォーカス
        document.getElementById("dayInto").focus();
      }
      // Alt+Shift+N
      if (keyStatus[18] && keyStatus[16] && keyStatus[78]) {
        // 学習内容（＆範囲）にフォーカス
        document.getElementById("studiedname").focus();
      }
      // Alt+Shift+F
      if (keyStatus[18] && keyStatus[16] && keyStatus[70]) {
        // 新フェーズにフォーカス
        document.getElementById("inputLevel").focus();
      }
    }
  }
  function ku(event) {keyStatus[event.keyCode] = false;}