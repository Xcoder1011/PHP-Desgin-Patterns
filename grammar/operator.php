<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/10
 * Time: 7:39 PM
 */


/// 《运算符》

// 1. 算数运算符
/*
$a * $b	乘法	$a 和 $b 的积。
$a / $b	除法	$a 除以 $b 的商。
$a % $b	取模	$a 除以 $b 的余数。
$a ** $b	求幂	$a 的 $b次方的值. PHP 5.6版本中引入.
*/

// 取模运算符的操作数在运算之前都会转换成整数（除去小数部分）。
// 取模运算符 % 的结果和被除数的符号（正负号）相同。即 $a % $b 的结果和 $a 的符号相同

echo (5 % 3)."\n";           // prints 2
echo (5 % -3)."\n";          // prints 2
echo (-5 % 3)."\n";          // prints -2
echo (-5 % -3)."\n";         // prints -2


// 2. 赋值运算符

// 注意赋值运算将原变量的值拷贝到新变量中（传值赋值），所以改变其中一个并不影响另一个。

$a += 5; // sets $a to 8, as if we had said: $a = $a + 5;
$b = "Hello ";
$b .= "There!"; // sets $b to "Hello There!", just like $b = $b . "There!";


$a .= $b;
$a = $a.$b;      // 字符串拼接

$a = $a ?? $b;   // NULL合并

// 当 expr1 为 null，表达式 (expr1) ?? (expr2) 等同于 expr2，否则为 expr1。
// 注意：NULL 合并运算符是一个表达式，产生的也是表达式结果，而不是变量。

$action = $_POST['action'] ?? 'default';

// 以上例子等同于于以下 if/else 语句

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else {
    $action = 'default';
}


// 3. 引用赋值

// 使用“$var = &$othervar;”语法。引用赋值意味着两个变量指向了同一个数据，没有拷贝任何东西。

$a = 3;
$b = &$a;  // $b 是 $a 的引用

print "$a\n"; // 输出 3
print "$b\n"; // 输出 3

$a = 4; // 修改 $a

print "$a\n"; // 输出 4
print "$b\n"; // 也输出 4，因为 $b 是 $a 的引用，因此也被改变


// 注意：new 运算符自动返回一个引用，因此在 PHP 7.0.0及之后的版本中禁止对 new 的结果进行引用赋值

class C {}
//  $o = &new C;  # ❌



// 4. 位赋值运算符

$a &= $b;
$a = $a & $b;    // 按位与 (Or)

$a |= $b;
$a = $a | $b;    // 按位或 (And)

$a ^= $b;
$a = $a ^ $b;    // 按位异或 (Xor)

$a <<= $b;
$a = $a << $b;   // 左移  : 将 $a 中的位向左移动 $b 次（每一次移动都表示“乘以 2”）。

$a >>= $b;
$a = $a >> $b;   // 右移  : 将 $a 中的位向右移动 $b 次（每一次移动都表示“除以 2”）。

~$a;             // 按位取反（Not）, 将 $a 中为 0 的位设为 1，反之亦然。

echo 8 << 3;  // 64, 相当于3次乘以2
echo 8 * 2 * 2 * 2;

echo 8 >> 3;  // 1, 相当于3次除以2
echo 8/2/2;


// 5. 比较运算符

/*

$a == $b	等于	true，如果类型转换后 $a 等于 $b。
$a === $b	全等	true，如果 $a 等于 $b，并且它们的类型也相同。
$a != $b	不等	true，如果类型转换后 $a 不等于 $b。
$a <> $b	不等	true，如果类型转换后 $a 不等于 $b。
$a !== $b	不全等	true，如果 $a 不等于 $b，或者它们的类型不同。
$a < $b	小与	true，如果 $a 严格小于 $b。
$a > $b	大于	true，如果 $a 严格大于 $b。
$a <= $b	小于等于	true，如果 $a 小于或者等于 $b。
$a >= $b	大于等于	true，如果 $a 大于或者等于 $b。
$a <=> $b	太空船运算符（组合比较符）	当$a小于、等于、大于 $b时 分别返回一个小于、等于、大于0的 integer 值。 PHP7 起开始提供。

*/

// 如果比较一个数字和字符串或者比较涉及到数字内容的字符串，则字符串会被转换为数值并且比较按照数值来进行。此规则也适用于 switch 语句。
// 当用 === 或 !== 进行比较时则不进行类型转换，因为此时类型和数值都要比对。

// 转换为数值进行比较
var_dump(0 == "a"); // 0 == 0 -> true
var_dump("1" == "01"); // 1 == 1 -> true
var_dump("10" == "1e1"); // 10 == 10 -> true
var_dump(100 == "1e2"); // 100 == 100 -> true

switch ("a") {
    case 0:
        echo "0";
        break;
    case "a": // never reached because "a" is already matched with 0
        echo "a";
        break;
}

$a = ['a' => 1, 'b' => 2, 'c' => 3, 'e' => 4];
$b = ['a' => 1, 'b' => 2, 'd' => 3, 'e' => 4];

var_dump($a <=> $b);        // int(1) : $a > $b because $a has the 'c' key and $b doesn't.

var_dump($b <=> $a);        // int(1) : $b > $a because $b has the 'd' key and $a doesn't.


// Integers
echo 1 <=> 1; // 0
echo 1 <=> 2; // -1
echo 2 <=> 1; // 1

// Floats
echo 1.5 <=> 1.5; // 0
echo 1.5 <=> 2.5; // -1
echo 2.5 <=> 1.5; // 1

// Strings
echo "a" <=> "a"; // 0
echo "a" <=> "b"; // -1
echo "b" <=> "a"; // 1


echo "a" <=> "aa"; // -1
echo "zz" <=> "aa"; // 1

// Arrays
echo [] <=> []; // 0
echo [1, 2, 3] <=> [1, 2, 3]; // 0
echo [1, 2, 3] <=> []; // 1
echo [1, 2, 3] <=> [1, 2, 1]; // 1
echo [1, 2, 3] <=> [1, 2, 4]; // -1


/// 具有较少成员的数组较小，如果运算数 1 中的键不存在于运算数 2 中则数组无法比较，否则挨个值比较
///
/// 数组是用标准比较运算符这样比较的
function standard_array_compare($op1, $op2)
{
    if (count($op1) < count($op2)) {
        return -1; // $op1 < $op2
    } elseif (count($op1) > count($op2)) {
        return 1; // $op1 > $op2
    }
    foreach ($op1 as $key => $val) {
        if (!array_key_exists($key, $op2)) {
            return null; // uncomparable
        } elseif ($val < $op2[$key]) {
            return -1;
        } elseif ($val > $op2[$key]) {
            return 1;
        }
    }
    return 0; // $op1 == $op2
}


// 6. 三元运算符 “?:”

//     (expr1) ? (expr2) : (expr3)

//     表达式 expr1 ?: expr3 在 expr1 求值为 true 时返回 expr1，否则返回 expr3。
//     注意：三元运算符是一个表达式，产生的也是表达式结果，而不是变量。

$action = (empty($_POST['action'])) ? 'default' : $_POST['action'];

// 以上等同于

if (empty($_POST['action'])) {
    $action = 'default';
} else {
    $action = $_POST['action'];
}


