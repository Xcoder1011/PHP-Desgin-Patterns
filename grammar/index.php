<?php
/*
 *  PHP: "Hypertext Preprocessor" 超文本预处理器，脚本语言。
 */
echo 'One Final Test'; # This is a one-line shell-style comment
?>


<html>
<head>
    <title> Hypertext Preprocessor </title>
</head>

<body>
<?php
echo 'hello world!';   # 混和 HTML 和 PHP 模式
?>
</body>
</html>


<?php if ($expression == true): ?>
    This will show if the expression is true.
<?php else: ?>
    Otherwise this will show.
<?php endif; ?>

<?php echo 'We omitted the last closing tag' . "</br>\n<br>";


/*
PHP 支持 10 种原始数据类型。

四种标量类型：

bool（布尔型）
int（整型）
float（浮点型，也称作 double)
string（字符串）
四种复合类型：

array（数组）
object（对象）
callable（可调用）
iterable（可迭代）
最后是两种特殊类型：

resource（资源）
NULL（无类型）
*/

$a_bool = TRUE;   // 布尔值 boolean
$an_int = 12;     // 整型 integer

echo gettype($a_bool); // 输出:  boolean

// 如果是整型，就加上 4
if (is_int($an_int)) {
    $an_int += 4;
}

// 如果想查看某个表达式的值和类型，用 var_dump() 函数。
// 如果 $bool 是字符串，就打印出来
// (啥也没打印出来)
if (is_string($a_bool)) {
    echo "String: $a_bool";
}

var_dump((bool)"");        // bool(false)
var_dump((bool)1);         // bool(true)
var_dump((bool)-2);        // bool(true)
var_dump((bool)2.3e5);     // bool(true)
var_dump((bool)array(12)); // bool(true)
var_dump((bool)array());   // bool(false)


var_dump(25 / 7);         // float(3.5714285714286)
var_dump((int)(25 / 7)); // int(3)
var_dump(round(25 / 7));  // float(4)   四舍五入

# echo (int) ( (0.1+0.7) * 10 ); // 显示 7!  #绝不要将未知的分数强制转换为 integer，这样有时会导致不可预料的结果。


$a = 1234; // 十进制数
$a = 0123; // 八进制数 (等于十进制 83) ,  八进制表达，数字前必须加上 0
$a = 0x1A; // 十六进制数 (等于十进制 26) , 十六进制表达，数字前必须加上 0x
$a = 0b11111111; // 二进制数字 (等于十进制 255)   , 二进制表达，数字前必须加上 0b
// $a = 1_234_567; // 整型数值 (PHP 7.4.0 以后)  , 从 PHP 7.4.0 开始，整型数值可能会包含下划线 (_)


/// 《比较浮点数》

// 1.比较两个浮点数是否相等是有问题的
$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001;

// 2.要使用一个仅比该数值大一丁点的最小误差值。该值也被称为机器极小值（epsilon）或最小单元取整数
if (abs($a - $b) < $epsilon) {
    echo "true";
}


/// 《字符串》

// 1.每个字符等同于一个字节, 意味着 PHP 只能支持 256 的字符集, 因此不支持 Unicode
$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001;

// 2.要使用一个仅比该数值大一丁点的最小误差值。该值也被称为机器极小值（epsilon）或最小单元取整数
if (abs($a - $b) < $epsilon) {
    echo "true";
}


// 可以录入多行
echo 'You can also have embedded newlines in 
strings this way as it is
okay to do';

// 输出： Arnold once said: "I'll be back"
echo 'Arnold once said: "I\'ll be back"';   # 转义 \
// 输出： You deleted C:\*.*?
echo 'You deleted C:\\*.*?';   # 要表达一个反斜线自身，则用两个反斜线（\\）


// 如果字符串是包围在双引号（"）中， PHP 将对一些特殊的字符进行解析：
/*

\n	换行（ASCII 字符集中的 LF 或 0x0A (10)）
\r	回车（ASCII 字符集中的 CR 或 0x0D (13)）
\t	水平制表符（ASCII 字符集中的 HT 或 0x09 (9)）
\v	垂直制表符（ASCII 字符集中的 VT 或 0x0B (11)）（自 PHP 5.2.5 起）
\e	Escape（ASCII 字符集中的 ESC 或 0x1B (27)）（自 PHP 5.4.0 起）
\f	换页（ASCII 字符集中的 FF 或 0x0C (12)）（自 PHP 5.2.5 起）
\\	反斜线
\$	美元标记
\"	双引号

*/


