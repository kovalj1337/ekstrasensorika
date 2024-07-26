<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($_POST) {
        session_start();
        if(isset($_SESSION['attempts'])){
            $attempts = $_SESSION['attempts'];
        }else{
            $_SESSION['attempts'] = $attempts = 3;
        }
        if(!$attempts < 1){
            if(isset($_SESSION['choice'])){
                $choice = $_SESSION['choice'];
            }else{
                $_SESSION['choice'] = $choice = [];
            }
            if(isset($_SESSION['machine'])){
                $machine = $_SESSION['machine'];
            }else{
                $_SESSION['machine'] = $machine = rand(1, 10);
                echo ("Число загадано<br>");
            }
            if (isset($_POST["vibor"])) {
                if ($machine == $_POST['vibor']) {
                    echo ("Ви вгадали!");
                    echo("Число компютера " . $_SESSION['machine'] . "<br>");
                    echo("Вам залишилося ще $attempts спроб!<br>");
                    session_destroy();
                } else {
                    echo ("Ви не вгадали <br>");
                    array_push($_SESSION['choice'], $_POST['vibor']);
                }
            }
            $attempts--;
            echo("Залишилося $attempts спроб");
            $_SESSION['attempts'] = $attempts;
            var_dump($_SESSION['attempts']);
        }else{
            // echo("Ваші числа:" . $_SESSION['choice'][0] )
            echo("Спроби закінчились <br>");
            echo("Число компютера " . $_SESSION['machine'] . "<br>");
            session_destroy();
        };
        // for($i = 1; $i < 10; $i++){
        //     echo '<option name="vibor" value="">';
        // }
    }
    ?>
    <form action="index.php" method="post">
        <select name="vibor">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select>
        <button type="submit">Вибрати</button>
        <input type="submit" name="" id="">
    </form>
</body>

</html>