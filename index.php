<?php
function getHand(){
        global $names, $players, $scores, $cards;
        for($i = 0; $i < count($players); $i++){
            echo  "<h2>" . $names[$players[$i]] . "<h2/>";
            $total = 0;
            while($total < 42){
                $card = rand(1,52);
                while(in_array($card, $cards)){
                    $card = rand(1,52);
                }
                if(($total+(($card%13 == 0 ? 13 : $card%13))) <= 42){
                    $total += $card % 13;
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
            echo "<h1>"."<span style=color:red>".$total ."</span>". "<h1/>";
            echo "<hr> <hr/>";
            echo "<br>";
        }
    }
?>
