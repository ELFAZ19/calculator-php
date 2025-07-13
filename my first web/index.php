<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="number1"> Number1</label>
        <input type="number" name="number1" id="number1" required>
        <select name="operation" id="operation">
            <option value="add">Add</option>
            <option value="subtract">Subtract</option>
            <option value="multiply">Multiply</option>
            <option value="divide">Divide</option>
        </select>
        <label for="number2"> Number2</label>
        <input type="number" name="number2" id="number2" required>
        <button>calculate</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number1 = filter_input(INPUT_POST, 'number1', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $number2 = filter_input(INPUT_POST, 'number2', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $operation = htmlspecialchars($_POST['operation']);

    $error = false;

    if (empty($number1) || empty($number2) || empty($operation)){
        echo "<p class='error'>Please fill in all fields.</p>"; 
        $error = true;
    }

    if(!is_numeric($number1) || !is_numeric($number2)) {
        echo "<p class='error'>Please enter valid numbers.</p>";
        $error = true;
    }

    if(!$error) {
        $result = null;
        switch ($operation){
            case "add":
                $result = $number1 + $number2;
                break;
            case "subtract":
                $result = $number1 - $number2;
                break;
            case "multiply":
                $result = $number1 * $number2;
                break;
            case "divide":
                if ($number2 == 0) {
                    echo "<p class='error'>Cannot divide by zero.</p>";
                    break;
                }
                $result = $number1 / $number2;
                break;
            default:
                echo "<p class='error'>Invalid operation selected.</p>";
                break;
        }
        if ($result !== null) {
            echo "<p class='result'>Result: $result</p>";
        }
    }
}
    ?>
</body>
</html>
