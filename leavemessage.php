<!-- 1.用户填写留言部分 send.php -->
<!-- 可以首先编写send页面，只有用户提交了留言才能进行后面的留言显示，留言管理等等 -->
<?php $name = $_POST["name"]; //从input里面传过来的name  
//看用户是否提交了新留言，如果提交了，则写入表message  
if ($name != "") {
    $content = $_POST["content"];
    //下面的代码用于获得当前日期和时间    
    $addtime = date("Y-m-d h:i:s"); //得到日期
    $link = mysqli_connect("127.0.0.1", "root", "");
    //PHP连接数据库     
    if ($link)            echo "ok!<br>";
    else {
        echo "bad!<br>";
    }
    mysqli_select_db($link, "leavemessagebook"); //选择数据库  
    $insert = "insert into message(author,addtime,content,reply) values('$name','$addtime','$content','')";
    mysqli_query($link, $insert);
    mysqli_close($link);
    echo "<script language=javascript>alert('留言成功!单击确定查看留言.');location.href='index.php';</script>";
}
mysqli_close($link);
?> <html>

<head>
    <title>欢迎留言本</title>
</head>
n
<body>
            <li> <label>用户名:\n</label> 
            <input type="text" name="username"> </li>
</body>

</html>