<?php
header("Content-type:text/html;charset=utf-8");
// 获取当前文件的上级目录
$con = dirname(__FILE__);
// 扫描$con目录下的所有文件
$filename = scandir($con);

// 定义一个数组接收文件名
$conname = array();
foreach($filename as $k=>$v){
    // 跳过两个特殊目录   continue跳出循环
    if($v=="." || $v==".." || $v=="static" || $v==".git"){continue;}
    //截取文件名，我只需要文件名不需要后缀;然后存入数组
    if (is_dir($con.'/'.$v)) {
    	$fileArr = scandir($con.'/'.$v);
    	foreach ($fileArr as $key => $value) {
    		if($value=="." || $value==".."){continue;}
    		// windos默认编码为gbk
    		$conname[$v][] = iconv("GB2312","UTF-8",$value) . '@' .date('Y-m-d',filemtime($con.'/'.$v.'/'.$value));
    	}
    }
}
print_r($conname);
file_put_contents('dir.js', 'var dir = '.json_encode($conname,JSON_UNESCAPED_UNICODE).';');