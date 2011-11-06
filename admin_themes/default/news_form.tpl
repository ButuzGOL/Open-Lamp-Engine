<div class="middle0">
	<h1><a href="?m=news"><img src="{THEME}/images/news.png" title="Новости" alt="Новости" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=news"><img src="{THEME}/images/back.png" title="Новости" alt="Новости" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" id="formata">
				<div class="menu">
					<img src="{THEME}/images/news_form1.png" alt="Новость" title="Новость" onclick="tab('newss'); setFieldName('short_story');" /> 
					<img src="{THEME}/images/news_form2.png" alt="Дополнительно" title="Дополнительно" onclick="tab('more');" />
					<img src="{THEME}/images/news_form3.png" alt="Опрос" title="Опрос" onclick="tab('ask'); setFieldName('vote_body');" />
				</div>
				<div id="newss" style="display:;">
					<div class="polya">
						<p class="pleft">Заголовок *</p>
						<p class="pright"><input type="text" maxlength="200" name="title" value="{TITLE}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Дата публикации новости</p>
						<p class="pright"><input type="text" value="{DATE}" id="date" name="date" style="width:150px;" readonly="readonly" onchange="if (tt.checked==true) tt.checked=false;" />
						<img src="{THEME}/images/calendar.png" id="f_trigger_c" style="cursor: pointer; vertical-align:middle;" alt="Выбор даты с помощью календаря" title="Выбор даты с помощью календаря" /><input type="checkbox" {DATEC} id="tt" class="check" onclick="if (tt.checked==true) date.value=''" /> <span class="small">текущая дата и время</span>
						</p>
					</div>
					<div class="polya">
						<p class="pleft">Категории новости</p>
						<p class="pright">
						<select name="cats[]" style="height:80px;" {CATS_DIS} multiple="multiple">
				   			<option value="0" {CATS_SEL}>- Все -</option>
							{CATS}
						</select>
						</p>
					</div>
					<div class="bbcodes">
						<div class="fonts">
							<select style="font-size:10px; height:16px; width:100px;" name="bbfont" onchange="insert_font(this.options[this.selectedIndex].value, 'font', 'font')">
								<option value="0">Шрифт</option><option value="Arial">Arial</option>
								<option value="Arial Black">Arial Black</option>
								<option value="Century Gothic">Century Gothic</option>
								<option value="Courier New">Courier New</option>
								<option value="Georgia">Georgia</option>
								<option value="Impact">Impact</option>
								<option value="System">System</option>
								<option value="Tahoma">Tahoma</option>
								<option value="Times New Roman">Times New Roman</option>
								<option value="Verdana">Verdana</option>
							</select>
						</div>
						<div class="size">
							<select name="bbsize" style="font-size:10px; height:16px; width:70px;" onchange="insert_font(this.options[this.selectedIndex].value, 'size', 'size')">
								<option value="">Размер</option>
								<option value="9">9 px</option>
								<option value="10">10 px</option>
								<option value="11">11 px</option>
								<option value="12">12 px</option>
								<option value="13">13 px</option>
								<option value="14">14 px</option>
								<option value="15">15 px</option>
								<option value="16">16 px</option>
								<option value="17">17 px</option>
								<option value="18">18 px</option>
								<option value="19">19 px</option>
								<option value="20">20 px</option>
								<option value="21">21 px</option>
								<option value="22">22 px</option>
								<option value="23">23 px</option>
								<option value="24">24 px</option>
								<option value="25">25 px</option>
							</select>
						</div>
						<div class="butt1">
							<img id="b_left" onclick="simpletag('left', 'left')" title="Выравнивание по левому краю" alt="Выравнивание по левому краю" src="{THEME}/images/bbcodes_l.png" />
							<img id="b_center" onclick="simpletag('center', 'center')" title="По центру" alt="По центру" src="{THEME}/images/bbcodes_c.png" />
							<img id="b_right" onclick="simpletag('right', 'right')" title="Выравнивание по правому краю" alt="Выравнивание по правому краю" src="{THEME}/images/bbcodes_r.png" />
							<img id="b_b" onclick="simpletag('b', 'b')" title="Полужирный" alt="Полужирный" src="{THEME}/images/bbcodes_b.png" />
							<img id="b_i" onclick="simpletag('i', 'i')" title="Наклонный текст" alt="Наклонный текст" src="{THEME}/images/bbcodes_i.png" />
							<img id="b_u" onclick="simpletag('u', 'u')" title="Подчеркнутый текст" alt="Подчеркнутый текст" src="{THEME}/images/bbcodes_u.png" />
							<img id="b_s" onclick="simpletag('s', 's')" title="Зачеркнутый текст" alt="Зачеркнутый текст" src="{THEME}/images/bbcodes_s.png" />
							<img id="b_hide" onclick="simpletag('hide', 'hide');" alt="Вставка скрытого текста" title="Вставка скрытого текста" src="{THEME}/images/bbcodes_hide.png" />
							<img id="b_color" onclick="ins_color('color','cp');" alt="Панель цветов" title="Панель цветов" src="{THEME}/images/bbcodes_color.png" />
                            <iframe width="154" height="104" id="cp" src="{THEME}/color.html" frameborder="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="visibility:hidden; display: none; position: absolute;"></iframe>
                            <img onclick="image_upload();" title="Загрузка файлов на сервер" alt="Загрузка файлов на сервер" src="{THEME}/images/bbcodes_upload.png" />
							<img onclick="tag_image()" title="Картинка" alt="Картинка" src="{THEME}/images/bbcodes_image.png" />
							<img onclick="tag_url()" title="Ссылки" alt="Ссылки" src="{THEME}/images/bbcodes_link.png" />
							<img onclick="closeall()" title="Закрыть все открытые теги" alt="Закрыть все открытые теги" src="{THEME}/images/bbcodes_close.png" />
							<img onclick="document.getElementById(selField).rows += 3;" alt="Поле больше" title="Поле больше" src="{THEME}/images/bbcodes_plus.png" />
							<img onclick="document.getElementById(selField).rows -= 3" alt="Поле меньше" title="Поле меньше" src="{THEME}/images/bbcodes_minus.png" />
						</div>
					</div>
					<textarea rows="12" cols="" onclick="setFieldName(this.name);" name="short_story" id="short_story">{SHORT_STORY}</textarea>
					<textarea onclick="setFieldName(this.name);" name="full_story" id="full_story" rows="12" cols="">{FULL_STORY}</textarea> 
				</div>
				<div id="more" style="display:none;">
					<div class="polya">
						<p class="pleft">Опубликовать новость</p>
						<p class="pright"><input type="radio" class="check" name="onoff" {ONOFF_YES} value="1" /> Да <input type="radio" name="onoff" class="check" {ONOFF_NO} value="0" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Публиковать на главной</p>
						<p class="pright"><input type="radio" name="allow_main" {ALLOW_MAIN_YES} value="1" class="check" /> Да <input type="radio" name="allow_main" {ALLOW_MAIN_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Требуется модерация</p>
						<p class="pright"><input type="radio" name="moderation" {MODERATION_YES} value="1" class="check" /> Да <input type="radio" name="moderation" {MODERATION_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Зафексировать</p>
						<p class="pright"><input type="radio" name="fixed" value="1" {FIXED_YES} class="check" /> Да <input type="radio" name="fixed" {FIXED_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Разрешить рейтинг статьи</p>
						<p class="pright"><input type="radio" name="allow_rate" {ALLOW_RATE_YES} value="1" class="check" /> Да <input type="radio" {ALLOW_RATE_NO} name="allow_rate" value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Разрешить комментарии</p>
						<p class="pright"><input type="radio" name="allow_comm" {ALLOW_COMM_YES} value="1" class="check" /> Да <input type="radio" name="allow_comm" {ALLOW_COMM_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Не показивать новость после</p>
						<p class="pright">
                        	<input type="text" value="{EXPIRES}" style="width:150px;" name="expires" id="expires" readonly="readonly" onchange="if (tt1.checked==true) tt1.checked=false;" />
                        <img src="{THEME}/images/calendar.png"  id="f_trigger_c1" style="cursor: pointer; vertical-align:middle;" title="Выбор даты с помощью календаря" alt="Выбор даты с помощью календаря" /> <input type="checkbox" id="tt1" class="check" {EXPIRESC} onclick="if (tt1.checked==true) expires.value=''" /> <span class="small">Показывать новость</span></p>
					</div>
					<div class="polya">
						<p class="pleft">Описание</p>
						<p class="pright"><input type="text" name="descr" maxlength="200" value="{DESCR}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Ключевые слова</p>
						<p class="pright"><textarea cols="" rows="" name="keywords" class="smallta">{KEYWORDS}</textarea></p>
					</div>
					<div class="polya">
						<p class="pleft">Доступ групп</p>
						<p class="pright">
							<select name="access[]" style="height:80px;" multiple="multiple" {ACCESS_DIS}>
			   					<option value="0" {ACCESS_SEL}>- Все -</option>
								{ACCESS}
							</select>
						</p>
					</div>
				</div>
				<div id="ask" style="display:none;">
					<div class="polya">
						<p class="pleft">Заголовок опроса **</p>
						<p class="pright"><input type="text" maxlength="100" name="vote_title" value="{VOTE_TITLE}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Состояние опроса</p>
						<p class="pright"><input type="radio" name="vote_onoff" {VOTE_ONOFF_YES} value="1" class="check" /> Да <input type="radio" name="vote_onoff" value="0" {VOTE_ONOFF_NO} class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Видеть опрос не зарег. пользователям</p>
						<p class="pright"><input type="radio" name="vote_is_reg" {VOTE_IS_REG_YES} value="1" class="check" /> Да <input type="radio" name="vote_is_reg" value="0" {VOTE_IS_REG_NO} class="check" /> Нет</p>
					</div>
					<div class="bbcodes">
						<div class="fonts">
							<select style="font-size:10px; height:16px; width:100px;" name="bbfont1" onchange="insert_font(this.options[this.selectedIndex].value, 'font1', 'font')">
								<option value="0">Шрифт</option><option value="Arial">Arial</option>
								<option value="Arial Black">Arial Black</option>
								<option value="Century Gothic">Century Gothic</option>
								<option value="Courier New">Courier New</option>
								<option value="Georgia">Georgia</option>
								<option value="Impact">Impact</option>
								<option value="System">System</option>
								<option value="Tahoma">Tahoma</option>
								<option value="Times New Roman">Times New Roman</option>
								<option value="Verdana">Verdana</option>
							</select>
						</div>
						<div class="size">
							<select name="bbsize1" style="font-size:10px; height:16px; width:70px;" onchange="insert_font(this.options[this.selectedIndex].value, 'size1', 'size')">
								<option value="">Размер</option>
								<option value="9">9 px</option>
								<option value="10">10 px</option>
								<option value="11">11 px</option>
								<option value="12">12 px</option>
								<option value="13">13 px</option>
								<option value="14">14 px</option>
								<option value="15">15 px</option>
								<option value="16">16 px</option>
								<option value="17">17 px</option>
								<option value="18">18 px</option>
								<option value="19">19 px</option>
								<option value="20">20 px</option>
								<option value="21">21 px</option>
								<option value="22">22 px</option>
								<option value="23">23 px</option>
								<option value="24">24 px</option>
								<option value="25">25 px</option>
							</select>
						</div>
						<div class="butt1">
							<img id="b_left1" onclick="simpletag('left1', 'left')" title="Выравнивание по левому краю" alt="Выравнивание по левому краю" src="{THEME}/images/bbcodes_l.png" />
							<img id="b_center1" onclick="simpletag('center1', 'center')" title="По центру" alt="По центру" src="{THEME}/images/bbcodes_c.png" />
							<img id="b_right1" onclick="simpletag('right1', 'right')" title="Выравнивание по правому краю" alt="Выравнивание по правому краю" src="{THEME}/images/bbcodes_r.png" />
							<img id="b_b1" onclick="simpletag('b1', 'b')" title="Полужирный" alt="Полужирный" src="{THEME}/images/bbcodes_b.png" />
							<img id="b_i1" onclick="simpletag('i1', 'i')" alt="Наклонный текст" title="Наклонный текст" src="{THEME}/images/bbcodes_i.png" />
							<img id="b_u1" onclick="simpletag('u1', 'u')" title="Подчеркнутый текст" alt="Подчеркнутый текст" src="{THEME}/images/bbcodes_u.png" />
							<img id="b_s1" onclick="simpletag('s1', 's')" alt="Зачеркнутый текст" title="Зачеркнутый текст" src="{THEME}/images/bbcodes_s.png" />
							<img id="b_color1" onclick="ins_color('color1','cp1');" alt="Панель цветов" title="Панель цветов" src="{THEME}/images/bbcodes_color.png" />
                            <iframe width="154" height="104" id="cp1" src="{THEME}/color.html" frameborder="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="visibility:hidden; display: none; position: absolute;"></iframe>
                            <img onclick="image_upload();" title="Загрузка файлов на сервер" alt="Загрузка файлов на сервер" src="{THEME}/images/bbcodes_upload.png" />
							<img onclick="tag_image()" title="Картинка" alt="Картинка" src="{THEME}/images/bbcodes_image.png" />
							<img onclick="tag_url()" title="Ссылки" alt="Ссылки" src="{THEME}/images/bbcodes_link.png" />
							<img onclick="closeall()" title="Закрыть все открытые теги" alt="Закрыть все открытые теги" src="{THEME}/images/bbcodes_close.png" />
							<img onclick="document.getElementById(selField).rows += 3;" title="Поле больше" alt="Поле больше" src="{THEME}/images/bbcodes_plus.png" />
							<img onclick="document.getElementById(selField).rows -= 3" title="Поле меньше" alt="Поле меньше" src="{THEME}/images/bbcodes_minus.png" />
						</div>
					</div>
					<textarea rows="6" cols="" onclick="setFieldName(this.name);" name="vote_body" id="vote_body">{VOTE_BODY}</textarea>
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
function tab(div) {
/* <![CDATA[ */
    document.getElementById('newss').style.display = "none";
    document.getElementById('more').style.display = "none";
    document.getElementById('ask').style.display  = "none";

    document.getElementById(div).style.display = "";
/* ]]> */
}
</script>
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
<script type="text/javascript">
/* <![CDATA[ */
    Calendar.setup({
        inputField     :    "expires",    
        ifFormat       :    "%d.%m.%Y %H:%M:%S",      
        button         :    "f_trigger_c1", 
        align          :    "Br",           
		timeFormat     :    "24",
		showsTime      :    true,
        singleClick    :    true
    });
/* ]]> */
</script>
<script type="text/javascript" src="engine/js/bbcodes2.js"></script>
