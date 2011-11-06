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
