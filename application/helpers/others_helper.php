<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	function semantic($i,&$words,&$many,$f)	{
		//-----------------------------------
		$_1_2[1]="одна ";
		$_1_2[2]="двi ";
		$_1_19[1]="один ";
		$_1_19[2]="два ";
		$_1_19[3]="три ";
		$_1_19[4]="чотири ";
		$_1_19[5]="п'ять ";
		$_1_19[6]="шiсть ";
		$_1_19[7]="сiм ";
		$_1_19[8]="вiсiм ";
		$_1_19[9]="дев'ять ";
		$_1_19[10]="десять ";
		$_1_19[11]="одинадцять ";
		$_1_19[12]="дванадцять ";
		$_1_19[13]="тринадцять ";
		$_1_19[14]="чотирнадцять ";
		$_1_19[15]="п'ятнадцять ";
		$_1_19[16]="шiстнадцять ";
		$_1_19[17]="сiмнадцять ";
		$_1_19[18]="вiсiмнадцять ";
		$_1_19[19]="дев'ятнадцять ";
		$des[2]="двадцать ";
		$des[3]="тридцять ";
		$des[4]="сорок ";
		$des[5]="пятьдесят ";
		$des[6]="шiстдесят ";
		$des[7]="сiмдесят ";
		$des[8]="вiсiмдесят ";
		$des[9]="дев'яносто ";
		$hang[1]="сто ";
		$hang[2]="двiстi ";
		$hang[3]="триста ";
		$hang[4]="чотириста ";
		$hang[5]="пятьсот ";
		$hang[6]="шiстьсот ";
		$hang[7]="сiмсот ";
		$hang[8]="вiсiмсот ";
		$hang[9]="девятьсот ";
		$namerub[1]="гривня ";
		$namerub[2]="гривнi ";
		$namerub[3]="гривнiв ";
		$nametho[1]="тисяча ";
		$nametho[2]="тисячi ";
		$nametho[3]="тисяч ";
		$namemil[1]="мiльйон ";
		$namemil[2]="мiльйона ";
		$namemil[3]="мiльйонiв ";
		$namemrd[1]="мiльярд ";
		$namemrd[2]="мiльярда ";
		$namemrd[3]="мiльярдiв ";
		$kopeek[1]="копiйка ";
		$kopeek[2]="копiйки ";
		$kopeek[3]="копiйок ";
		//-----------------------------------
		// в words будем пихать запись числа
		$words="";
		$fl=0;
		//рассматриваем промежуток чисел от 100 до 999
		if($i >= 100){
			//сколько сотен
  			$jkl = intval($i / 100);
  			$words.=$hang[$jkl];
			//отбрасываем "сотенный разряд" и считаем остальные разряды
  			$i%=100;
		}
		//рассматриваем промежуток чисел от 20 до 10 (от 20, потому что есть
		//всякие одиннадцать, двенадцать...)
		if($i >= 20){
			$jkl = intval($i / 10);
  			$words.=$des[$jkl];
			//отбрасываем рязряд десятков и остаемся с маленьким числом от 1 до 9
  			$i%=10;
  			$fl=1;
		}
		//в $fem - индекс массива с записью чисел
		switch($i){
			case 1: $many=1; break;
  			case 2:
  			case 3:
  			case 4: $many=2; break;
  			default: $many=3; break;
		}

		//если тысяча, то одна или две, а если нет, то один или два...
		if($i){
			if($i < 3 && $f == 1)
			$words.=$_1_2[$i];
		else
			$words.=$_1_19[$i];
		}
	}

	function num2str($L){
		// ---------------------------------------------------------
		$_1_2[1]="одна ";
		$_1_2[2]="двi ";
		$_1_19[1]="один ";
		$_1_19[2]="два ";
		$_1_19[3]="три ";
		$_1_19[4]="чотири ";
		$_1_19[5]="п'ять ";
		$_1_19[6]="шiсть ";
		$_1_19[7]="сiм ";
		$_1_19[8]="вiсiм ";
		$_1_19[9]="дев'ять ";
		$_1_19[10]="десять ";
		$_1_19[11]="одинадцять ";
		$_1_19[12]="дванадцять ";
		$_1_19[13]="тринадцять ";
		$_1_19[14]="чотирнадцять ";
		$_1_19[15]="п'ятнадцять ";
		$_1_19[16]="шiстнадцять ";
		$_1_19[17]="сiмнадцять ";
		$_1_19[18]="вiсiмнадцять ";
		$_1_19[19]="дев'ятнадцять ";
		$des[2]="двадцать ";
		$des[3]="тридцять ";
		$des[4]="сорок ";
		$des[5]="пятьдесят ";
		$des[6]="шiстдесят ";
		$des[7]="сiмдесят ";
		$des[8]="вiсiмдесят ";
		$des[9]="дев'яносто ";
		$hang[1]="сто ";
		$hang[2]="двiстi ";
		$hang[3]="триста ";
		$hang[4]="чотириста ";
		$hang[5]="пятьсот ";
		$hang[6]="шiстьсот ";
		$hang[7]="сiмсот ";
		$hang[8]="вiсiмсот ";
		$hang[9]="девятьсот ";
		$namerub[1]="гривня ";
		$namerub[2]="гривнi ";
		$namerub[3]="гривнiв ";
		$nametho[1]="тисяча ";
		$nametho[2]="тисячi ";
		$nametho[3]="тисяч ";
		$namemil[1]="мiльйон ";
		$namemil[2]="мiльйона ";
		$namemil[3]="мiльйонiв ";
		$namemrd[1]="мiльярд ";
		$namemrd[2]="мiльярда ";
		$namemrd[3]="мiльярдiв ";
		$kopeek[1]="копiйка ";
		$kopeek[2]="копiйки ";
		$kopeek[3]="копiйок ";
		// ---------------------------------------------------------		
		$s=" ";
		$s1=" ";
		//считаем количество копеек, т.е. дробной части числа
		$kop=intval(( $L*100 - intval($L)*100 ));
		//отбрасываем дробную часть
		$L=intval($L);
		if($L>=1000000000){
			$many=0;
			semantic(intval($L / 1000000000),$s1,$many,3);
			$s.=$s1.$namemrd[$many];
			$L%=1000000000;
			//если ровно сколько-то миллиардов, то хватит считать
			if($L==0){
				$s.="гривнiв ";
  			}
		}

		if($L >= 1000000){
			$many=0;
			semantic(intval($L / 1000000),$s1,$many,2);
			$s.=$s1.$namemil[$many];
			$L%=1000000;
			//аналогично если ровно сколько-то миллионов, то хватит считать
			if($L==0){
				$s.="гривнiв ";
			}
		}

		if($L >= 1000){
			$many=0;
			semantic(intval($L / 1000),$s1,$many,1);
			$s.=$s1.$nametho[$many];
			$L%=1000;
			if($L==0){
   				$s.="гривнiв ";
			}
		}


		if($L != 0){
			$many=0;
			semantic($L,$s1,$many,0);
			$s.=$s1.$namerub[$many];
		}

		//если есть копейки, то добавим их в итоговую строку
		if($kop > 0){
			$many=0;
			semantic($kop,$s1,$many,1);
			$s.=$s1.$kopeek[$many];
		}
		else{
			$s.=" 00 копiйок";
		}
		return $s;
	}
?>