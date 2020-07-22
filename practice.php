<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission3</title>
    </head>
    <body>   
        <?php  
    $str = $_POST["str"];
    $name  = $_POST["name"];
    $del = $_POST["del"];
    $comment =$_POST["comment"];
    $filename="mission3-4.txt";
    $edit=$_POST["edit"];
    $date = date("Y年m月d日H時i分s秒");
     if(file_exists($filename)){ $num = count(file($filename))+1;
     }else{
         $num=1;
     }
     //コメントここでコメントフォームの編集番号の変数を設定する
     $editnum=$_POST["num"];
     //$numが上記で使われているので$editnumとする
     //明確な条件分けのため編集番号が空であるという条件を足す
     if(!empty($name) && !empty($comment)&&empty($editnum)){
         $fp=fopen($filename,"a");
         fwrite($fp,$num."<>".$name."<>".$comment."<>".$date.PHP_EOL);
         fclose($fp);
     }
      //編集
      if(!empty($name)&& !empty($comment) & if($editnum==$explode[0]){//投稿したい内容ならば
                  fwrite($fp,$editnum."<>".$name."<>".$comment."<>".$date.PHP_EOL);
              }else{//編集したい投稿出ないならば
                fwrite($fp,$explode[0]."<>".$explode[1]."<>".$explode[2]."<>".$explode[3].PHP_EOL); 
              }
          }fclose($fp);
         }
     //削除
     if(!empty($del)){
     $lines=file($filename,FILE_IGNORE_NEW_LINES);
        $fp=fopen($filename,"w");
         foreach($lines as $line){
             $line=explode("<>",$line);
             //$linesと設定するなら，以下３行は全て＄linesにしなくてはいけない
             if($del!= $line[0]){
                 fwrite($fp,$line[0]."<>".$line[1]."<>".$line[2]."<>".$line[3].PHP_EOL);&!empty($editnum)){
          $lines=file($filename,FILE_IGNORE_NEW_LINES);
           $fp=fopen($filename,"w");
          foreach($lines as $line){
              $explode=explode("<>",$line); if($editnum==$explode[0]){//投稿したい内容ならば
                  fwrite($fp,$editnum."<>".$name."<>".$comment."<>".$date.PHP_EOL);
                  
              }else{//編集したい投稿出ないならば
                fwrite($fp,$explode[0]."<>".$explode[1]."<>".$explode[2]."<>".$explode[3].PHP_EOL); 
              }
          }fclose($fp);
      }
      //編集フォームからコメントフォーム
     if(!empty($edit)){
         $lines=file($filename,FILE_IGNORE_NEW_LINES);
          foreach($lines as $line){
              $explode_edit=explode("<>",$line);
              $explode_num=$explode_edit[0];
            if($explode_num==$edit){
                $explode_name=$explode_edit[1];
                $explode_comment=$explode_edit[2];
            }
     }
     }
     //表示
      $lines=file($filename,FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
           $line=explode("<>",$line);//$linesのままだと何も表示されない    echo $line[0],"",$line[1],"",$line[2],"",$line[3]."<br>";
    }
     ?>
     <form action="" method="post">
            <input type="text" name="name" placeholder="名前"
            value="<?php echo $explode_name;?>">
            <input type="text" name="comment" placeholder="コメント"
            value="<?php echo $explode_comment;?>">
             <input type="hidden" name="num" placeholder="編集番号"
             value="<?php echo $edit;?>">
            <input type="submit" name="submit">
        
            <input type="number" name="del" placeholder="削除対象番号" >
            <input type="submit" name="submit_del" value="削除">
        
            <input type="number" name="edit" placeholder="編集対象番号">
            <input type="submit" name="submit_edit" value="編集">
        </form>
    </body>     
    </html>
    
     
    