<?php

header('Content-Type: text/html; charset=UTF-8');
session_start();

if(!empty($_POST)){

	if($_POST["name"] == ""){
		$error["name"] = "blank";
	}
	if($_POST["number"] == ""){
		$error["number"] = "blank";
	}

	if(empty($error)){
		$_SESSION["join"] = $_POST;
		header("Location: mission6_check.php");
		exit();
	}
}

// 書き直し
if ($_REQUEST['action'] == 'rewrite'){
	$_POST = $_SESSION['join'];
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charaset = "UTF-8" />
	<title>バンド登録</title>

</head>
<body>下記の情報を登録してください</p>
	<form action =""method = "post">
	<dl>
		<dt>バンド名<font color = "red">	必須</font></dt>
		<dd>
			<input type = "text" name = "name" size "35" maxlength = "255"
				value = "<?php echo htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');?>">
			<?php if(!empty($error['name']) && $error['name'] == 'blank'):?>
			<p><font color = "red">* バンド名を記入してください</font></p>
			<?php endif; ?>
		</dd>
		<dt>バンドの人数<font color = "red">		必須</font></dt>
		<dd>
			<input type = "text" name = "number" size = "35" maxlength = "255"
			value="<?php echo htmlspecialchars($_POST['number'], ENT_QUOTES, 'UTF-8'); ?>">
			<?php if(!empty($error['number']) && $error['number'] == 'blank'): ?>
			<p><font color="red">* バンドの人数を記入してください</font></p>
			<?php endif; ?>
		</dd>
	</dl>
	<div><input type = "submit" value = "登録を確認"></div>
	</form>
</body>
</html>

