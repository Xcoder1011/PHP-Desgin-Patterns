<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2021/1/5
 * Time: 7:11 PM
 */

// 闭包函数

// 允许 临时创建一个没有指定名称的函数。最经常用作回调函数 callable参数的值。

// 1. 匿名函数变量赋值示例

$num = 0;

$one = function()
{
   // var_dump($num);   $num不在此作用域内
};

$two = function () use ($num)
{
    var_dump($num);
};

$three = function () use (&$num)
{
    var_dump($num);
};

$four = function($name)
{
    var_dump($name);
};

$num++;

$one();
$two();  # int(0)
$three();  # int(1)
$four('PHP');  # string(3) "PHP"


// 2. 从父作用域继承变量

