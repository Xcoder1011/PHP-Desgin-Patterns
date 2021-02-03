<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2021/1/6
 * Time: 7:22 PM
 */

class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class Father
{

    public $name = 'wushangkun';

    public $age;

    public function getName(): string
    {
        return $this->name;
    }

    public function printName()
    {
        echo $this->name;
    }


    // 如果父类定义方法时使用了 final，则该方法不可被子类覆盖。

    final function objectFunction()
    {
        A::foo();
    }

    static function getNew()
    {
        return new static;
    }

    public function __construct()
    {
        $this->age = function () {
            return 29;
        };
    }
}

/// 单继承
class Son extends Father
{
    // 同样名称的方法，将会覆盖父类的方法
    // 如果父类定义方法时使用了 final，则该方法不可被子类覆盖
    public function printName()
    {
        // 可以通过 parent:: 来访问被覆盖的方法或属性。
        echo "Son printName\n";
        parent::printName();
    }

}



$a = new A();
$a->foo();  # $this is defined (A)

$b = new Father();
$b->objectFunction();  # $this is not defined.

Father::objectFunction();   # $this is not defined.

Father::getNew();


echo "<br/>";

/// 1.对象赋值

$assigned = $b; // 当把一个对象已经创建的实例赋给一个新变量时，新变量会访问同一个实例，就和用该对象赋值一样。

$reference = & $b;  // 可以用 克隆 给一个已创建的对象建立一个新实例。

$b->name = 'assigned';

echo ($b->age)(), PHP_EOL;   # 29

$b = null;

var_dump($b);            # NULL
var_dump($reference);    # NULL
var_dump($assigned);     # object(B)#2 (1) { ["name"]=> string(8) "assigned" }


echo "<br/>";

/// 2.单继承
///
$father = new Father();
$son = new Son();
var_dump($son == $father);  # bool(false)

$child1 = Father::getNew();
var_dump($child1 instanceof Father);  # bool(true)

$child2 = Son::getNew();
var_dump($child2 instanceof Son);  # bool(true)

$son->printName();


/// 3. Nullsafe 操作符  ?->     自 PHP 8.0.0 起可用
///
// 类似于在每次访问前使用 is_null() 函数判断方法和属性是否存在，但更加简洁。

//$result = $repository?->getUser(5)?->name;
//
//// 上边那行代码等价于以下代码
//if (is_null($repository)) {
//    $result = null;
//} else {
//    $user = $repository->getUser(5);
//    if (is_null($user)) {
//        $result = null;
//    } else {
//        $result = $user->name;
//    }
//}


class Customer {

    protected $host = 'localhost';
    protected $user = 'user';
    protected $password = 'pass';
    protected $database = 'db';
    protected $time;

    public $name;
    public $address;
    protected $age = 12;
    static $job;
}

class Item {

    // 类常量
    const c1 = 'cell_identity1';

    public $name, $price, $qty, $total;

    function showConstant() {

        echo self::c1 . PHP_EOL;
    }
}

echo Item::c1 . PHP_EOL;

class MyTimer {

    // 类常量
    const SEC_PER_DAY = 60 * 60 * 24;
}

abstract class PropertyObject
{
    public function __get($name)
    {
        if (method_exists($this, ($method = 'get_'.$name)))
        {
            return $this->$method();
        }
        else return;
    }

    public function __isset($name)
    {
        if (method_exists($this, ($method = 'isset_'.$name)))
        {
            return $this->$method();
        }
        else return;
    }

    public function __set($name, $value)
    {
        if (method_exists($this, ($method = 'set_'.$name)))
        {
            $this->$method($value);
        }
    }

    public function __unset($name)
    {
        if (method_exists($this, ($method = 'unset_'.$name)))
        {
            $this->$method();
        }
    }
}

abstract class DBObject
{
    const TABLE_NAME = 'db_cache';

    public static function queryAllData()
    {
        $c = get_called_class();
        return "SELECT * FROM `".$c::TABLE_NAME."`";
    }
}

class AdminObject extends DBObject
{
    const TABLE_NAME = 'admin_cache';
}

class StudentObject extends DBObject
{
    const TABLE_NAME = 'student_cache';
}





