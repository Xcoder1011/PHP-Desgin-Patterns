<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/8
 * Time: 8:48 PM
 */

/// 《变量》

// PHP 中的变量用一个美元符号后面跟变量名来表示。
// 变量名是区分大小写的。
// 一个有效的变量名由字母或者下划线开头，后面跟上任意数量的字母，数字，或者下划线。

// 1.1 变量默认总是传值赋值。
// 当一个变量的值赋予另外一个变量时，改变其中一个变量的值，将不会影响到另外一个变量

// 1.2 引用赋值。
// 换言之，“成为其别名” 或者 “指向”, 改动新的变量将影响到原始变量，反之亦然。

$foo = 'Bob';              // 将 'Bob' 赋给 $foo
$bar = &$foo;              // 通过 $bar 引用 $foo
$bar = "My name is $bar";  // 修改 $bar 变量
echo $bar;
echo $foo;                 // $foo 的值也被修改



// 1.3 注意！！！ 只有有名字的变量才可以引用赋值。

$foo = 25;
$bar = &$foo;      // 合法的赋值
# $bar = &(24 * 7);  // 非法; 引用没有名字的表达式

function test()
{
    return 25;
}

# $bar = &test();    // 非法

// 1.4

print isset($a); // $a is not set. Prints false. (Or more accurately prints ''.)
$b = 0; // isset($b) returns true (or more accurately '1')
$c = array(); // isset($c) returns true
$b = null; // Now isset($b) returns false;
unset($c); // Now isset($c) returns false;




/// 2. 变量范围
/// 大部分的 PHP 变量只有一个单独的范围

$a = 1;
$b = 2;

include 'c.inc';  #这里变量 $a,$b 将会在包含文件 c.inc 中生效


/// 2.1 global 关键字

function logAction1()
{
//    echo $a;   # 脚本不会有任何输出,  引用了一个局部版本的变量 $a，而且在这个范围内，它并没有被赋值。
}

function logAction2()
{
    global $a, $b;  # PHP 中全局变量在函数中使用时必须声明为 global。

    $b = $a + $b;
    echo $b;   # 脚本有输出, “3”

}

// $GLOBALS 数组
// $GLOBALS 是一个超全局变量,
// $GLOBALS 是一个关联数组，每一个变量为一个元素，键名对应变量名，值对应变量的内容。
// 在全局范围内访问变量的第二个办法，是用特殊的 自定义 $GLOBALS 数组。

function logAction3()
{
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];  // 等价于上面的方法

}

logAction();


function test_global() {

    // 大多数的预定义变量并不 "super"，它们需要用 'global' 关键字来使它们在函数的本地区域中有效。
    global $HTTP_POST_VARS;

    echo $HTTP_POST_VARS['name'];

    // Superglobals 在任何范围内都有效，它们并不需要 'global' 声明。Superglobals 是在 PHP 4.1.0 引入的。
    echo $_POST['name'];
}


/// 2.2 静态变量
///
function test_static_variable1()
{
    static $a = 0; # 静态声明是在编译时解析的。
    echo $a;
    $a++;
}

function test_static_variable2()
{
    static $count = 0;

//    static $count = 1+2;        #  ❌ wrong  (as it is an expression)
//    static $count = sqrt(121);  #  ❌ wrong  (as it is an expression too)

    $count++;
    echo $count;

    if ($count < 10) {
        test_static_variable2();
    }

    $count--;
}



/// 2.3 对于变量的 static 和 global 定义是以引用的方式实现的，能导致预料之外的行为
///

function test_global_ref() {
    global $obj;
    $obj = &new stdclass;
}

function test_global_noref()
{
    global $obj;
    $obj = new stdclass;
}

test_global_ref();
var_dump($obj);        # NULL
test_global_noref();
var_dump($obj);        # object(stdClass)(0) {}


// 当把一个引用赋值给一个静态变量时，第二次调用 &get_instance_ref() 函数时其值并没有被记住。

function &get_instance_ref()
{
    static $obj;

    echo 'Static object: ';
    var_dump($obj);
    if (!isset($obj)) {
        // 将一个引用赋值给静态变量
        $obj = &new stdclass;
    }
    $obj->property++;
    return $obj;
}

function &get_instance_noref()
{
    static $obj;

    echo 'Static object: ';
    var_dump($obj);
    if (!isset($obj)) {
        // 将一个对象赋值给静态变量
        $obj = new stdclass;
    }
    $obj->property++;
    return $obj;
}

$obj1 = get_instance_ref();
$still_obj1 = get_instance_ref();
echo "\n";
$obj2 = get_instance_noref();
$still_obj2 = get_instance_noref();

/*
 *
以上例程会输出：

Static object: NULL
Static object: NULL

Static object: NULL
Static object: object(stdClass)(1) {
    ["property"]=>
int(1)
}

*/


/// 3. 预定义变量
///
/// PHP 指令 register_globals 的默认值为 off

function long_to_GET(){
    /**
     * This function converts info.php/a/1/b/2/c?d=4 TO
     * Array ( [d] => 4 [a] => 1 [b] => 2 [c] => )
     **/
    if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != ''){
        //Split it out.
        $tmp = explode('/',$_SERVER['PATH_INFO']);
        //Remove first empty item
        unset($tmp[0]);
        //Loop through and apend it into the $_GET superglobal.
        for($i=1;$i<=count($tmp);$i+=2){ $_GET[$tmp[$i]] = $tmp[$i+1];}
    }
}


if (isset($_SERVER['HTTP_REFERER'])) { // If set, this page is running in a frame
    $uri = parse_url($_SERVER['HTTP_REFERER']); // grab URI of parent frame
    $querystring = ($uri['query']) ? $uri['query'] : false; // grab the querystring
    if ($querystring) {
        $vars = explode('&', $querystring); // cut into individual statements
        foreach ($vars as $varstring) { // populate $_GET
            $var = explode('=', $varstring);
            if (count($var) == 2) $_GET[$var[0]] = $var[1];
        }
    } // no, nothing to report from the parent frame
} //



$allowed_args = ',f_name,l_name,subject,msg,';

foreach(array_keys($_POST) as $k) {
    $temp = ",$k,";
    if(strpos($allowed_args,$temp) !== false) { $$k = $_POST[$k]; }
}

function Example($Variable_Name='_POST') {
    print_r($$Variable_Name);
} // End Example

function WorkingExample($Variable_Name='_POST') {
    global $$Variable_Name;
    print_r($$Variable_Name);
} // End WorkingExample()




$_GET['avar'] = 'b';
print_r($_GET); print('<br>');
print_r($_REQUEST);



if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
    if ($_SERVER["HTTP_CLIENT_IP"]) {
        $proxy = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        $proxy = $_SERVER["REMOTE_ADDR"];
    }
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    if ($_SERVER["HTTP_CLIENT_IP"]) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
}

echo "Your IP $ip<BR>\n";
if (isset($proxy)) {
    echo "Your proxy IP is $proxy<BR>\n";
}

