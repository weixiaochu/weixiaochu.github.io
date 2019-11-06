<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: text/html; charset=utf-8");
$user='root';      //数据库连接用户名
$pass='root';      //对应的密码
$dsn="mysql:host=127.0.0.1;port=3306;dbname=trip;charset=utf8";

/*
安全方面：
	使用PDO时尽量使用非模拟预处理
	创建PDO实例时将PDO::MYSQL_ATTR_MULTI_STATEMENTS设置为false，禁止多语句查询。
	SQL语句模板不使用变量动态拼接生成
*/
$param = [
    // 禁止多条语句同时执行
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    // 非模拟预处理
    PDO::ATTR_EMULATE_PREPARES=>false,
    // PDO::FETCH_ASSOC 来获取关联数组，PDO::FETCH_NUM 来获取数字数组，使用 PDO::FETCH_OBJ 来获取对象数组
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];
try{
	$conn = new PDO($dsn, $user, $pass,$param);
} catch (PDOException $e) {
    print "错误: ". mb_convert_encoding($e->getMessage(),'UTF-8','GBK')."<br />";
    print "行号: ".$e->getLine()."<br />";
    die();
}
// $sql = "SELECT * from user where userId = ? and userName =?";

$sql = "SELECT * from user where userId = :userId and userName =:userName";


$tis = $conn->prepare($sql);
/*
$tis->bindValue(1,1);
$tis->bindValue(2,'15330734121');
*/
$uid = 1;
$userName = '15330734121';
$tis->bindParam(':userId', $uid);// 需要使用变量，不然报错
$tis->bindParam(':userName',$userName);
$tis->execute();
$row = $tis->fetchAll();
echo "<pre>";
print_r($row);
/*
while ($row = $tis->fetch()){
	echo $row['userId']."\t";
	echo $row['userName'];
	echo "<br>";
}
*/