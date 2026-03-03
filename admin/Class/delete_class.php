<?php
require_once(__DIR__ . '/../../config.php');
require_once(LIB_PATH . '/functions.class.php');

if (session_id() == '') {
    session_start();
}

if (!isset($_SESSION['adminId'])) {
    header('Location: ' . BASE_URL . '/admin/index.php');
    exit;
}

$fcObj = new DataFunctions();
$tbClass = TB_CLASS;

if (isset($_GET['class'])) {
    $clsId = (int)$_GET['class'];
    if ($clsId > 0) {
        $fcObj->deleteClass($tbClass, $clsId);
    }
}

header('Location: ' . BASE_URL . '/admin/Class/classes.php');
exit;
?>
