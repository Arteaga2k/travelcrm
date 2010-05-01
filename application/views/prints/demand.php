<div class="container">
<h5>
Додаток No1 до Договору на туристичне обслуговування No<?=$ds->agreement?> вiд <?=$ds->date_doc?>.
</h5>
<div class="column span-24 last">
<h3 style="text-align: center;"><?=get_constant('COMPANY_NAME')?></h3>		                                                                                                                    
</div>

<br><br>
<div class="column span-24">
	<div style="padding: 5px;text-align: center;">
		<?=get_city_name_byrid($filial_info->_cities_rid)?>, <?=$filial_info->adress?>, тел. <?=$filial_info->phones?>  email: <?=$filial_info->email?>
	</div>
</div>
<div class="column span-24" style="padding: 5px;text-align: center;">
	<h5 style="text-align: center;">Заявка на бронювання туристичних послуг</h5>
</div>
<div class="column span-4" style="text-align: center; border: 1px solid #000000;">
	<b>№</b>
</div>
<div class="column span-5" style="text-align: center; border: 1px solid #000000;border-left:none;">
	<b>Прізвище(РУС/ЛАТ)</b>
</div>
<div class="column span-5" style="text-align: center; border: 1px solid #000000;border-left:none;">
	<b>Ім'я(РУС/ЛАТ)</b>
</div>
<div class="column span-5" style="text-align: center; border: 1px solid #000000;border-left:none;">
	<b>№ паспорта, термін дії</b>
</div>
<div class="column span-5 last" style="text-align: center; border: 1px solid #000000;border-left:none;">
	<b>Дата народження</b>
</div>
<?php $i = 1; foreach($clients as $cl) { $client = get_client_info($cl->_clients_rid) ?>
<div class="column span-4" style="text-align: center; border-left: 1px solid #000000;border-bottom: 1px solid #000000;border-right: 1px solid #000000;">
	<?=$i?><br>
	&nbsp;
</div>
<div class="column span-5" style="text-align: center; border-bottom: 1px solid #000000;border-right: 1px solid #000000;">
	<?=$client->l_name?><br>
	<?=$client->l_name_lat?>
	&nbsp;
</div>
<div class="column span-5" style="text-align: center; border-bottom: 1px solid #000000;border-right: 1px solid #000000;">
	<?=$client->f_name?><br>
	<?=$client->f_name_lat?>
	&nbsp;
</div>
<div class="column span-5" style="text-align: center; border-bottom: 1px solid #000000;border-right: 1px solid #000000;">
	<?=$client->f_pass_seria?> <?=$client->f_pass_num?><br>
	<?=$client->f_pass_period?>
	&nbsp;
</div>
<div class="column span-5 last" style="text-align: center; border-bottom: 1px solid #000000;border-right: 1px solid #000000;">
	<?=$client->birthday?><br>
	&nbsp;
</div>
<? $i++; } ?>
<br><br><br><br>
<div class="column span-24 last" style="margin-top: 10px;">
<h3 style="text-align: center;">Деталі туру</h3>
</div>
<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Країна/Курорт/Маршрут</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	<?=get_countryname_byrid($ds->_countries_rid)?> / <?=get_curourtname_byrid($ds->_curourts_rid)?> / <?=$ds->route?> 
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Дата туру</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	з <?=$ds->date_from?> по <?=$ds->date_to?> 
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Назва та категорія готелю</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	<?=$ds->hotel_name?>, <? $cats = get_hotelscats_list(); echo $cats[$ds->_hotelscats_rid]?>
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Тип номеру</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	<? $rooms = get_rooms_list(); echo $rooms[$ds->_rooms_rid]?> <?=$ds->room_cat?>
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Харчування</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	<? $food = get_food_list(); echo $food[$ds->_food_rid]?>
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; border-bottom: none; padding: 3px;">
	<b>Трансфер</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-bottom: none; border-left: none; padding: 3px;">
	<?=$ds->transfer?>
</div>

<div class="column span-8" style="text-align: left; border: 1px solid #000000; padding: 3px;">
	<b>Страховка</b>
</div>
<div class="column span-10 last" style="text-align: left; border: 1px solid #000000; border-left: none; padding: 3px;">
	<?=$ds->cif?>&nbsp;
</div>
<br><br>
<div class="column span-24 last" style="text-align: left; padding: 3px;">
	Додатково: <?=$ds->excursions?>
</div>
<div class="column span-24 last" style="text-align: left; padding: 3px;">
	Загальна вартість туристичних послуг (цифрами та прописом): <?=$ds->sum?> (<?=num2str($ds->sum)?>)
</div>
<div class="column span-24 last" style="text-align: left; padding: 3px;">
	Телефони (дом., моб.): <?$demander_info = get_client_info($demander->_clients_rid)?><?=$demander_info->phones?>
</div>

<div class="column span-12" style="text-align: left;margin-top: 30px;">
	ВІДПОВІДАЛЬНИЙ МЕНЕДЖЕР<br>
	<br>
	
	________________________/<?=get_curr_uname()?>/
	
	<br><br>
	М.П.
</div>

<div class="column span-12 last" style="text-align: left;margin-top: 30px;">
	КЛІЄНТ<br>
	<br>
	
	________________________/<?=$demander_info->l_name?> <?=$demander_info->f_name?> <?=$demander_info->s_name?>/
	
</div>

</div>