<!DOCTYPE html>
<html>
<head>
    <title>بررسی کد ملی</title>
</head>
<body>
    <h1>بررسی کد ملی</h1>
    <form method="post" action="">
        <label for="nationalCode">کد ملی:</label>
        <input type="text" id="nationalCode" name="nationalCode" placeholder="کد ملی را وارد کنید" required>
        <br>
        <button type="submit">بررسی</button>
    </form>

    <?php
    function check_national_code($code)
    {
        if(!preg_match('/^[0-9]{10}$/',$code))
            return false;
        for($i=0;$i<10;$i++)
            if(preg_match('/^'.$i.'{10}$/',$code))
                return false;
        for($i=0,$sum=0;$i<9;$i++)
            $sum+=((10-$i)*intval(substr($code, $i,1)));
        $ret=$sum%11;
        $parity=intval(substr($code, 9,1));
        if(($ret<2 && $ret==$parity) || ($ret>=2 && $ret==11-$parity))
            return true;
        return false;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nationalCode = $_POST['nationalCode'];

        $result = check_national_code($nationalCode);

        if ($result) {
            echo "<p>کد ملی معتبر است.</p>";
        } else {
            echo "<p>کد ملی نامعتبر است.</p>";
        }
    }
    ?>
</body>
</html>