/// 《Heredoc 结构的字符串示例 : <<< 》

$str = <<<EOD
Example of string
spanning multiple lines
using heredoc syntax.
EOD;

class Foo
{
    var $foo;
    var $bar;

    const  BAR = <<<FOOBAR
Heredoc结构初始化类的常量
FOOBAR;

    public $baz = <<<FOOBAR
Heredoc结构初始化类的属性
FOOBAR;

    //
    static $staticBar1 = <<<LABEL
使用Heredoc结构来初始化静态变量
LABEL;

    function foo()
    {
        $this->foo = 'Foo';
        $this->bar = array('Bar1', 'Bar2', 'Bar3');

    }

}

$foo = new Foo();
$name = 'MyName';

$bar3 = $foo::BAR;
echo "BAR is $bar3 \n";


// 在 heredoc 结构中使用双引号
echo <<<"EOD"
My name is "$name". I am printing some $foo->foo.
Now, I am printing some {$foo->bar[1]}.
This should print a capital 'A'
EOD;


/// 《Nowdoc结构的字符串示例 : <<<'EOT' 》

// Nowdoc 结构是类似于单引号字符串的
// 但是 nowdoc 中不进行解析操作
$str = <<<'EOD'
Example of string
spanning multiple lines
using nowdoc syntax.
EOD;

/*

// 有效，只有通过花括号语法才能正确解析带引号的键名
echo "This works: {$arr['key']}";

echo "This is wrong: {$arr[foo][3]}";  ❌

// 有效，当在字符串中使用多重数组时，一定要用括号将它括起来
echo "This works: {$arr['foo'][3]}";  # ✅

// 有效
echo "This works: " . $arr['foo'][3]; # ✅

echo "This works too: {$obj->values[3]->name}"; # ✅
*/


// 取得字符串的第一个字符
$str = 'This is a test.';
$first = $str[0];

// 取得字符串的第三个字符
$third = $str[2];

// 取得字符串的最后一个字符
$str = 'This is still a test.';
$last = $str[strlen($str) - 1];

// 修改字符串的最后一个字符
$str = 'Look at the sea';
$str[strlen($str) - 1] = 'e';

echo "last str is $str \n";


/// 《转换成字符串》
///
// 一个值可以通过在其前面加上 (string) 或用 strval() 函数来转变成字符串。


/// 《字符串转换为数值》
///
// 如果该字符串没有包含 '.'，'e' 或 'E' 并且其数字值在整型的范围之内，该字符串将被当成 integer 来取值。
// 其它所有情况下都被作为 float 来取值。
$foo = 1 + "10.5";                // $foo is float (11.5)
$foo = 1 + "-1.3e3";              // $foo is float (-1299)
$foo = 1 + "bob-1.3e3";           // $foo is integer (1)
$foo = 1 + "bob3";                // $foo is integer (1)
$foo = 1 + "10 Small Pigs";       // $foo is integer (11)
$foo = 4 + "10.2 Little Piggies"; // $foo is float (14.2)
$foo = "10.0 pigs " + 1;          // $foo is float (11)
$foo = "10.0 pigs " + 1.0;        // $foo is float (11)

echo "\$foo==$foo; type is " . gettype($foo) . "<br />\n";



/// 《NULL值》
///
///  NULL 值表示一个变量没有值
///  NULL 类型只有一个值，就是不区分大小写的常量 NULL。
/// 在下列情况下一个变量被认为是 NULL：
/// 1. 被赋值为 NULL。
/// 2. 尚未被赋值。
/// 3. 被 unset()。

$var = NULL;

// 使用 (unset) $var 将一个变量转换为 null 将不会删除该变量或 unset 其值。仅是返回 NULL 值而已。

