<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        session_start();
        // session_destroy();
        if (isset($_SESSION['machine'])) {
            $machine = $_SESSION['machine'];
        } else {
            $_SESSION['machine'] = $machine = rand(1, 10);
            // echo ("Число загадано<br>");
        }   
        if(!isset($_SESSION["checknumb"])){
            $_SESSION["checknumb"] = $checkNumb = [];
        }else{
            $checkNumb = $_SESSION["checknumb"];
        }
        $checkNumb = [];
        if(isset($_POST["vibor"])){
            $numbSelect = $_POST["vibor"];
        }else{
            $numbSelect = 0;
        }
        array_push($_SESSION["checknumb"], $numbSelect);
        if(!in_array($numbSelect, $checkNumb)){
            $checkNumb[] = $numbSelect;
        }
        if (isset($_SESSION['attempts'])) {
            $attempts = $_SESSION['attempts'];
        } else {
            $_SESSION['attempts'] = $attempts = 3;
        }
        if (isset($_SESSION['choice'])) {
            $choice = $_SESSION['choice'];
        } else {
            $_SESSION['choice'] = $choice = [];
        }
        if (isset($_POST["vibor"])) {
                if ($machine == $_POST['vibor']) {
                    echo ("Ви вгадали!");
                    echo ("Число компютера " . $_SESSION['machine'] . "<br>");
                    echo ("Вам залишилося ще $attempts спроб!<br>");
                } else {
                    echo ("Ви не вгадали <br>");
                    array_push($_SESSION['choice'], $_POST['vibor']);
                }
                // var_dump($_SESSION['attempts']);
                $attempts--;
                $_SESSION["attempts"] = $attempts;
                if(!$attempts == 0){
                    echo("Вам залишилось $attempts спроби");
                }else{
                    // echo("Ваші числа:" . $_SESSION['choice'][0] )
                    echo ("Спроби закінчились <br>");
                    echo ("Число компютера " . $_SESSION['machine'] . "<br>");
                }
                // if ($attempts == 0) {
                    //     // echo("Ваші числа:" . $_SESSION['choice'][0] )
                //     echo ("Спроби закінчились <br>");
                //     echo ("Число компютера " . $_SESSION['machine'] . "<br>");
                // } else {
                //     echo ("Залишилося $attempts спроб");
                //     $_SESSION['attempts'] = $attempts;
                // }
            }
            ;
            // for($i = 1; $i < 10; $i++){
                //     echo '<option name="vibor" value="">';
    // }
    ?>
    <form action="index.php" method="post">
        <select name="vibor">
        <?php 
        for($i = 1; $i <= 10; $i++){
            if(!in_array($i, $_SESSION["checknumb"])){
                echo("<option value='$i'>$i</option>");
            }else{
                echo("<option value='$i' disabled>$i неактивно</option>");
            }
        };
        echo("</select>");
        if(!$attempts == 0){
            echo('<button type="submit">Вибрати</button>');
        }else{
            echo('<button type="submit" disabled>Вибрати</button>');
            session_destroy();
        }
        ?>
    </form>
</body>

</html>