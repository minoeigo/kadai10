<?php
session_start();


 //detail　からこぴぺ
$id = $_GET['id'];

require_once('funcs.php');
$pdo = db_conn();
loginCheck();

// まず保存された画像があれば削除する。
// まず画像があるか確認
$stmt = $pdo->prepare("SELECT img FROM gs_a_table WHERE id=" . $id . ';');
$status = $stmt->execute();

// もし画像がある場合
if ($status) {
    $row = $stmt->fetch();
    $imgName = $row['img'];
    // unlink()で削除
    unlink('/img' . $imgName);
}

// データの削除

$stmt = $pdo->prepare('DELETE FROM gs_a_table WHERE id = :id');
$stmt->bindValue(':id' , $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
// $view = ''; ←PHP05配布にはなかったので一旦コメントアウトしてる
if ($status === false) {
 sql_error($stmt); 
} else {
    //$result = $stmt-> fetch();
    redirect('select.php');

}

?>