<?php

 
header('Content-Type: text/html; charset=UTF-8');
session_start(); //セッション開始

if(!empty($_POST)){

/*
バンド名、リーダー、人数は確定させてから画面遷移ができるようにする
*/
	
	if($_POST["bandName"] == ""){
		$error["bandName"] = "blank";
	}
	if($_POST["bandLeader"] == ""){
		$error["bandLeader"] = "blank";
	}
	if($_POST["bandPeople"] == "---"){
		$error["bandPeople"] = "blank";
	}
	if(empty($error)){
		$_SESSION["create"] = $_POST;
		header("Location: band_save.php");
		exit();
	}//エラーが無かったらband_saveに移動

	
}



?>




<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8" />
		<title>バンド管理</title>
	</head>
	<body>
		<form action = "" method = "post">

			<p>バンドを登録するには以下の項目を埋めてください！</p>
			<dl>
			
				<dt>バンド名：<br/><font color = "red">		必須</font></dt>
				<dd>
					<input type = "text"name = "bandName"placeholder = "バンド名"
					value ="<?php echo htmlspecialchars($_POST['bandName'], ENT_QUOTES, 'UTF-8');?>"><br/>
					<?php if(!empty($error['bandName']) && $error['bandName'] == 'blank'):?>
					<p><script>alert("バンド名を入力してください")</script></p>
					<?php endif; ?>
				</dd>
				
				<dt>バンド代表者：<br/><font color = "red" >	必須</font></dt>
				<dd>
					<input type = "text"name = "bandLeader"placeholder = "氏名"
					value ="<?php echo htmlspecialchars($_POST['bandLeader'], ENT_QUOTES, 'UTF-8');?>"><br/>
					<?php if(!empty($error['bandLeader']) && $error['bandLeader'] == 'blank'):?>
					<p><font color = "red">* 代表者名を入力してください</font></p>
					<?php endif; ?>
				</dd>
				
				<dt>人数：<br/>
				<dd>
					<select name = "bandPeople">
						<option>---</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
						<option>それ以上</option>
					</select><br/>
					<?php if($error['bandPeople'] == 'blank'):?>
					<p><font color = "red">* 人数を選択してください</font></p>
					<?php endif; ?>
				</dd>
				</dt>
				
				<dt>コピー元バンド(20文字以内)：<br/>
				<dd>
					<input type = "text" name = "copyName" ><br/>
				</dd
				</dt>
				
				<dt>活動場所(スタジオ、都道府県):<br/>
				<dd>
					<input type = "text" name = "bandPlace" ><br/>
				</dd>
				</dt>
			</dl>
			<div><input type ="submit" value = "登録する！"></div>
		</form>
	</body>
</html>