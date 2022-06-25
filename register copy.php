<?php
session_start();
require_once('funcs.php');
loginCheck();

$title = $_POST['title'];
$content  = $_POST['text'];
$img = '';

// 簡単なバリデーション処理追加。
// if(preg_replace("/( |　)/", "", $title ) === '' || preg_replace("/( |　)/", "", $content) === ''){
//     redirect('index.php?error=1');
// }

//imgがあるばあい
if($_SESSION['post']['image_data']){
    //名前を一意にするため時間を加えている
    $img = date('YmdHis') . '_' . $_SESSION['post']['file_name'];
}

if($_SESSION['post']['image_data']){
    file_put_contents('./img/' . $img, $_SESSION['post']['image_data']);
}

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare('INSERT INTO gs_a_table(
                            title, text, img, date, update_time, lat, lon
                        )VALUES(
                            :title, :text :img, sysdate(), sysdate(), :lat, :lon
                        )');
                        
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$stmt->bindValue(':img', $img, PDO::PARAM_STR);
// $status = $stmt->execute(); //実行

//４．データ登録処理後
if (!$status) {
    sql_error($stmt);
} else {
    $_SESSION['post'] = [] ;
    redirect('index.php');
}
