<?php
    function check( $name, $data, $password )
    {
        foreach ($data as $i)
        {

            if ( $i[0] == $name  )
            {
                if ( $i[1] == $password )
                    return 1;
                else
                    return -1;
            }
        }
        return 0;
    }

    header('Content-type:text/html; charset=utf-8');
    // 开启Session
    session_start();
    // 处理用户登录信息
    if (isset($_POST['login']))
    {
        // 从文件中读取数据到PHP变量
        $json_string = file_get_contents('data.json');
        // 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);

        // 接收用户的登录信息	
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        // 判断提交的登录信息	
        if ( $username == '' )
        {		
            header('refresh:10; url=login.html');
            echo "用户名不能为空,系统将在10秒后跳转到登录界面,请重新填写登录信息!\n";
            echo "<a href='login.html'>点此跳转</a>";
            exit;
        }
        elseif ( $password == '' )
        {		
            header('refresh:10; url=login.html');
            echo "密码不能为空,系统将在10秒后跳转到登录界面,请重新填写登录信息!\n";
            echo "<a href='login.html'>点此跳转</a>";
            exit;
        }
        elseif ( $flag = check($username, $data, $password) )
        {
            if ( $flag == -1 )
            {		
                header('refresh:10; url=login.html');
                echo "密码错误,系统将在10秒后跳转到登录界面,请重新填写登录信息!\n";
                echo "<a href='login.html'>点此跳转</a>";
                exit;
            }
            // 用户名和密码都正确,将用户信息存到Session中	
            $_SESSION['username'] = $username;
            $_SESSION['islogin'] = 1;
            // 若勾选7天内自动登录,则将其保存到Cookie并设置保留7天		
            if ($_POST['remember'] == "yes")
            {
                setcookie('username', $username, time() + 7 * 24 * 60 * 60);
                setcookie('code', md5($username . md5($password)), time() + 7 * 24 * 60 * 60);
            }
            else
            {
                // 没有勾选则删除Cookie		
                setcookie('username', '', time() - 999);
                setcookie('code', '', time() - 999);
            }
            // 处理完附加项后跳转到登录成功的首页		
            header('location:index.php');}
        else
        {	
            header('refresh:3; url=login.html');
            echo "用户名错误,系统将在3秒后跳转到登录界面,请重新填写登录信息!";
            exit;
        }
    }
?>