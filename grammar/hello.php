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

if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
    echo '<pre>';

    print_r($_POST);

    echo '<a href="'. $_SERVER['PHP_SELF'].'"> Please try again </a>';

    echo '</pre>';
} else {

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        Name:  <input type="text" name="personal[name]"><br />
        Email: <input type="text" name="personal[email]"><br />
        Beer: <br>
        <select multiple name="beer[]">
            <option value="warthog">Warthog</option>
            <option value="guinness">Guinness</option>
            <option value="stuttgarter">Stuttgarter Schwabenbr</option>
        </select><br />
        <input type="hidden" name="action" value="submitted" />
        <input type="submit" name="submit" value="submit me!" />
    </form>

    <?php

}

?>


<form action="action.php" method="post">

    <p>姓名： <input type="text" name="name"></p>
    <p>年龄： <input type="text" name="age"></p>
    <p><input type="submit"></p>

</form>


<?php

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
