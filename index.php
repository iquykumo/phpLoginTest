<?php
    header('Content-type:text/html; charset=utf-8');
    // 开启Session	
    session_start();
    // 首先判断Cookie是否有记住了用户信息	
    if (isset($_COOKIE['username']))
    {
        # 若记住了用户信息,则直接传给Session	
        $_SESSION['username'] = $_COOKIE['username'];
        $_SESSION['islogin'] = 1;
    }
    if (isset($_SESSION['islogin']))
    {
        // 若已经登录	
        echo "你好! " . $_SESSION['username'] . '
                                            ,欢迎来到个人中心!<br>';
        echo "<a href='leavemessage.php'>留言</a>\t";
        echo "<a href='logout.php'>注销</a>";
    } else {
        // 若没有登录	
        echo "您还没有登录,请<a href='login.html'>登录</a>";
        echo "或<a href='register.html'>注册</a>";
     

// $link = mysqli_connect("127.0.0.1","root","Vmorish");
// mysqli_select_db($link,"gbook");       
// $query = "select * from message";                 
// $result = mysqli_query($link,$query);              
// if( mysqli_num_rows($result) < 1){                     
// echo " 目前数据表中还没有任何留言!";              
// }else{                 
// $totalnum = mysqli_num_rows($result);
// //获取数据库中所有数据条数           
// $pagesize = 7;//每页显示7条       
// $page = $_GET["page"];      
// if( $page == ""){     
// $page = 1;               
// }          
// $begin = ($page-1)*$pagesize;  




// $totalpage = ceil($totalnum/$pagesize);                        //输出分页信息   
// echo "<table border=0 width=95%><tr><td>";                  
// $datanum = mysqli_num_rows($result);     
// echo "共有".$totalnum."条留言，每页".$pagesize."条，共".$totalpage."页。<br>"; 
// //输出页码              
// for( $i = 1; $i <= $totalpage; $i++){ 
// echo "<a href=index.php?page=".$i.">[".$i."] </a>";     
// }                        echo "<br>";             
// //从message表中查询当前页面所要显示的留言，并根据时间排序        
// $query = "select * from message order by addtime desc limit $begin,$pagesize";      
// $result = mysqli_query($link,$query);                    
// $datanum = mysqli_num_rows($result);               
// //循环输出所有留言，如果管理员已经回复则同时输出回复  
// for( $i = 1; $i <= $datanum; $i++){//$datanum???          
// $info = mysqli_fetch_array($result);    
// echo "->[".$info['author']."]于".$info['addtime']."说:<br>";         
// echo "  ".$info['content']."<br>";               
// if( $info['reply'] != ""){          
// // <b></b>显示粗体      

// echo "<b>管理员回复:</b>".$info['reply']."<br>";                 
// }                            echo "<hr>";               
// }//else结束            
// echo "</td></tr></table>";    
// }                 
// mysqli_close($link)




    }
?>
