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

echo "<br/>";

// 2. 从父作用域继承变量

// 静态匿名函数
// 匿名函数允许被定义为静态化。
// 这样可以防止当前类自动绑定到它们身上，对象在运行时也可能不会被绑定到它们上面。

class Foo
{
    public function add($func, $name)
    {
        $this->{$name} = $func;
    }

    public function __call($func, $arguments)
    {
        call_user_func_array($this->{$func} , $arguments);
    }

    public function bar()
    {
        static $anonymous = null;
        if ($anonymous == null)
        {
            $anonymous = function ()
            {
                return $this;
            };
        }
    }

}

// 试图在静态匿名函数中使用 $this

$f = new Foo();

$f->add(function (){
    echo "添加了一个吃饭的方法" . PHP_EOL;
}, "eat");

$f->eat();  # 打印出 "添加了一个吃饭的方法"


$f->add(function (){
    echo "添加了一个睡觉的方法" . PHP_EOL;
}, "sleep");

$f->sleep(); # 打印出 "添加了一个睡觉的方法"


$a = new Foo();
$b = new Foo();


var_dump($a->bar() === $a); # bool(false)
var_dump($b->bar() === $a); # bool(false)


echo "<br/>";


$func = static function()
{
    var_dump("试图将对象绑定到静态匿名函数");
};


function generate_lambda() : Closure
{
    return function ($v = null) {
        static $stored;
        if ($v != null) {
            $stored = $v;
        }
        return $stored;
    };
}

$a = generate_lambda();
$b = generate_lambda();

$c = $b;

$a('test AAA');
$b('test BBB');
$c('test CCC');

// array(3) { [0]=> string(8) "test AAA" [1]=> string(8) "test CCC" [2]=> string(8) "test CCC" }
var_dump([$a(), $b(), $c()]);

echo "<br/>";

/////////////////////

class Fun
{
    protected function debug($message)
    {
        echo "DEBUG: $message" . PHP_EOL;
    }

    public function yield_something($callback)
    {
        return $callback("yield_something");
    }

    public function having_fun()
    {
        $self = & $this;
        return $this->yield_something(function($data) use (&$self){

            $self->debug("having_fun_start");
            /// do something....
            $self->debug("having_fun_end");
        });
    }

    public function __call($method, $args = array())
    {
        if(is_callable(array($this, $method)))
            return call_user_func_array(array($this, $method), $args);
    }
}

$fun = new Fun();
echo $fun->having_fun();


/////////////////////


// 箭头函数  是 PHP 7.4 的新语法，是一种更简洁的 匿名函数 写法。

// 基本语法  fn (argument_list) => expr。

// 1. 箭头函数自动捕捉变量的值

$y = 1;
$fnc1 = fn($x) => $x + $y;
// 相当于 using $y by value:

$fnc2 = function ($x) use ($y) {
    return $x + $y;
};

var_export($fnc1(3));
var_export($fnc2(4));



// 2. 箭头函数自动捕捉变量的值，即使在嵌套的情况下
$z = 1;
$func3 = fn($x) => fn($y) => $x * $y + $z;
// 输出 51
var_export($func3(5)(10));


// 3. 合法的箭头函数例子

fn(array $x) => $x;
static fn(): int => $x;
fn($x = 42) => $x;
fn(&$x) => $x;
fn&($x) => $x;
fn($x, ...$rest) => $rest;


// 4. 来自外部范围的值不能在箭头函数内修改

$x = 1;
$fn = fn() => $x++; // 不会影响 x 的值
$fn();
var_export($x);  // 输出 1
