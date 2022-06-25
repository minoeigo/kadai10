<?php
//XSS対応（ echoする場所で使用！）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

//DB接続関数：db_conn() 
//※関数を作成し、内容をreturnさせる。
//※ DBname等、今回の授業に合わせる。

// ここから上野さんの7回目参考

// function db_conn(){

// try {
//     $db_name = 'kadai07';    //データベース名
//     $db_id   = 'root';      //アカウント名
//     $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = 'localhost'; //DBホスト
//     $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
   
// return $pdo;

// } catch (PDOException $e) {
//     exit('DB Connection Error:' . $e->getMessage());
// }    

// }

function db_conn(){
  $db_name = 'kadai07';    //データベース名
  $db_id   = 'root';      //アカウント名
  $db_pw   = 'root';      //パスワード：XAMPPはパスワード無しに修正してください。
  $db_host = 'localhost'; //DBホスト
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
     

  try{
      $pdo = new PDO($db_host, $db_id, $db_pw,
      [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
      return $pdo;
  } catch(PDOException $e){
      exit($e->getMessage());
  }
}




//ファイルデータをDBに保存する
function fileSave($title, $content, $img, $date, $lat, $lon){
  $result = False;

  $sql = "INSERT INTO gs_a_table(title, content, img, date, lat, lon) 
                                  VALUE(
                                    :title, :content :img, sysdate(), :lat, :lon)";
  try{
      $stmt = db_conn()->prepare($sql);
      $stmt->bindValue(':title', $title, PDO::PARAM_STR);
      $stmt->bindValue(':content', $content, PDO::PARAM_STR);
      $stmt->bindValue(':img', $img, PDO::PARAM_STR);
      $stmt->bindValue(':date', $date, PDO::PARAM_STR);
      $stmt->bindValue(':lat', $lat, PDO::PARAM_STR);
      $stmt->bindValue(':lon', $lon, PDO::PARAM_STR);
 
      $result = $stmt->execute();
      return $result;
  } catch(\Exception $e){
      echo $e->getMessage();
      return $result;
  }
}

//ファイルデータを取得する
function getAllFile(){
  $sql = "SELECT * FROM gs_a_table ORDER BY id DESC";

  $fileData = db_conn()->query($sql);

  return $fileData;
}

// function h($s) {
//   return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
//   }

// ここまで

//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    
$error = $stmt->errorInfo();
exit('SQLError:' . print_r($error, true));

}


//リダイレクト関数: redirect($file_name)

function redirect($file_name){

header('Location: ' . $file_name);
exit();

}

//ログインチェック
function loginCheck(){
    if( $_SESSION['chk_ssid'] != session_id() ){
      exit('LOGIN ERROR');
    }else{
      session_regenerate_id(true);
      $_SESSION['chk_ssid'] = session_id();
    }
  }