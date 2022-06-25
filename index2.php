<!-- 最初に造っていたバージョン -->

<?php
session_start();

require_once('funcs.php');
require_once('./common/head_parts.php');
require_once('./common/header.php');
loginCheck();

$title = '';
$text ='';
$image_data ='';

if(isset($_SESSION['post']['title'])){
    $title = $_SESSION['post']['title'];
}

if(isset($_SESSION['post']['text'])){
    $content = $_SESSION['post']['text'];
}

if (isset($_SESSION['post']['image_data'])) {
  $image_data = $_SESSION['post']['image_data'];
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>

    <?= $head_parts ?>

</head>

<!-- エラーの時用 -->
<?php if(isset($_GET['error'])) : ?>
<p class="text-danger">何かがおかしい</p>
<?php endif; ?>

<?= $header ?>



<!-- フォーム部分 -->
<form id="form" method="post" action="confirm.php">
		
		  <input id="title" type="text" placeholder="例：○○な狛犬" name="title">
		  
      <?php if ($image_data): ?>
        <img src="image.php">
      <?php endif;?>
      <input id="img" type="file" name="img">
		  
      <textarea id="text" type="text" placeholder="推しコメント" name="text"></textarea>
  
      <input id="submit" type="submit" value="確認">
  
</form>


<div><a href="select.php">COLLECTION LIST</a></div>
<div><a href="logout.php">LOGOUT</a></div>


</body>
</html>