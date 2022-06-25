<?php

require_once('./common/head_parts.php');
require_once('./common/header.php');

?>

<!DOCTYPE html>
<html>

<head>
<?= $head_parts ?>
</head>

<body>
<?= $header ?>
    <header>
        LOGIN
    </header>

    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form id="form" class="topBefore" name="form" action="login_act.php" method="post">
        <input type="text" name="lid" placeholder="ID">
        <input type="password" name="lpw" placeholder="PW">
        <input id="submit" type="submit" value="LOGIN">
    </form>


</body>

</html>
