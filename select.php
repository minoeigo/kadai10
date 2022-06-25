<?php
session_start();

//1.  DB接続します

require_once('funcs.php');
require_once('./common/head_parts.php');
require_once('./common/header.php');

loginCheck();
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_a_table');
$status = $stmt->execute();

//３．データ表示

$view = '';
if ($status == false) {
    sql_error($stmt);
} else {
    $contents = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>狛</title>
  <!-- カード式表示用のCSS -->
  <link rel="stylesheet" type="text/css" href="css2.css"> 
</head>

<body id="main">

<?= $header ?>

            <!-- <a href="detail.php"></a>
            <?= $view ?> -->

<!-- css追加部分用 -->
<div class="bl_media_container">
  <div class="bl_media_itemWrapper">
    <?php foreach ($contents as $content): ?>

    <div class="bl_media_item">

      <?php if ($content['img']): ?>
        <img src="./img/<?=$content['img']?>" alt="">
        <?php else: ?>
        <img src="./img/aaa.jpeg" alt="">
      <?php endif ?>
    
      <h3><?= $content['title'] ?></h3>

      <p><?= nl2br($content['content']) ?></p>

      <div>
        <small>登録日:<?= $content['date'] ?></small>
      </div>

      <div>
        <?php if (!is_null($content['update_time'])): ?>
          <small>更新日:<?= $content['update_time'] ?></small>
        <?php endif ?>
      </div>

      <a href="detail.php?id=<?=$content['id']?>">編集する</a>

    </div>
    <?php endforeach ?>
  </div>
</div>

<div>
<a href="index.php">登録画面に戻る</a>
</div>

</body>
</html>
