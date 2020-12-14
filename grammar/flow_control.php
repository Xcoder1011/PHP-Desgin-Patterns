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