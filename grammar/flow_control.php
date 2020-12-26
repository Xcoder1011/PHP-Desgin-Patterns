<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/14
 * Time: 7:15 PM
 */

$a = 5;
$b = 3;
$foo = 1;

/* 正确的使用方法： */

if ($a > $b):
    echo $a . " is greater than " . $b;
elseif ($a == $b):  # 注意使用了一个单词的 elseif
    echo $a . " equals " . $b;
else:
    echo $a . " is neither greater than or equal to " . $b;
endif;


?>


<?php if ($a == 5): ?>
    A is equal to 5
<?php endif; ?>



<?php
/*
 * 警告switch 和第一个 case 之间的任何输出（含空格）将导致语法错误。例如，这样是无效的：
 *
<?php switch ($foo): ?>
    <?php case 1: ?>       # 在 switch 和 case 之间不能有任何输出！！！
        ...展示
    <?php endswitch ?>
*/
?>

<?php switch ($foo): ?>
<?php case 1: ?>
        ...展示
    <?php endswitch ?>


<?php

///  1. while循环


$i = 1;
while ($i <= 10) {
    echo $i++;
}

// 两个例子完全一样，都显示数字 1 到 10：

$i = 1;
while ($i <= 10):
    print $i;
    $i++;
    endwhile;

//  while循环 效率较高

$t1 = microtime(true);
$a=0;
while($a++ <= 100000);
$t2 = microtime(true);
$x1 = $t2 - $t1;
echo PHP_EOL,' > while($a++ <= 100000); : ' ,$x1, 's', PHP_EOL;

// 打印出 > while($a++ <= 100000); : 0.0021629333496094s


$t3 = microtime(true);
for($a=0;$a <= 100000;$a++);
$t4 = microtime(true);
$x2 = $t4 - $t3;
echo PHP_EOL,'> for($a=0;$a <= 100000;$a++); : ' ,$x2, 's', PHP_EOL;

// 打印出 > for($a=0;$a <= 100000;$a++); : 0.0027439594268799s


$t5 = microtime(true);
$a=0; for(;$a++ <= 100000;);
$t6 = microtime(true);
$x3 = $t6 - $t5;
echo PHP_EOL,' > $a=0; for(;$a++ <= 100000;); : ' , $x3, 's', PHP_EOL;

// 打印出 > $a=0; for(;$a++ <= 100000;); : 0.0021271705627441s
echo "<br>";


///  2. do-while 循环

$i = 0;
do {
    echo $i;   # 打印1次 0
} while ($i > 0);


$i = 0;
while ($i > 0) :
    echo "\$i is $i.";
endwhile;


echo "<br>";


// do {...} while (0) 在宏定义中的作用
// 总结：Linux和其它代码库里的宏都用do/while(0)来包围执行逻辑，
// 因为它能确保宏的行为总是相同的，而不管在调用代码中使用了多少分号和大括号。

do {
    if ($i < 5) {
        echo "i is not big enough";
        break;
    }
    /* 把语句放在 do-while(0) 之中，在循环内部用 break 语句来结束执行循环。 */

} while(0);


$numbers = [];
$count = 10;
for ($j = 0; $j < $count; $j++) {
    do {
        $random = rand(1, 1000);
    } while($random % 2 == 1);

    $numbers[] = $random;
}
sort($numbers);

echo '<pre>';
print_r($numbers);
echo '</pre>';

/*
Array
(
    [0] => 190
    [1] => 204
    [2] => 304
    [3] => 460
    [4] => 670
    [5] => 694
    [6] => 762
    [7] => 794
    [8] => 914
    [9] => 990
)
*/

$i = 0;
echo 'This code will run at least once because i default value is 0.<br/>';
do {
    echo 'i value is ' . $i . ', so code block will run. <br/>';
    ++$i;
} while ($i < 10);

/*
This code will run at least once because i default value is 0.
i value is 0, so code block will run.
i value is 1, so code block will run.
i value is 2, so code block will run.
i value is 3, so code block will run.
i value is 4, so code block will run.
i value is 5, so code block will run.
i value is 6, so code block will run.
i value is 7, so code block will run.
i value is 8, so code block will run.
i value is 9, so code block will run.
*/


/// foreach循环

