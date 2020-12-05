<h1> Hello World</h1>


<?php
/**
 * Created by PhpStorm.
 * User: wushangkun
 * Date: 2020/12/5
 * Time: 12:58 PM
 */


echo '<p>Hello World</p>';

echo $_SERVER[HTTP_USER_AGENT];

// Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.80 Safari/537.36


if (strpos($_SERVER[HTTP_USER_AGENT], 'Chrome') != FALSE) {

    ?>

    <h3> 混和 HTML 和 PHP 模式</h3>
    <p> 包含了'Chrome'</p>

    <?php
    echo "<br/>\n<br> 正在使用 Chrome Explorer。<br/>\n<br>";
}

// echo phpinfo();

?>


<form action="action.php" method="post">

    <p>姓名： <input type="text" name="name"></p>
    <p>年龄： <input type="text" name="age"></p>
    <p><input type="submit"></p>

</form>
