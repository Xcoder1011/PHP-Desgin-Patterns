<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/26
 * Time: 6:29 PM
 */


/// 1. 函数中的函数
//
// PHP 中的所有函数和类都具有全局作用域，可以定义在一个函数之内而在之外调用，反之亦然。
//
// PHP 不支持函数重载，也不可能取消定义或者重定义已声明的函数。

function foo()
{
    function bar()
    {
        echo "I don't exist until foo() is called.\n";
    }
}

/* 现在还不能调用bar()函数，因为它还不存在 */

foo();

/* 现在可以调用bar()函数了，因为foo()函数
   的执行使得bar()函数变为已定义的函数 */

bar();


function recursion($a)
{
    if ($a < 20) {
        echo "$a\n";
        recursion($a + 1);
    }
}

recursion(10);   # 10 11 12 13 14 15 16 17 18 19

echo "<br/>";

// 1.1 向函数传递数组
// 默认情况下，函数参数通过 值传递

function takes_array($input)
{
    echo "$input[0] + $input[1] = ", $input[0]+$input[1];  # 23 + 24 = 47
}

takes_array([23, 24]);

echo "<br/>";


// 1.2 通过引用传递参数

function add_some_extras(&$p)
{
    // 默认情况下，函数参数通过值传递（因而即使在函数内部改变参数的值，它并不会改变函数外部的值）
    // 如果希望允许函数修改它的参数值，必须通过引用传递参数。
    $p .= 'and something extra.';
}

$str = 'This is a string, ';
add_some_extras($str);

echo $str;     # 打印出 'This is a string, and something extra.'

echo "<br/>";


// 1.3 在函数中使用默认参数

function makecoffee($type = "cappuccino")
{
    return "Making a cup of $type.\n";
}
echo makecoffee();                   # Making a cup of cappuccino.
echo makecoffee(null);         # Making a cup of .
echo makecoffee("espresso");   # Making a cup of espresso.

echo "<br/>";


// 1.4 PHP 还允许使用数组 array 和特殊类型 null 作为默认参数
// 默认值必须是常量表达式，不能是诸如变量，类成员，或者函数调用等。

function makeCoffe2($types = ["cappuccino"], $coffeMaker = NULL)
{
    $device = is_null($coffeMaker) ? "hands" : $coffeMaker;
    return "Making a cup of ".join(", ", $types)." with $device. \n";
}
echo makeCoffe2();      # Making a cup of cappuccino with hands.
echo makeCoffe2(["cappuccino", "lavazza"] , "teapot"); # Making a cup of cappuccino, lavazza with teapot.


/// 注意： 注意当使用默认参数时，任何默认参数必须放在任何非默认参数的右侧!!!!!

function makeyogurt1($type = "acidophilus", $flavour)  # 错误写法❌
{
    return "Making a bowl of $type $flavour.\n";
}

function makeyogurt2($flavour, $type = "acidophilus")   # 正确写法✅
{
    return "Making a bowl of $type $flavour.\n";
}


/// 2. 可变数量的参数列表

// 2.1 使用 ... 来访问变量参数

function sum(...$numbers)
{
    $total = 0;
    foreach ($numbers as $n)
    {
        $total += $n;
    }
    return $total;
}

echo sum(1, 2, 3, 4, 5);  # 15


// 2.2 使用 ... 来传递参数

function add($a, $b)
{
    return $a + $b;
}

// 可以使用 ... 语法来传递 array 或 Traversable 做为参数到函数中：
echo add(...[1, 2]); # 3

$a = [1, 2];
echo add(...$a);  # 3

echo "<br/>";

// 在 ... 前指定正常的位置参数
// 可以在 ... 标记前添加一个 类型声明。

function total_intervals($unit, DateInterval ...$intervals)
{
    $time = 0;
    foreach ($intervals as $interval)
    {
        $time += $interval->$unit;
    }
    return $time;
}

$a = DateInterval::createFromDateString('P1D');
$b = DateInterval::createFromDateString('P2D');

echo total_intervals('d', $a, $b).' days';  # 0 days
