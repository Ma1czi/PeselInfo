<?php
    class Pesel
    {
    private $pesele;

        public function __construct(string $pesel){
            $this->pesele = $pesel;
            $this->peselInfo();
        }
        public function checkpesel(){
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
        public function peselInfo(){
            if($this -> checkpesel()){
                $pesel = $this -> pesele;
                $rokandmonth = $this->getyearandmonth();
                $rok = substr($rokandmonth, 0, 4);
                $month = substr($rokandmonth, 4, 2);
                $day = substr($pesel, 4, 2);
                $sex = $this->getsex($pesel);
                $tablica['year'] = $rok;
                $tablica['month'] = $month;
                $tablica['day'] = $day;
                $tablica['sex'] = $sex;

                $this -> display($tablica);
            }
        }
        public function getsex($pesel){
            if(substr($pesel, 9, 1) % 2){
                return "Kobieta";
            }else{
                return "Mężczyzna";
            }
        }

        public function getyearandmonth(){
            $number = substr($this->pesele, 2, 1);
            $number = (int)$number;
            if($number % 2 != 0 && $number != 0){
                $number -= 1;
            }
            switch($number){
                case 0: 
                    $year = 19; 
                    break;
                case 2:
                    $year = 20;
                    break;
                case 4:
                    $year = 21;
                    break;
                case 6:
                    $year = 22;
                    break;
                case 8:
                    $year = 18;
                    break;
            }
            $month = substr($this->pesele, 2, 1) - $number;
            $month .= substr($this->pesele, 3, 1);
            $year .= substr($this->pesele, 0, 2);
            $year .= $month;
            return $year;
        }
        public function display(array $info){
        print_r($info);
        if($info['sex'] == "Kobieta"){
            echo $info['sex'] . " urodzona w ".$this -> monthinpolish($info['month'])." dnia ".date('l', mktime(1,1,1,$info['month'],$info["day"],$info["year"]));
        }else{

        }
        }
        public function daytopolish($day){
            
        }
        public function monthinpolish($month){
        $month = (int) $month;
            if($month >= 1 && $month <= 12){
                switch($month){
                    case 1:
                        return "stycznia";
                        break;
                    case 2:
                        return "Lutego";
                        break;
                    case 3:
                        return "Marca";
                        break;
                    case 4:
                        return "Kwietnia";
                        break;
                    case 5:
                        return "Maja";
                        break;
                    case 6:
                        return "Czerwca";
                        break;
                    case 7:
                        return "Lipca";
                        break;
                    case 8:
                        return "Sierpnia";
                        break;
                    case 9:
                        return "Września";
                        break;
                    case 10:
                        return "Października";
                        break;
                    case 11:
                        return "Listopada";
                        break;
                    case 12:
                        return "Grudnia";
                        break;
                    }
            }else{
                 return "zly miesiac";
            }
            
        }
        function CountDown($hour, $minute, $second, $month, $day, $year) 
    { 
        $eventDate = mktime($hour, $minute, $second, $month, $day, $year); 
        $today = time(); 
        $secondsTo = $eventDate - $today; 
        $minutesTo = round($secondsTo / 60); 
        $hoursTo = round($minutesTo / 60); 
        $daysTo = round($hoursTo / 24); 
        $weeksTo = round($daysTo / 7); 
        $monthsTo = round($weeksTo / 4); 
        $yearsTo = round($monthsTo / 12); 
        $values = "seconds ".$secondsTo.", minutes ".$minutesTo.", hours ".$hoursTo.", days ".$daysTo.", weeks ".$weeksTo.", months ".$monthsTo.", years ".$yearsTo; 
        return $values; 
    }




}


    if(!empty($_POST['guzik'])){
        $twojpesel = new Pesel($_POST['pesel']);
    }
    


require('formularz.html');
?>
