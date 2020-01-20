<?php

    function check_exist($data, $name)
    {
        foreach ($data as $i)
        {
            if ( $i[0] == $name )
                return 1;
        }
        return 0;
    }

    header('Content-type:text/html; charset=utf-8');
    // 开启Session
    session_start();
    // 处理用户登录信息
    if (isset($_POST['register']))
    {
        // 从文件中读取数据到PHP变量
        $json_string = file_get_contents('data.json');
        // 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if ( $username == '' )
        {		
            header('refresh:10; url=register.html');
            echo "用户名不能为空,系统将在10秒后跳转到注册界面,请重新填写注册信息!\n";
            echo "<a href='register.html'>点此跳转</a>";
            exit;
        }
        elseif ( $password == '' )
        {		
            header('refresh:10; url=register.html');
            echo "密码不能为空,系统将在10秒后跳转到注册界面,请重新填写注册信息!\n";
            echo "<a href='register.html'>点此跳转</a>";
            exit;
        }
        elseif ( check_exist($data, $username) )
        {
            header('refresh:10; url=register.html');
            echo "用户名已存在,系统将在10秒后跳转到注册界面,请重新填写注册信息!\n";
            echo "<a href='register.html'>点此跳转</a>";
            exit;
        }
        else
        {
            $data[] = [$username, $password];
            $json_string =  explode(':', json_encode($data));
            // 写入文件
            file_put_contents('data.json', $json_string);
            header('refresh:10; url=login.html');
            echo "注册成功,系统将在10秒后自动跳转到登录界面!\n";
            echo "<a href='login.html'>点此跳转</a>";
            exit;
        }
    }
?>