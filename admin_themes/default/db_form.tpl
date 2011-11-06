<div class="middle0">
	<h1><a href="?m=db"><img src="{THEME}/images/db.png" title="База данных" alt="База данных" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<div class="uava1">
				<form action="#" method="post">
					<p>
						<input type="hidden" name="db" value="backup" />
		                <input type="hidden" name="action" value="submit" />
						<input name="action" type="image" src="{THEME}/images/db_backup.png" title="Резервная копия" alt="Резервная копия" class="submit" style="width:64px; height:64px;" value="submit" />
					</p>	
				</form>
			</div>
			<div style="width:500px;">
				<b><a class="shab" href="#" onclick="showOrhide('opt', this)">Оптимизация базы данных</a></b>
				<br />Вы можете произвести оптимизацию базы данных, тем самым будет сэкономить немного места на диске, а также ускорить работу базы данных. Рекомендуется использовать данную функцию минимум один раз в неделю.
				<br />
				<br />
				<div id="opt" style="display: none;">
					<form action="#" method="post">
						<p>
							<input type="hidden" name="db" value="opt" />
							Выберети в каких таблицах произвести оптимизацию
							<br /><br />
							<select name="tables[]" style="margin:0 0 10px 0;" multiple="multiple">
								{TABLES}
							</select>		                        
		                    <input type="hidden" name="action" value="submit" />
							<input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" />	
						</p>
					</form>	
				</div>
			</div>
			<b><a class="shab" href="#" onclick="showOrhide('vopt', this)">Выборачная оптимизация базы данных</a></b>
			<br />Вы можете произвести выборачную оптимизацию базы данных, тем самым удалить устаревшие новости, комментарии, очистить персональные сообщения пользователей и т.д.
			<br />
			<br />
			<div id="vopt" style="display: none;">
				<form action="#" method="post">
					<p>
						<input type="hidden" name="db" value="vopt" />
						Удаление устаревших новостей
						<br />
						Все: <input type="checkbox" id="news_tt" name="news_tt" class="check" onclick="if (news_tt.checked==true) news_date.value=''" /> Дата до: <input type="text" id="news_date" style="width:70px;" name="news_date" readonly="readonly" onchange="if (news_tt.checked==true) news_tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c" style="cursor: pointer; vertical-align:middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" />
						<br /><br />
						Удаление устаревших комментариев
						<br />
						Все: <input type="checkbox" id="comm_tt" class="check" name="comm_tt" onclick="if (comm_tt.checked==true) comm_date.value=''" /> Дата до: <input type="text" id="comm_date" style="width:70px;" name="comm_date" readonly="readonly" onchange="if (comm_tt.checked==true) comm_tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c1" style="cursor: pointer; vertical-align:middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" />
						<br /><br />
						Удаление устаревших персональных сообщений пользователей
						<br />
						Все: <input type="checkbox" id="pm_tt" class="check" name="pm_tt" onclick="if (pm_tt.checked==true) pm_date.value=''" /> Дата до: <input type="text" id="pm_date" style="width:70px;" name="pm_date" readonly="readonly" onchange="if (pm_tt.checked==true) pm_tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c2" style="cursor: pointer; vertical-align:middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" />
						<br /><br />
						Удаление устаревших голосований
						<br />
						Все: <input type="checkbox" id="vote_tt" class="check" name="vote_tt" onclick="if (vote_tt.checked==true) vote_date.value=''" /> Дата до: <input type="text" id="vote_date" style="width:70px;" name="vote_date" readonly="readonly" onchange="if (vote_tt.checked==true) vote_tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c3" style="cursor: pointer; vertical-align: middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" />
						<br /><br />
						Удаление устаревших статических страниц
						<br />
	   					Все: <input type="checkbox" id="statik_tt" class="check" name="statik_tt" onclick="if (statik_tt.checked==true) statik_date.value=''" /> Дата до: <input type="text" id="statik_date" style="width:70px;" name="statik_date" readonly="readonly" onchange="if (statik_tt.checked==true) statik_tt.checked=false;" />
	   					<img src="{THEME}/images/calendar.png" id="f_trigger_c4" style="cursor: pointer; vertical-align: middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" />
		                <input type="hidden" name="action" value="submit" />
		                <input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" />
					</p>
				</form>						 
			</div>
			<b><a class="shab" href="#" onclick="showOrhide('rep', this)">Ремонт базы данных</a></b>
			<br />При неожиданной остановке MySQL сервера, во время выполнения каких-либо действий, может произойти повреждение структуры таблиц, использование этой функции поможет решить вам эту проблему.
			<br />
			<br />
			<div id="rep" style="display: none;">
				<form action="#" method="post">
					<p>
						<input type="hidden" name="db" value="rep" />
						Выберети в каких таблицах произвести ремонт
						<br /><br />
						<select name="tables[]" style="margin:0 0 10px 0;" multiple="multiple">
							{TABLES}
						</select>
		                <input type="hidden" name="action" value="submit" />
		                <input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" />
					</p>
				</form>
			</div>
			<b><a class="shab" href="#" onclick="showOrhide('res', this)">Востонавить резервную копию</a></b>
			<br />Если хотите загрузить прежнюю информацию и есть резервная копия.
			<br />
			<br />
			<div id="res" style="display: none;">
				<form action="#" method="post">
					<p>
						<input type="hidden" name="db" value="res" />
						Выберите файл с резервной копией базы данных
						<br /><br />
						<select name="dbbackup">
							{DBBACKUP}
						</select>
		            	<input type="hidden" name="action" value="submit" />
						<input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" />
					</p>	
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="engine/js/calendar.js"></script>
<script type="text/javascript" src="engine/js/calendar-en.js"></script>
<script type="text/javascript" src="engine/js/calendar-setup.js"></script>
<script type="text/javascript">
/* <![CDATA[ */
function showOrhide(div, thiss) {
    if (document.getElementById(div).style.display=='none') {
        document.getElementById(div).style.display = '';
    	thiss.className = 'shab1';
    }
    else {
    	document.getElementById(div).style.display = 'none';
		thiss.className = 'shab';
	}
}
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "news_date",     
        ifFormat       :    "%d.%m.%Y",      
        button         :    "f_trigger_c", 
        align          :    "Br",         
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
</script>
<script type="text/javascript">
/* <![CDATA[ */
	Calendar.setup({
		inputField     :    "comm_date",     
		ifFormat       :    "%d.%m.%Y",     
		button         :    "f_trigger_c1", 
		align          :    "Br",          
		timeFormat     :    "24",
		showsTime      :    true,
		singleClick    :    true
	});
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "pm_date",     
        ifFormat       :    "%d.%m.%Y",      
        button         :    "f_trigger_c2", 
        align          :    "Br",           
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "vote_date",     
        ifFormat       :    "%d.%m.%Y",      
        button         :    "f_trigger_c3",  
        align          :    "Br",           
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "statik_date",     
        ifFormat       :    "%d.%m.%Y",        
        button         :    "f_trigger_c4",    
        align          :    "Br",              
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
/* ]]> */
</script>
