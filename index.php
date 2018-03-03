<?php
session_start(); 
$_SESSION['timer'] = microtime() * 1000;
$names = array("Rick", "Morty", "Mr. Meeseeks", "Mr. Poopybutthole");
shuffle($names);

    $players = array();
    $scores = array();
    $cards = array();

function getPlayers($num){
        global $names, $players;
        
        $players = array_rand($names, $num);
    }

function getHand(){
        global $names, $players, $scores, $cards;
        for($i = 0; $i < count($players); $i++){
            echo  "<h2>" . $names[$players[$i]] . "<h2/>";
            
            if($names[$players[$i]] == "Rick")
            {
                echo "<img id = 'playerImg' src = 'img/rick.png' alt = 'Rick' />";
            }
            else if($names[$players[$i]] == "Morty")
            {
                echo "<img id = 'playerImg' src = 'img/morty.png' alt = 'Morty' />";
            }
            else if($names[$players[$i]] == "Mr. Meeseeks")
            {
                echo "<img id = 'playerImg' src = 'img/mrmeeseeks.png' alt = 'Mr. Meeseeks' />";
            }
            else if($names[$players[$i]] == "Mr. Poopybutthole")
            {
                echo "<img id = 'playerImg' src = 'img/mrpoopy.png' alt = 'Mr. Poopybutthole' />";
            }
            
            $total = 0;
            while($total < 42){
                $card = rand(1,52);
                while(in_array($card, $cards)){
                    $card = rand(1,52);
                }
                if(($total+(($card%13 == 0 ? 13 : $card%13))) <= 42){
                    $total += $card % 13;
                    if($card%13 == 0){
                           $total+=13;
                        }
                    if($card < 14){
                        echo "<img src='img/cards/clubs/" . $card . ".png'>";
                    }
                    else if($card < 27){
                        echo "<img src='img/cards/diamonds/" . ($card%13 == 0 ? 13 : $card%13) . ".png'>";
                    }
                    else if($card < 40){
                        if($card%13 == 0){
                            $card = 13;
                        }
                        echo "<img src='img/cards/hearts/" . ($card%13 == 0 ? 13 : $card%13) . ".png'>";
                    }
                    else{
                        if($card%13 == 0){
                            $card = 13;
                        }
                        echo "<img src='img/cards/spades/" . ($card%13 == 0 ? 13 : $card%13) . ".png'>";
                    }
                    $cards[] = $card;
                }
                else{
                    break;
                }
            }
            $scores[] = $total;
            echo "<h2>"."<span style=color:red>"."Score: "."$total"."</span>"."<h2/>";
            echo "<hr> <hr/>";
            echo "<br>";
        }
    }
    function getWinner(){
    global $players,$names, $scores;
    $winner =  array ();
    $dontAddScore = array();
    $scorewinner  = $scores[0]; 
    for($i =0;$i <4; $i++){
         if($scorewinner==$scores[$i]){
            array_push($winner,$names[$i]);
        }
        
        else if($scorewinner<$scores[$i]){
            if(count($winner)>1){
                $winner = array();
               
            }
             $scorewinner = $scores[$i];
           $replacement = array(0=>$names[$i]);
            $winner = array_replace($winner,$replacement);
        }
       
        
    }
$winningscore = 0;
for($i=0;$i < 4;$i++){
    for($ii = 0; $ii<=count($winner);$ii++){
    if($names[$i]==$winner[$ii]){
        $winningscore = $winningscore + $scores[$i];
        
    }
    }
}

$pointsEarned = 0;
for($i = 0;$i < 4; $i++){
    $pointsEarned = $pointsEarned + $scores[$i];
}
$pointsEarned = $pointsEarned-$winningscore;
 $pointsEarned = $pointsEarned/count($winner);
       
         for($i=0; $i <= count($winner); $i++)
         { 
            echo "<h1> $winner[$i] ";
         }
         echo " wins $pointsEarned points! </h1>";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Rick and Morty Silver Jack </title>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Candal" rel="stylesheet">
        <style>
            @import url("css/styles.css");
            
        </style>
    </head>
    <body>
        
        <header>
            <img id = "title" src = "img/rick-and-morty-silver-jack.png" alt = "Rick and Morty Silver Jack">
        </header>
        
        <div id="main">
    
            <?php
                getPlayers(4);
                getHand();
                getWinner();
                $_SESSION['timer2'] = microtime() * 1000;
            ?>

        </div>
        
            <form>
                <input type = "submit" value = "Play Again?">
            </form>
        
    </body>
    
    <footer>
        <br/><br/><br/>
        CST 336 Internet Programming 2018&copy; Funaki, Martinez, Peppmuller, Vucinich <br />
        <strong> Disclaimer: </strong> This information on this webpage is used only for academic purposes. <br />
        Time taken to load: <?= round (($_SESSION['timer2'] - $_SESSION['timer'])[, int $precision = 4 [, int $mode = PHP_ROUND_HALF_UP ]] )?> seconds <br/>
    </footer>
</html>