$emptyArray = array();
var_dump($emptyArray == null);   # bool(true)
var_dump($emptyArray === null);  # bool(false)
var_dump(is_null($emptyArray));             # bool(false)

var_dump(null == 0);               # bool(true)
var_dump(null === 0);              # bool(false)


/// 《常量》
///
/// define() , const


define('DEBUG',false);
if (DEBUG) {

}

// 合法的常量名
define('MIN_VALUE', '0.0');   // RIGHT - Works OUTSIDE of a class definition.
define('MAX_VALUE', '1.0');   // RIGHT - Works OUTSIDE of a class definition.

echo MIN_VALUE;   # 0.0

//const MIN_VALUE = 0.0;         RIGHT - Works both INSIDE and OUTSIDE of a class definition.
//const MAX_VALUE = 1.0;         RIGHT - Works both INSIDE and OUTSIDE of a class definition.

class Constants
{
    //define('MIN_VALUE', '0.0');  WRONG - Works OUTSIDE of a class definition.
    //define('MAX_VALUE', '1.0');  WRONG - Works OUTSIDE of a class definition.

    const  MAX_PHOTOS_COUNT = 100;
    public const MIN_PHOTOS_COUNT =1;

    public static  function getMaxPhotosCount()
    {
        return self::MAX_PHOTOS_COUNT;
    }
}

define('LOCATOR',   "/locator");
define('CLASSES',   LOCATOR."/code/classes");
define('FUNCTIONS', LOCATOR."/code/functions");
define('USERDIR',   LOCATOR."/user");

require_once(FUNCTIONS."/database.fnc");
require_once(FUNCTIONS."/randchar.fnc");

$usermap = USERDIR."/".$userid.".png";


const CONSTANT = 'Hello World';

// PHP 5.6.0 后的写法
const ANOTHER_CONST = CONSTANT . '; Goodbye World';
const ANIMALS = array('dog', 'cat', 'bird');
echo ANIMALS[1]; // 将输出 "cat"

const QUARTLIST=array('1. Quarter'=>array('jan','feb','mar'),'2.Quarter'=>array('may','jun','jul'));


// PHP 7 中的写法
define('ANIMALS', array(
    'dog',
    'cat',
    'bird'
));
echo ANIMALS[1]; // 将输出 "cat"


// const ArrayFromTextfile = file("mytextfile.txt", FILE_IGNORE_NEW_LINES);   # ❌

define ("ArrayFromTextfile", file("mytextfile.txt", FILE_IGNORE_NEW_LINES));  # ✅

print_r(ArrayFromTextfile);


/// 《魔术常量》
/*

__LINE__	文件中的当前行号。
__FILE__	文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名。
__DIR__	文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。它等价于 dirname(__FILE__)。除非是根目录，否则目录中名不包括末尾的斜杠。
__FUNCTION__	当前函数的名称。匿名函数则为 {closure}。
__CLASS__	当前类的名称。类名包括其被声明的作用区域（例如 Foo\Bar）。注意自 PHP 5.4 起 __CLASS__ 对 trait 也起作用。当用在 trait 方法中时，__CLASS__ 是调用 trait 方法的类的名字。
__TRAIT__	Trait 的名字。Trait 名包括其被声明的作用区域（例如 Foo\Bar）。
__METHOD__	类的方法名。
__NAMESPACE__	当前命名空间的名称。
ClassName::class	完整的类名
*/

class base_class
{
    function say_a()
    {
        # echo __FUNCTION__;
        echo "'a' - said the " . __CLASS__ . "<br/>";
    }

    function say_b()
    {
        # echo __METHOD__;
        echo "'b' - said the " . get_class($this) . "<br/>";
    }
}

class derived_class extends base_class
{
    public function say_a()
    {
        parent::say_a();
        echo "'a' - said the " . __CLASS__ . "<br/>";
    }

    public function say_b()
    {
        parent::say_b();
        echo "'b' - said the " . get_class($this) . "<br/>";
    }
}

$obj_b = new derived_class();

$obj_b->say_a();

echo "<br/>";

$obj_b->say_b();

/* 输出

'a' - said the base_class
'a' - said the derived_class

'b' - said the derived_class
'b' - said the derived_class

*/