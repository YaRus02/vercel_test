<!doctype html>
<html>

<head>
    <title>Калькулятор V3</title>
    <meta charset="utf-8">
    <style>
        p {
            font-size: 1.3em;
        }

        .error {
            color: red;
            font-size: 1.5em;
        }

        form>label {
            display: block;
            margin: 5px 10px;
        }

        input {
            padding: 2px;
        }

        fieldset {
            width: 150px;
            margin: 5px 10px
        }

        input[type="submit"] {
            border: 1px solid #a32500;
            background: #efe4bd;
            margin: 5px 10px;
            padding: 4px;
        }
    </style>

</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    ?>
        <form action="l5-2.php" method="post">
            <label>Операнд 1 <input type="text" placeholder="Введите первое число" name="op1"></label>

            <label>Операнд 2 <input type="text" placeholder="Введите второе число" name="op2"></label>
            <fieldset>
                <legend>Вид операции</legend>
                <select name="s1">
                    <option value="+">+</option>
                    <option value="-">-</option>
                    <option value="*">*</option>
                    <option value="/">/</option>
                    <option value="sqrt">sqrt</option>
            </fieldset>
            <input type="submit" value="Вычислить">
            <label>Округление
                <input type="checkbox" name="round">
            </label>
            <label>
                <p style="font-size: 16px;"><input type="radio" name="operand" value="op1">Операнд 1</p>
                <p style="font-size: 16px;"><input type="radio" name="operand" value="op2">Операнд 2</p>
            </label>
        </form>
    <?php
    } else {
        if ((!empty($_POST["op1"]) && !empty($_POST["op2"]) && $_POST["s1"] != "sqrt") || $_POST["s1"] === "sqrt") {
            switch ($_POST["s1"]) {
                case "+":
                    $r = $_POST["op1"] + $_POST["op2"];
                    break;
                case "-":
                    $r = $_POST["op1"] - $_POST["op2"];
                    break;
                case "*":
                    $r = $_POST["op1"] * $_POST["op2"];
                    break;
                case "/":
                    $r = $_POST["op1"] / $_POST["op2"];
                    break;
                case "sqrt":
                    $op_select = $_POST["operand"];
                    if ($op_select === "op1" && !empty($_POST["op1"])) {
                        $r = sqrt($_POST["op1"]);
                    } elseif ($op_select === "op2" && !empty($_POST["op2"])) {
                        $r = sqrt($_POST["op2"]);
                    } else {
                        $r = "Не определен операнд";
                    }
                    break;
                default:
                    $r = "Операция не поддерживается";
            }

            if (isset($_POST["round"])) {
                $r = round($r, 3);
            }
            echo "<p>Результат: $r</p>";
        } else {
            echo <<<EOD
<p class="error">Не все операнды определены</p>
EOD;
        }
    }
    ?>
</body>

</html>