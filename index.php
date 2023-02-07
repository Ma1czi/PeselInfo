<?php
class Pesel
{
    private $pesele;

    public function __construct(string $pesel){
        $this->pesele = $pesel;
        $this-> peselInfo();
    }

    private function checkpesel(){
        if(is_numeric($this->pesele)){
            if(strlen($this->pesele) == 11){
            return true;
            }else{
                echo "Błędna ilość";
                return false;
            }
        }else{
            echo  "Podaj same liczby";
            return false;
        }
    }

    private function peselInfo(){
        if($this -> checkpesel()){
            $pesel = $this -> pesele;
            $rokandmonth = $this->getYearAndmonth();
            $rok = substr($rokandmonth, 0, 4);
            $month = substr($rokandmonth, 4, 2);
            $day = substr($pesel, 4, 2);
            $sex = $this->getSex($pesel);
            $tablica['year'] = $rok;
            $tablica['month'] = $month;
            $tablica['day'] = $day;
            $tablica['sex'] = $sex;

            $this -> display($tablica);
        }
    }

    private function getSex($pesel){
        if(substr($pesel, 9, 1) % 2){
            return "Kobieta";
        }else{
            return "Mężczyzna";
        }
    }

    private function getYearAndmonth(){
        $number = substr($this->pesele, 2, 1);
        $number = (int)$number;
        if($number % 2 != 0 && $number != 0){
            $number -= 1;
        }
        switch($number){
            case 0: $year = 19; break;
            case 2: $year = 20; break;
            case 4: $year = 21; break;
            case 6: $year = 22; break;
            case 8: $year = 18; break;
        }
        $month = substr($this->pesele, 2, 1) - $number;
        $month .= substr($this->pesele, 3, 1);
        $year .= substr($this->pesele, 0, 2);
        $year .= $month;
        return $year;
    }

    private function display(array $info){
        if($info['sex'] == "Kobieta"){
            echo $info['sex'] . " urodzona w ".$this -> daytopolish(date('N', mktime(1,1,1,$info['month'],$info["day"],$info["year"])))." ".$info["day"]."go ".$this -> monthinpolish($info['month'])." ".$info['year']." roku. Do urodzin pozostało: ".$this -> CountDown($info['month'],$info['day'], $info['year']);
        }else{
            echo $info['sex'] . " urodzony w ".$this -> daytopolish(date('N', mktime(1,1,1,$info['month'],$info["day"],$info["year"])))." ".$info["day"]."go ".$this -> monthinpolish($info['month'])." ".$info['year']." roku. Do urodzin pozostało: ".$this -> CountDown($info['month'],$info['day'], $info['year']);
        }
    }

    private function daytopolish($day){
        switch($day){
            case 1: return "poniedziałek";
            case 2: return "wtorek";
            case 3: return "środę";
            case 4: return "czwartek";
            case 5: return "piątek";
            case 6: return "sobote";
            case 7: return "niedziele";
            
            
        }
    }

    private function monthinpolish($month){
    $month = (int) $month;
        if($month >= 1 && $month <= 12){
            switch($month){
                case 1: return "stycznia";
                case 2: return "Lutego";
                case 3: return "Marca";
                case 4: return "Kwietnia";
                case 5: return "Maja";
                case 6: return "Czerwca";
                case 7: return "Lipca";
                case 8: return "Sierpnia";
                case 9: return "Września";
                case 10: return "Października";
                case 11: return "Listopada";
                case 12: return "Grudnia";
                }
        }else{
                return "zly miesiac";
        }
        
    }

    private function CountDown($month, $day, $year) 
    { 
        $eventDate = mktime(null, null, null, $month, $day, date("Y") + 1); 
        $today = time(); 
        $secondsTo = $eventDate - $today; 
        $minutesTo = round($secondsTo / 60); 
        $hoursTo = round($minutesTo / 60); 
        $daysTo = round($hoursTo / 24); 
        $values = $daysTo." dni, czyli ".$hoursTo." godzin, czyli ".$minutesTo." minut, czyli ".$secondsTo." sekund."; 
        return $values; 
    }


}


if(!empty($_POST['guzik'])){
    $twojpesel = new Pesel($_POST['pesel']); 
}
require('formularz.html');
?>
