<!DOCTYPE html>
<html lang = "ja">
    <head>
        <meta charset="UTF-8">
        <title>mission3</title>
    </head>
    <body>
        <form action="" method="post">
            <input type="text" name="name" placeholder="名前">
            <input type="text" name="comment" placeholder="コメント">
            <input type="submit" name="submit">
        <form action="" method="post">
            <input type="number" name="del" placeholder="削除対象番号" >
            <input type="submit" name="submit" value="削除">
        </form>
        </form>
       
        <?php
       
    $str = $_POST["str"];
    $name  = $_POST["name"];
    $del = $_POST["del"];
    $comment =$_POST["comment"];
    $filename="mission3-3.txt";
    $date = date("Y年m月d日H時i分s秒");
     
     if(file_exists($filename)){
         $num = count(file($filename))+1;
     }else{
         $num=1;
     }
     
     if(!empty($name) && !empty($comment)){
         $fp=fopen($filename,"a");
         fwrite($fp,$num."<>".$name."<>".$comment."<>".$date."\n");
         fclose($fp);
     }
      //画面表示
       $lines=file($filename,FILE_IGNORE_NEW_LINES);
       foreach($lines as $line){
           $line=explode("<>",$line);
           echo $line[0]."";
           echo $line[1]."";
           echo $line[2]."";
           echo $line[3]."<br>";
       }
     
   
     //削除
     if(!empty($del)){
     $contents=file($filename,FILE_IGNORE_NEW_LINES);
        $fp=fopen($filename,"w");
         foreach($contents as $content){
             $explode=explode("<>",$content);
             if($del!= $explode[0]){
                 fwrite($fp,$explode[0]."<>".$explode[1]."<>".$explode[2]."<>".$explode[3]."<br>");
                 //echo $explode[0],"",$explode[1],"",$explode[2],"",$explode[3]."<br>";
                 //$fp=fopen($filename,"a");
                 //$txt=$form[0]."<>".$form[1]."<>".$form[2]."<>".$form[3].PHP_EOL;
                // fwrite($fp,$txt);
             }
         }fclose($fp);
   
     }
     ?>
    </body>
         
    </html>
