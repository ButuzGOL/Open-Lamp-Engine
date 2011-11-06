<div class="middle0">
	<h1><a href="?m=bannedip"><img src="{THEME}/images/bannedip.png" title="Заблокированные IP" alt="Заблокированные IP" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=bannedip"><img src="{THEME}/images/back.png" title="Заблокированные IP" alt="Заблокированные IP" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post">
				<div class="polya">
					<p class="pleft">IP адрес * <br /><span class="small">Пример: 192.169.82.106 или 129.42.*.*</span></p>
					<p class="pright"><input type="text" maxlength="16" name="ip" value="{IP}" /></p>
				</div>
				<div class="polya">
						<p class="pleft">Дата публикации новости</p>
						<p class="pright"><input type="text" value="{DATE}" id="date" name="date" style="width:150px;" readonly="readonly" onchange="if (tt.checked==true) tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c" style="cursor: pointer; vertical-align: middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" /><input type="checkbox" {DATEC} id="tt" class="check" onclick="if (tt.checked==true) date.value=''" /> <span class="small">Бан без окончания</span>
						</p>
					</div>
				<div class="polya">
					<p class="pleft">Причина бана</p>
					<p class="pright"><textarea name="descr" cols="" rows="" class="smallta">{DESCR}</textarea></p>
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="engine/js/calendar.js"></script>
<script type="text/javascript" src="engine/js/calendar-en.js"></script>
<script type="text/javascript" src="engine/js/calendar-setup.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "date",     
        ifFormat       :    "%d.%m.%Y %H:%M:%S",      
        button         :    "f_trigger_c",  
        align          :    "Br",           
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
/* ]]> */
</script>
