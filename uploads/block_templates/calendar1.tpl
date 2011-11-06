<style type="text/css" media="all">
#calendar {margin:0px; width:100%; height:160px;}
#calendar1 p {padding: 0 4px 0 4px;}
#calendar1 {width:100%;}
#calendar1 h3 { margin-bottom:3px; font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:18px; width:100%; text-align:center;}
#calendar1 div {height:20px; width:100%; float:left; text-align:right; padding:0px;}
#calendar1 div p {float:left; height:0px; font-size:10px; width:15px; padding-bottom:20px;}
#calendar1 div p a {font-size:16px;}
</style>
<div id="calendar">
	<div id="calendar1">
	  	<h3>
	  	<span style="cursor:pointer;" onclick="gogoAj('calendar', 'calendar', 'year={PRIV_YEAR}&amp;mon={PRIV_MONTH}','{TEMPLATE}',0);" title="Предыдущий месяц">&laquo;</span> {MONTH} {YEAR} <span style="cursor:pointer;" title="Следующий месяц" onclick="gogoAj('calendar', 'calendar', 'year={NEXT_YEAR}&amp;mon={NEXT_MONTH}','{TEMPLATE}',0);">&raquo;</span>
	  	</h3>
	  	<div>
	  		<p>Пн</p><p>Вт</p><p>Ср</p><p>Чт</p><p>Пт</p><p style="color:#000000;">Сб</p><p style="color:#000000;">Вс</p>
	  	</div>
	  	<div>
	  		<p style="width:{FIRST}px;">{DAYS}
	  	</div>
  	</div>
</div>
