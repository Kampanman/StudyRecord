<?
/**
 * レスポンスヘッダー（検証用ツールで確認できる）の設定
*/
header('Vary: Cookie');
    // プロキシサーバなどのキャッシュを適切に行ってもらうために必要
header('Cache-Control: private,no-store,must-revalidate');
    // private: Webサーバから返されるコンテンツがただ一人のユーザのためのものであることを示す。
    // no-store: Webサーバから返されてくるコンテンツをキャッシュに記録するな、という指示。
    // must-revalidate: キャッシュに記録されているコンテンツが現在も有効であるか否かをWebサーバに必ず問い合わせよ、という指示。
header('X-Content-Type-Options:nosniff');
    // XSSによってスクリプトが混じっていた場合に勝手にHTMLとして解釈されることを防ぐ。
header('X-Frame-Options:DENY');
header('X-Frame-Options:SAMEORIGIN');
header('X-Frame-Options:ALLOW-FROM uri');
    // クリックジャッキング攻撃対策。
header('X-XSS-Protection:1; mode=block');
    // XSSをブラウザが検知するとレンダリングを止める。
header('Strict-Transport-Security: max-age=31536000;');
    // 常時SSLのページ対策。