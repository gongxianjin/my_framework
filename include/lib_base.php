<?php 

// 递归 转义函数
function _addslashes($arr){
	foreach ($arr as $k => $v) {
		if(is_string($v)){
			$arr[$k] = addslashes($v);
		}elseif(is_array($v)){
			$arr[$k] = _addslashes($v);
		}
	}
	return $arr;
}