/* 两种形式
 *
foreach (array_expression as $value)
    statement
foreach (array_expression as $key => $value)

*/

// 1. 在循环中修改其值将可能导致意外的行为。通过在 $value 之前加上 & (引用赋值) 来修改数组的元素

$array = [91, 92, 93, 94];

// 方式一：
foreach ($array as $value) {
    echo 'value is ' . $value . '<br/>';
}

// 方式二：
foreach ($array as $key => $value) {
    echo "key is $key, value is " . $value . '<br/>';
}

// foreach时安全修改元素的值
foreach ($array as &$value) {
    $value = $value * 2;
    echo '引用赋值 value is ' . $value . '<br/>';
}

// $array is now array(182, 184, 186, 188)
// 注意：数组最后一个元素的 $value 引用在 foreach 循环之后仍会保留。建议使用 unset() 来将其销毁。
unset($value);


echo "<br>";

$array = array("one" => 1, "two" => 2, "three" => 3);
foreach ($array as $k => $v) {
    echo "\$array[$k] => $v <br/>";
}


// 2. 二位数组遍历

$array = array();
$array[0][0] = "a";
$array[0][1] = "b";
$array[1][0] = "c";
$array[1][1] = "d";

foreach ($array as $item) {
    foreach ($item as $value) {
        echo "二位数组:$value <br />\n";
    }
}
/*
二位数组:a
二位数组:b
二位数组:c
二位数组:d
*/

// 3. while 和 foreach

$arr = array("one", "two", "three");
reset($arr);

// 以下代码功能也完全相同：

// 方式一：
while (list($key, $value) = each($arr)) {
    echo "Key:$key ; Value: $value <br />\n";
}

// 方式二：
foreach ($arr as $key => $value) {
    echo "Key:$key ; Value: $value <br />\n";
}

//foreach ($arr as list($key, $value)) { //TODO:
//    echo "a:$key; value:$value <br />\n";       #打印出： a:1;  a:4;
//}

// 3.1 用list()给嵌套的数组解包

$array = [
    [1, 2, 3],
    [4, 5, 6],
];

foreach ($array as list($a, $b, $c)) {
    echo "a:$a; b:$b; c:$c <br />\n";     #打印出： a:1; b:2; c:3  a:4; b:5; c:6
}

// 注意： list() 中的单元可以少于嵌套数组的，此时多出来的数组单元将被忽略：
// 如果 list() 中列出的单元多于嵌套数组则会发出一条消息级别的错误信息：
foreach ($array as list($a)) {
    echo "a:$a; <br />\n";       #打印出： a:1;  a:4;
}

$array = [
    [1, 2, array(3, 4)],
    [3, 4, array(5, 6)],
];

foreach ($array as list($a, $b, list($c, $d))) {
    echo "A: $a; B: $b; C: $c; D: $d;<br>";
}

#打印出： A: 1; B: 2; C: 3; D: 4;
#打印出： A: 3; B: 4; C: 5; D: 6;


// 4. break

// break 结束当前 for，foreach，while，do-while 或者 switch 结构的执行。

$arr = array("one", "two", "three");

foreach ($arr as $value) {

    if ($value == "two") {
        echo "找到了two" . "<br/>";
        break;
    }
    echo "foreach value: $value" . "<br/>";
}

while (list(, $value) = each($arr)) {
    if ($value == "two") {
        echo "找到了two" . "<br/>";
        break;
    }
    echo "while value: $value" . "<br/>";
}

// break 可以接受一个可选的数字参数来决定跳出几重循环。

$i = 0;

while (++$i) {

    switch ($i) {

        case 5:
            echo "At 5 <br/>";
            break 1;             /* 只退出 switch. */

        case 10:
            echo "At 10 <br/>";
            break 2;            /* 退出 switch 和 while 循环 */

        default:
            break;
    }

    echo "++i: $i" . "<br/>";
}

/*
 打印出：

++i: 1
++i: 2
++i: 3
++i: 4
At 5
++i: 5
++i: 6
++i: 7
++i: 8
++i: 9
At 10

*/

// 5. continue

// continue 在循环结构用用来跳过本次循环中剩余的代码并在条件求值为真时开始执行下一次循环。

foreach ($arr as $value) {

    if ($value == "two") {
        echo "找到了two". "<br/>";
        continue;    # 跳过本次循环，并且不执行当前循环后面的代码
    }
    echo "value: $value" . "<br/>";
}

