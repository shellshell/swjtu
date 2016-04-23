<?php
/*
	******************

	powered by ©Swhite

	******************
*/
	$url='http://210.41.95.5/servlet/UserLoginSQLAction';
	$stu_num='2014121840';//这里设置用户名
	$stu_pwd='********';//这里设置密码
	$post_fields='url=../usersys/index.jsp&OperatingSystem=&Browser=&user_id='.$stu_num.'&password='.$stu_pwd.'&user_style=modern&user_type=student&btn1=';//post字符串
	$refter= 'http://210.41.95.5/service/login.jsp?user_type=student';
	$ch=curl_init();//初始化cURL
	echo "<base href='http://210.41.95.5'>";//设置相对路径
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $refter);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5');//模拟浏览器
	curl_setopt($ch, CURLOPT_HEADER, 1);//开启http头，方便正则
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//文件流返回
	curl_setopt($ch, CURLOPT_POST, 1);//开启post
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);//POSTing
	$arr=curl_exec($ch);
	curl_close($ch);
	preg_match('/Set-Cookie:(.*);/iU',$arr,$str);//正则匹配cookie
	
	$cookie=' user_id='.$stu_num.'; user_type=student; user_style=modern; language=cn; ';
	$cookie=$cookie.$str[1];//组合成cookie
/*	登录操作	*/
	$index='http://210.41.95.5/usersys/index.jsp';//出发页
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $index);
	curl_setopt($ch, CURLOPT_REFERER, $refter);//来源页
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	$put=curl_exec($ch);
	curl_close($ch);
	echo $put;
?>
