<?php
session_start();

require_once('funcs.php');
require_once('./common/head_parts.php');
require_once('./common/header.php');
loginCheck();

// post受け取る
$title = $_SESSION['post']['title'] = $_POST['title'];
$content = $_SESSION['post']['content'] = $_POST['content'];

// 簡単なバリデーション処理。
if(preg_replace("/( |　)/", "", $title ) === '' || preg_replace("/( |　)/", "", $content) === ''){
    redirect('index.php?error=1');
}


// imgある場合
// var_dump($_FILES);

echo '<pre>';
var_dump($_FILES);
echo '</pre>';


// if($_FILES['img']['name']){
//     $title = $_SESSION['post']['file_name'] = $_FILES['img']['name'];
//     // 一時保存されているファイル内容を取得して、セッションに格納
//     $image_data = $_SESSION['post']['image_data'] = file_get_contents($_FILES['img']['tmp_name']);
//     // 一時保存されているファイルの種類を確認して、セッションにその種類に当てはまる特定のintを格納
//     $image_type = $_SESSION['post']['image_type'] = exif_imagetype($_FILES['img']['tmp_name']);
// }else{
//     $image_data = $_SESSION['post']['image_data'] = '';
//     // 一時保存されているファイルの種類を確認して、セッションにその種類に当てはまる特定のintを格納
//     $image_type = $_SESSION['post']['image_type'] = '';
// }

?>

<!DOCTYPE html>
<html lang="ja">
<head>

    <?= $head_parts ?>

</head>


<!-- フォーム部分 -->
<form id="form" method="post" action="register.php">
		
            <label for="title">タイトル</label>
            <input type="hidden"name="title" value="<?= $title ?>">
            <p><?= $title ?></p>

            <label for="content" class="form-label">推しコメント</label>
            <input type="hidden"name="content" value="<?= $content ?>">
            <div><?= nl2br($content) ?></div>
		  
            <?php if($image_data) : ?>
            <div class="mb-3">
                <img src="image.php">
            </div>
            <?php endif; ?>
  
      <input id="submit" type="submit" value="確認">
  
</form>


<div><a href="select.php">COLLECTION LIST</a></div>
<div><a href="logout.php">LOGOUT</a></div>


</body>
</html>