/*
 打印出：

value: one
找到了two
value: three

*/


// continue 接受一个可选的数字参数来决定跳过几重循环到循环结尾。默认值是 1，即跳到当前循环末尾。

$i = 0;

while (++$i) {

    switch ($i) {

        case 5:
            echo "At 5 <br/>";
            continue 1;             /* 跳过1重循环到switch循环结尾，不会打印后面的 ++i: 5 */

        case 8:
            echo "At 8 <br/>";
            continue 2;            /* 跳过2重循环到while循环结尾，不会打印后面的 ++i: 8 */

        case 10:
            echo "At 10 <br/>";
            break 2;                /* 退出 switch 和 while 循环，不会打印后面的 ++i: 10 */

        default:
            echo "++i: $i" . "<br/>";
            break;
    }
}


$stack2 = array('one'=>'first', 'two'=>'second', 'three'=>'third', 'four'=>'fourth', 'five'=>'fifth');
foreach($stack2 AS $k=>$v){
    if($v == 'second')continue;
    if($k == 'three')continue;
    if($v == 'fifth')break;
    echo $k.' ::: '.$v.'<br>';
}

/*
 打印出：

one ::: first
four ::: fourth

*/

function print_primes_between($x,$y)
{
    for($i=$x;$i<=$y;$i++)
    {
        for($j= 2; $j < $i; $j++)  if($i%$j==0) continue 2;
        echo $i.",";
    }
}

print_primes_between(10, 20);   # 打印出 11,13,17,19,


// 6. switch


if ($i == 0) {
    echo "i equals 0";
} elseif ($i == 1) {
    echo "i equals 1";
} elseif ($i == 2) {
    echo "i equals 2";
}

switch ($i)
{
    case 0:
        echo "i equals 0";
        break;
    case 1:
        echo "i equals 1";
        break;
    case 2:
        echo "i equals 2";
        break;

    case '2string':  #
        echo "this is a string";
        break;
}


// 允许使用分号代替 case 语句后的冒号，例如：

switch ($beer)
{
    case 'tuborg';
    case 'carlsberg';
    case 'heineken';
        echo 'Good choice';
        break;
    default;
        echo 'Please make a new selection...';
        break;
}

echo "<br>";

$mixed = 0;
switch ($mixed)
{
    case NULL:
        echo "NULL";   # 打印出 NULL
        break;
    case 0:
        echo "zero";
        break;
    default:
        echo "other";
        break;
}

echo "<br>";

switch(TRUE){
    case (NULL===$mixed):
        echo "NULL===$mixed";
        break;

    case (0 ===$mixed):
        echo "0===$mixed";  # 打印出 0===0
        break;
}

echo "<br>";

$uri = 'http://www.example.com';
switch (true) {
    case preg_match("/$http(s)?/i", $uri, $matches):
        echo $uri . ' is an http/https uri...';
        break;
    case preg_match("/$ftp(s)?/i", $uri, $matches):
        echo $uri . ' is an ftp/ftps uri...';
        break;
    default:
        echo 'default';
        break;
}

// 打印出：http://www.example.com is an http/https uri...


/*
 *  通过年份计算十二生肖
 */
function getChineseZodiac($year)
{
    switch ($year % 12)
    {
        case 0: return 'Monkey 申猴';
        case 1: return 'Rooster  酉鸡';
        case 2: return 'Dog 戌狗';
        case 3: return 'Boar 亥猪';
        case 4: return 'Rat 子鼠';
        case 5: return 'Ox 丑牛';
        case 6: return 'Tiger 寅虎';
        case 7: return 'Rabbit 卯兔';
        case 8: return 'Dragon 辰龙';
        case 9: return 'Snake 巳蛇';
        case 10: return 'Horse 午马';
        case 11: return 'Sheep 未羊';
    }
}

echo 'What animal sign were you born under?';
echo 'I was born in the year of the Sheep.';
echo 'Mine is the Sheep.';

echo '<br/>';

$years = [1990, 1991, 1995, 2013, 2014, 2018];

foreach ($years as $year)
{
    $zodiac = getChineseZodiac($year);
    echo "$year is the $zodiac. <br/>";
}

