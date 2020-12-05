<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/4
 * Time: 5:10 PM
 */

/// 《Array数组》
///
/// 1. PHP 中的数组实际上是一个有序映射。映射是一种把 values 关联到 keys 的类型。
/// 2. 可以把它当成真正的数组，或列表（向量），散列表（是映射的一种实现），字典，集合，栈，队列


/*  语法： 接受任意数量用逗号分隔的 键（key） => 值（value）对
 *
 * array(  key =>  value
     , ...
     )
 *
 *  键（key）  可以是一个整数 integer 或字符串 string
 *  值（value）可以是任意类型的值
 */

$arr1 = array(
    "key1" => "value1",
    "key2" => "value2",
);

// 自 PHP 5.4 起
$arr2 = [
    "key1" => "value1",
    "key2" => "value2",
];

/*
此外 key 会有如下的强制转换：

包含有合法整型值的字符串会被转换为整型。例如键名 "8" 实际会被储存为 8。但是 "08" 则不会强制转换，因为其不是一个合法的十进制数值。
浮点数也会被转换为整型，意味着其小数部分会被舍去。例如键名 8.7 实际会被储存为 8。
布尔值也会被转换成整型。即键名 true 实际会被储存为 1 而键名 false 会被储存为 0。
Null 会被转换为空字符串，即键名 null 实际会被储存为 ""。
数组和对象不能被用为键名。坚持这么做会导致警告：Illegal offset type。
*/

$arr3 = array(
    1 => "a",
    "1" => "b",
    1.5 => "c",
    true => "d",
);
var_dump($arr3);   // array(1) { [1]=> string(1) "d" }

// 上例中所有的键名都被强制转换为 1，则每一个新单元都会覆盖前一个的值，最后剩下的只有一个 "d"。


// 混合 integer 和 string 键名
$arr4 = array(
    "foo" => "bar",
    "bar" => "foo",
    100 => -100,
    -100 => 100,
);
var_dump($arr4);


// 没有键名的索引数组
$arr5 = array("foo", "bar", "hello", "world");
// key 为可选项。如果未指定，PHP 将自动使用之前用过的最大 integer 键名加上 1 作为新的键名。
var_dump($arr5); # array(4) { [0]=> string(3) "foo" [1]=> string(3) "bar" [2]=> string(5) "hello" [3]=> string(5) "world" }


// 仅对部分单元指定键名
$arr6 = array(
    "a",
    "b",
    6 => "c",
    "d",
);
var_dump($arr6);

/* 以上例程会输出：

array(4) {
    [0]=>
  string(1) "a"
    [1]=>
  string(1) "b"
    [6]=>
  string(1) "c"
    [7]=>
  string(1) "d"     #最后一个值 "d" 被自动赋予了键名 7。这是由于之前最大的整数键名是 6。
}
*/


// 通过 array[key] 语法来访问。

$arr7 = [
    'name' => 'wushangkun',
    'phone' => '150****0001',
    'address' => [
        1 => 'Shanghai',
        2 => 'Beijing',
    ]
];

var_dump($arr7['name']);
var_dump($arr7['address'][1]);
var_dump($arr7{'address'}{2});  # 方括号和花括号可以互换


$arr6[] = 'e';     # 等同于  $arr6[8] = 'e';  如果没有指定键名，则取当前最大整数索引值，新的键名将是该值加上 1（但是最小为 0）。如果当前还没有整数索引，则键名将为 0。
$arr6["x"] = '10'; # 添加了新单元，键名为 "x"

unset($arr7[8]);   # 删除某键值对
unset($arr7);      # 删除所有键值对


/// 注意！！！  最大整数键名不一定当前就在数组中。它只要在上次数组重新生成索引后曾经存在过就行了。

// 创建一个简单的数组
$array = array(1, 2, 3, 4, 5);
print_r($array);

// 现在删除其中的所有元素，但保持数组本身不变:
foreach ($array as $i => $value) {
    unset($array[$i]);   # unset() 函数允许删除数组中的某个键。但要注意数组将不会重建索引。
}
print_r($array);

// 添加一个单元（注意!!! 新的键名是 5，而不是你可能以为的 0）
$array[] = 6;
print_r($array);

// array_values()重新索引：
$array = array_values($array);
$array[] = 7;
print_r($array);


/* 以上例程会输出：

Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => 4
    [4] => 5
)
Array
(
)
Array
(
    [5] => 6
)
Array
(
    [0] => 6
    [1] => 7
)

*/


$switching = array(
    10,         // key = 0
    5 => 6,
    3 => 7,
    'a' => 4,
    11,         // key = 6 (maximum of integer-indices was 5)
    '8' => 2,   // key = 8 (integer!)
    '02' => 77, // key = '02'
    0 => 12     // the value 10 will be overwritten by 12
);

foreach ($switching as $key => $value) {
    if ($value == 77) {
        echo "value为77的键索引为$key";
    }
}


/// 使用 引用运算符& 来拷贝数组

$switching2 = $switching;
$switching2[] = 88;         # $switching2已经改变了， 但是此时 $switching 并没有改变

$switching3 = &$switching;
$switching3[] = 99;         # 此时$switching3 和 $switching 相同
