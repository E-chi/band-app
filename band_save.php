<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>バンド管理</title>
</head>
<body>


<?php

$dsn = 'mysql:dbname=band_management;host=localhost';

$user = 'root';

$password = 'root';

$pdo = new PDO($dsn,$user,$password); //3-1

if(!$pdo){
	die('接続失敗です。'.mysql_error());
}
print('<p>接続に成功しました</p>'); 

$sql = "CREATE TABLE band_db"
."("
."bandName char(32),"
."bandLeader char(64),"
."bandPeople char(32),"
."copyName char(64),"
."bandPlace char(64)"
.");";
$stmt =$pdo->query($sql);

$sql='SELECT * FROM band_db';
$results=$pdo->query($sql);
foreach ($results as $row){
	echo $row[0];
	echo '<br>';
}
echo"<hr>";


session_start();

header('Content-Type: text/html; charset=UTF-8');

if(!isset($_SESSION['create'])){
	header('Location: band_create.php');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$regName = $_SESSION['create']['bandName'];
$regLeader = $_SESSION['create']['bandLeader'];
$regPeople = $_SESSION['create']['bandPeople'];
$regCopy = $_SESSION['create']['copyName'];
$regPlace = $_SESSION['create']['bandPlace'];

$sql = $pdo -> prepare("INSERT INTO band_db(bandName,bandLeader,bandPeople,copyName,bandPlace)VALUES(:bandName,:bandLeader,:bandPeople,:copyName,:bandPlace)");
$sql -> bindParam(':bandName', $regName, PDO::PARAM_STR);
$sql -> bindParam(':bandLeader', $regLeader, PDO::PARAM_STR);
$sql -> bindParam(':bandPeople', $regPeople, PDO::PARAM_STR);
$sql -> bindParam(':copyName', $regCopy, PDO::PARAM_STR);
$sql -> bindParam(':bandPlace', $regPlace, PDO::PARAM_STR);


$sql -> execute();


unset($_SESSION['join']);

header('Location: band_regist.php');
exit();

}
?>



	<form action="" method="post">
		<dl>
			<dt>バンド名</dt>
			<dd>
				<?php echo htmlspecialchars($_SESSION['create']['bandName'], ENT_QUOTES, 'UTF-8'); ?>
			</dd>
			<dt>バンド代表者</dt>
			<dd>
				<?php echo htmlspecialchars($_SESSION['create']['bandLeader'], ENT_QUOTES, 'UTF-8'); ?>
			</dd>
			<dt>メンバー数</dt>
			<dd>
				<?php echo htmlspecialchars($_SESSION['create']['bandPeople'], ENT_QUOTES, 'UTF-8'); ?>
			</dd>
			<dt>コピー元</dt>
			<dd>
				<?php echo htmlspecialchars($_SESSION['create']['copyName'], ENT_QUOTES, 'UTF-8'); ?>
			</dd>
			<dt>活動場所</dt>
			<dd>
				<?php echo htmlspecialchars($_SESSION['create']['bandPlace'], ENT_QUOTES, 'UTF-8'); ?>
			</dd>

		</dl>
		<div><a href="band_create.php?action=rewrite">&laquo;&nbsp;修正する</a>
		<input type="submit" value="登録する"></div>
	</form>
</body>
</html>