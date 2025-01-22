<?php
include("functions.php");
check_session_id();

$user_id = $_GET["user_id"];
$todo_id = $_GET["todo_id"];

$pdo = connect_to_db();

$sql = "INSERT INTO like_table(id, user_id, todo_id, created_at) VALUES(NULL, :user_id, :todo_id, now())";

$stmt = $pdo->prepare($sql);
// バインド変数
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':todo_id', $todo_id, PDO::PARAM_INT);

try {
    $status = $stmt->execute();
} catch (PDOException $e) {
    echo json_encode(["sql error" => "{$e->getMessage()}"]);
    exit();
}

header("Location:todo_read.php");
exit();