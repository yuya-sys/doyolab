<?php
// DB接続設定
	$dsn = 'mysql:dbname=tb220133db;host=localhost';
	$user = 'tb-220133';
	$password = '7cRSAcUtm7';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	
	//データベース内にテーブルを作成m４−２
	$sql = "CREATE TABLE IF NOT EXISTS tbtest_789"//テーブル名に-は使えない
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "date TEXT"
	.");";
	
	//関数の定義
	$name= $_POST["name"];
	$comment= $_POST["comment"];
	$pass= $_POST["pass"];
	$pass1=$_POST["pass_del"];
    $pass2=$_POST["pass_edit"];
    $del = $_POST["del"];
	$date = date("Y年m月d日H時i分s秒");
	
	//投稿機能
	if(!empty($name)&&!empty($comment)&&!empty($pass)){
	$stmt = $pdo->query($sql);
	$sql = $pdo -> prepare("INSERT INTO tbtest_789 (name, comment, date) VALUES (:name, :comment, :date)");
	//$sql = $pdo->prepare("INSERT INTO tbtest_345(name,comment,regi_date) VALUES(:name,:comment,:regi_date)");//データの挿入m４−５
	/*$sql->bindParam(':name',$name,POD::PARAM_STR);
	$sql->bindParam(':comment',$comment,POD::PARAM_STR);
	$sql->bindParam(':regi_date',$date,POD::PARAM_STR);
	$sql->execute();
	*/
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':date', $date, PDO::PARAM_STR);
	$sql->execute();
	}
	//echo $name;
	//echo $comment;
	//echo $date;
	
	//削除機能
	if(!empty($del)&&!empty($pass1)){//削除フォームに入力がある場合，テーブルのデータを呼び出し配列にする
	
	//m4-8
	$id=$del;
	$sql = 'delete from tbtest_789 where id=:id;';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	//m4-6
	if($del==id&&$pass1==id[4]){//パスワードの照会が出来ていない
	
    $sql='SELECT*FROM tbtest_789 where id=:id;';
	$stmt=$pdo->prepare($sql);//queryではなくprepareで表示はされた
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$results=$stmt->fetchAll();
	foreach ($results as $row){
	    echo $row['id'].',';
	     echo $row['name'].',';
	      echo $row['comment'].",";
	        echo $row['date']."<br>";
	
	
	    }
	}
	
	}
//編集機能投稿フォームに転送する
	if(!empty($edit)&&!empty($pass2)){
	    $sql='SELECT*FROM tbtest_789 where id=:id;';
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$results=$stmt->fetchAll();
	foreach ($results as $row){
	    echo $row['id'].',';
	     echo $row['name'].',';
	      echo $row['comment'].",";
	        echo $row['date']."<br>";
	if($edit==id){//パスワードの照会
	    $explode_name=$id[1];
	    $explode_comment=$id[2];
	 
	 
	 //編集
	 $editnum=$_POST["num"];
	 if(!empty($name)&& !empty($comment) &&!empty($editnum)&&!empty($pass)){  
	     $id = 1; //変更する投稿番号
	$name =$explode_name;
	$comment = $explode_comment;
	
	$sql = 'UPDATE tbtest_789 SET name=:name,comment=:comment WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	//m4-6
	$sql='SELECT*FROM tbtest_789 where id=:id;';
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
	$results=$stmt->fetchAll();
	foreach ($results as $row){
	    echo $row['id'].',';
	     echo $row['name'].',';
	      echo $row['comment'].",";
	        echo $row['date']."<br>";
	
//テーブルに登録されたデータを取得し表示m４−６
	$sql='SELECT*FROM tbtest_789';
	$stmt=$pdo->query($sql);
	$results=$stmt->fetchAll();
	foreach ($results as $row){
	    echo $row['id'].',';
	     echo $row['name'].',';
	      echo $row['comment'].",";
	        echo $row['date']."<br>";
	}
	
	
	/*//編集機能m４−６，m４ー７
	//投稿フォームに転送
	 if(!empty($edit)&&!empty($pass2)){
    $sql='SELECT*FROM tbtest_525';
	$stmt=$pdo->query($sql);
	$results=$stmt->fetchAll();
	foreach ($results as $row){
	    echo $row['id'].',';
	     echo $row['name'].',';
	      echo $row['comment'].",";
	       echo $row['pass'].",";
	        echo $row['regi_date']."<br>";
	        //explode_numやpass,commentが宣言されていない,そもそもexplode関数を使うのか？
	        $explode_num=$explode_edit[0];
	   if($explode_num==$edit&&$pass2==$explode_edit[4]){//&&$pass2==$explode_edit[4]教えてもらった
                $explode_name=$explode_edit[1];//編集したい投稿の名前
                $explode_comment=$explode_edit[2];//編集したい投稿のコメント
            }
	}
	 }
	*/
	
	//viewportを下記のように指定することでデバイスごとに画面が最適化される
	//POST配信された要素を素にif文とSQLで条件分岐
?>

<!DOCTYPE HTML>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>mission5</title>
    </head>
    <body>
      <form action="" method="post">
            <input type="text" name="name" placeholder="名前" value="<?php echo $explode_name;?>">
            <input type="text" name="comment" placeholder="コメント"value="<?php echo $explode_comment;?>">
             <input type="hidden" name="num" placeholder="編集番号"value="<?php echo $edit;?>">
             <input type="text" name="pass" placeholder="パスワード">
            <input type="submit" name="submit">
        
            <input type="number" name="del" placeholder="削除対象番号" >
            <input type="text" name="pass_del" placeholder="パスワード">
            <input type="submit" name="submit_del" value="削除">

        
            <input type="number" name="edit" placeholder="編集対象番号">
            <input type="text" name="pass_edit" placeholder="パスワード">
            <input type="submit" name="submit_edit" value="編集">
             
       
        </form>  
    </body>