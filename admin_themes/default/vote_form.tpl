<div class="middle0">
	<h1><a href="?m=vote"><img src="{THEME}/images/vote.png" title="Опросы" alt="Опросы" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=vote"><img src="{THEME}/images/back.png" title="Опросы" alt="Опросы" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" id="formata">
				<div class="polya">
					<p class="pleft">Заголовок *</p>
					<p class="pright"><input type="text" maxlength="100" name="title" value="{TITLE}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Категории где будет показиватся опрос</p>
					<p class="pright">
						<select name="cats[]" style="height:80px;" multiple="multiple" {CATS_DIS}>
		   					<option value="0" {CATS_SEL}>- Все -</option>
							{CATS}
						</select>
					</p>
				</div>				
				<div class="bbcodes">
					<div class="fonts">
						<select style="font-size:10px; height:16px; width:100px;" name="bbfont" onchange="insert_font(this.options[this.selectedIndex].value, 'font')">
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
						<select name="bbsize" style="font-size:10px; height:16px; width:70px;" onchange="insert_font(this.options[this.selectedIndex].value, 'size')">
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
						<img id="b_left" onclick="simpletag('left')" title="Выравнивание по левому краю" alt="Выравнивание по левому краю" src="{THEME}/images/bbcodes_l.png" />
						<img id="b_center" onclick="simpletag('center')" title="По центру" alt="По центру" src="{THEME}/images/bbcodes_c.png" />
						<img id="b_right" onclick="simpletag('right')" title="Выравнивание по правому краю" alt="Выравнивание по правому краю" src="{THEME}/images/bbcodes_r.png" />
						<img id="b_b" onclick="simpletag('b')" title="Полужирный" alt="Полужирный" src="{THEME}/images/bbcodes_b.png" />
						<img id="b_i" onclick="simpletag('i')" title="Наклонный текст" alt="Наклонный текст" src="{THEME}/images/bbcodes_i.png" />
						<img id="b_u" onclick="simpletag('u')" title="Подчеркнутый текст" alt="Подчеркнутый текст" src="{THEME}/images/bbcodes_u.png" />
						<img id="b_s" onclick="simpletag('s')" title="Зачеркнутый текст" alt="Зачеркнутый текст" src="{THEME}/images/bbcodes_s.png" />
						<img id="b_color" onclick="ins_color();" src="{THEME}/images/bbcodes_color.png" alt="Панель цветов" title="Панель цветов" />
                        <iframe width="154" height="104" id="cp" src="{THEME}/color.html" frameborder="0" vspace="0" hspace="0" marginwidth="0" marginheight="0" scrolling="no" style="visibility:hidden; display: none; position: absolute;"></iframe>
                        <img onclick="image_upload();" title="Загрузка файлов на сервер" alt="Загрузка файлов на сервер" src="{THEME}/images/bbcodes_upload.png" />
						<img onclick="tag_image()" title="Картинка" alt="Картинка" src="{THEME}/images/bbcodes_image.png" />
						<img onclick="tag_url()" title="Ссылка" alt="Ссылка" src="{THEME}/images/bbcodes_link.png" />
						<img onclick="closeall()" title="Закрыть все открытые теги" alt="Закрыть все открытые теги" src="{THEME}/images/bbcodes_close.png" />
						<img onclick="document.getElementById('story').rows += 3;" title="Поле больше" alt="Поле больше" src="{THEME}/images/bbcodes_plus.png" />
						<img onclick="document.getElementById('story').rows -= 3" title="Поле меньше" alt="Поле меньше" src="{THEME}/images/bbcodes_minus.png" />
					</div>
				</div>
				<p><textarea rows="6" cols="" name="body" id="story">{BODY}</textarea></p>
				<div class="polya">
					<p class="pleft">Состояние опроса</p>
					<p class="pright"><input type="radio" name="onoff" value="1" {ONOFF_YES} class="check" /> Да <input type="radio" name="onoff" value="0" {ONOFF_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Видеть опрос не зарег. пользователям</p>
					<p class="pright"><input type="radio" name="is_reg" value="1" {IS_REG_YES} class="check" /> Да <input type="radio" name="is_reg" value="0" {IS_REG_NO} class="check" /> Нет</p>
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="engine/js/bbcodes1.js"></script>
