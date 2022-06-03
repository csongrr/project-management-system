<?php

    function GetDaJoke(){

        $vicc= file_get_contents('https://api.chucknorris.io/jokes/random');
        $vicc= json_decode($vicc);
        echo($vicc->value);
    }
?>