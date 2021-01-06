<?php

class Diskuze {

   

    public $slovnik = [
        ':)' => '<img src="obrazky/smajlici/smile.png">',
        ':-o' => '<img src="obrazky/smajlici/surprised.png">',
        ':-p' => '<img src="obrazky/smajlici/tongue.png">',
        ':-P' => '<img src="obrazky/smajlici/tongue.png">',
        ':(' => '<img src="obrazky/smajlici/unhappy.png">',
        ':D' => '<img src="obrazky/smajlici/grin.png">',
        '.)' => '<img src="obrazky/smajlici/wink.png">',
    ];


    public function zapis($prezdivka, $zprava){
     
        Databaze::dotaz('
        INSERT INTO `diskuze`
        (`prezdivka`, `zprava`, `datum`)
        VALUES(?, ?, ?)
        ', array($prezdivka, $zprava, time()));
    }
    
    public function formatZpravy($zprava){
        $zprava = nl2br($zprava);
        return strtr($zprava, $this->slovnik);
    }

    public function vyberZpravy(){
        $vysledek = Databaze::dotaz('
        SELECT `prezdivka`, `zprava`, `datum` FROM `diskuze` ORDER BY `datum` DESC LIMIT 10
        ');
        return $vysledek;
    }

    public function formatCasu($datum){
        return Date("j.n.Y H:i", $datum);
    }

    public function zobrazChat(){

       
        foreach($this->vyberZpravy() as $zprava){
            echo '<p><img src="obrazky/avatar.png" style="float: left;">';
            echo "<strong>" . $zprava['prezdivka'] . "</strong><br>";
            echo  $this->formatZpravy($zprava['zprava']) . "<br><br>";
            echo '<p style="text-align: right;"><small>' . $this->formatCasu($zprava['datum']) . "</small></p>";
            echo('</p><div style="clear: both;"></div>');
    }
        
    }

}


