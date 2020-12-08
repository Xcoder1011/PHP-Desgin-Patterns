<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/4
 * Time: 6:37 PM
 */

/// 《Iterable可迭代对象》
///
/// 1. PHP 7.1 中引入的一个伪类型
/// 2. 它接受任何实现了 Traversable 接口的 array 或对象， 这些类型都能用 foreach 迭代
///

// 1.可迭代参数类型示例
function foo1(iterable $iterable) {
    foreach ($iterable as $value) {

    }
}

// 2.可迭代参数默认值
function foo2(iterable $iterable = []) {
    foreach ($iterable as $value) {

    }
}

// 3.方法返回值为可迭代返回类型
function bar():iterable{
    return [1, 2, 3];
}


// 4.可迭代生成器（generators）返回类型
function gen():iterable {
    yield 1;
    yield 2;
    yield 3;  // 将可迭代对象声明为返回类型的函数也可能是 generators。
}

// 5.可迭代类型差异示例

interface Example {
    # 扩展/实现的类可以把使用 array 或 Traversable 作为参数类型扩展为 iterable
    public function method(array $array):iterable;
}

class ExampleImplementation implements Example {
    # 或者把“狭窄”的返回类型从 iterable 扩展为 array 或者 Traversable。
    public function method(array $array): array
    {
        // TODO: Implement method() method.
    }
}


/// 《Object对象》
///
// 1. 要创建一个新的对象 object，使用 new 语句实例化一个类：

class Student {

    public $name;
    public $age;

    function study()
    {
        echo "study";
    }
    public function getName(){
        return $this -> name;
    }

    public function  setAge($a) {
        $this->age = $a;
    }
}

$student = new Student();
$student->study();
print (new Student()) -> getName();
print (new Student()) -> age;


// 2. 转换为对象

// 2.1 如果将一个对象转换成对象，它将不会有任何变化
// 2.2 array 转换成 object 将使键名成为属性名并具有相对应的值。
$obj = (object) array('1'=>'foo');
var_dump(isset($obj->{'1'}));       #  PHP 7.2.0 后输出 'bool(true)'，之前版本会输出 'bool(false)'
var_dump(key($obj));                #  PHP 7.2.0 后输出 'string(1) "1"'，之前版本输出  'int(1)'

// 2.3对于其他值，会包含进成员变量名 scalar。
$obj = (object)'ciao';
echo $obj->scalar;      # outputs 'ciao'


/**
 * This function is used to get object item counts
 * @function getCount
 * @access public
 * @param object|array $var
 * @return integer
 */
function getCount($var) {
    $count = 0;
    if (is_array($var) || is_object($var)) {
        foreach ($var as $value) {
            $count++;
        }
    }
    unset($value);
    return $count;
}

echo "<br>";

if (getCount($obj) === 0) {
    echo 'object is empty'; #expected result
} else {
    echo 'object is not empty'; #unexpected result
}


$test = [Detail => ['name', 'phoneNum', 'college'] , vlues => ['Vincent', '139****0001', 'Pune college']];
$val = json_decode(json_encode($test), false);   # convert array into stdClass object
echo is_array($val)  ? "array" : "not an array";        # "not an array"
echo is_object($val)  ? "object" : "not an object";     # "object"


// array 转 object
function arrayToObject($array) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = arrayToObject($value);
        }
    }
    return (object)$array;
}



echo json_encode([[]]), "\n";
// output: [[]]

echo json_encode([[]], JSON_FORCE_OBJECT), "\n";
// output: {"0":{}}

echo json_encode([(object)[]]), "\n";
// output: [{}]

echo json_encode([0=>"a", 1=>"b", 9=>"c"]), "\n";
// output: {"0":"a","1":"b","9":"c"}

echo json_encode([0=>"a", 1=>"b", 2=>"c"]), "\n";
// output: ["a","b","c"]

echo json_encode((object)[0=>"a", 1=>"b", 2=>"c"]), "\n";
// output: {"0":"a","1":"b","2":"c"}



/// 排序
function objectSort($objectArray, $field)
{
    for ($i = 0; $i < count($objectArray); $i++)
    {
        for ($j = 0; $j < count($objectArray); $j++)
        {
            if ($objectArray[$i] - $field < $objectArray[$j] - $field)
            {
                $temp = $objectArray[$i];
                $objectArray[$i] = $objectArray[$j];
                $objectArray[$j] = $temp;
            }
        }
    }
    return $objectArray;
}

