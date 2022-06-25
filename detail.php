<?php
session_start();

/**
 * １．PHP
 * [ここでやりたいこと]
 * まず、クエリパラメータの確認 = GETで取得している内容を確認する
 * イメージは、select.phpで取得しているデータを一つだけ取得できるようにする。
 * →select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * ※SQLとデータ取得の箇所を修正します。
 */

 //IDとってくる
$id = $_GET['id'];

//func.phpのDBとつなげるぞ、を書いておく
require_once('funcs.php');
require_once('./common/head_parts.php');
require_once('./common/header.php');

loginCheck();
$pdo = db_conn();

//selectの２．データ登録SQL作成をコピペしてきた
//この人のデータを持ってこいと書く WHEREで指定
$stmt = $pdo->prepare('SELECT * FROM gs_a_table WHERE id = :id');
$stmt->bindValue(':id' , $id, PDO::PARAM_INT);
$status = $stmt->execute();

// $view = ''; ←PHP05配布になかったので一旦コメントアウト

if ($status === false) {
 sql_error($stmt); //失敗したらfuncsのエラー関数使ってね
} else {
    $result = $stmt-> fetch();
}

?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">
<head>

<?= $head_parts ?>

</head>
<body>
<?= $header ?>

<form id="form" class="topBefore" method="post" action="select.php">
<input type="hidden" name="id" value="<?= $result['id'] ?>">
		  <input id="name" type="text" placeholder="Title" name="name" value="<?= $result['name'] ?>">
		  <input id="url" type="text" placeholder="URL" name="url" value="<?= $result['url'] ?>">
		  <textarea id="comment" type="text" placeholder="COMMENT" name="comment"><?= $result['comment'] ?></textarea>
         
  <input id="submit" type="submit" value="UPDATE">
  
</form>
</body>
</html>

