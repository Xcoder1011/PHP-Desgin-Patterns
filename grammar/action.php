<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/4
 * Time: 1:42 PM
 */


$name = $_POST['name'];
$age = $_POST['age'];

// 超全局变量 $_REQUEST，它包含了所有 GET、POST、COOKIE 和 FILE 的数据。
$age = $_REQUEST['age'];


echo "name is : $name</br>\n<br>";
echo "age is : $age";

echo "</br> \n <br>";

echo htmlspecialchars($name);

echo "</br> \n <br>";

?>

你好，<?php echo htmlspecialchars($name) ?>。 你 <?php echo (int)$age ?> 岁了。
