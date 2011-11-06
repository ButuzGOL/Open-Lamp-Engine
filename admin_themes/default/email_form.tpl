<div class="middle0">
	<h1><a href="?m=email"><img src="{THEME}/images/email.png" title="Шаблоны E-mail сообщений" alt="Шаблоны E-mail сообщений" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post">
				<div>
					<b><a class="shab" href="#" onclick="showOrhide('reg_email', this)">Активация аккаунта</a></b>
					<br />Настройка E-Mail сообщения, которое отсылается для активации аккаунта
					<br />
					<br />
					<div id="reg_email" style="display: none;">
						<b>{*USERNAME*}</b> - имя пользователя желающего зарегистрироваться<br />
						<b>{*VALIDATIONLINK*}</b> - ссылка на активацию аккаунта<br />
						<b>{*PASSWORD*}</b> - пароль пользователя, введенный при регистрации<br />
						<b>{*URL*}</b> - адресс сайта<br /><br />
						<textarea rows="15" cols="" name="reg_email">{REG_EMAIL}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('ofs_email', this)">Обратная форма связи</a></b>
					<br />Настройка E-Mail сообщения, которое отсылается через форму обратной связи
					<br />
					<br />
	   				<div id="ofs_email" style="display: none;">
						 <b>{*USERNAME_TO*}</b> - имя получателя<br />
						 <b>{*USERNAME_FROM*}</b> - имя отправителя<br />
						 <b>{*TEXT*}</b> - текст сообщения от пользователя<br />
						 <b>{*IP*}</b> - IP адрес отправителя<br />
						 <b>{*URL*}</b> - адресс сайта<br /><br />
						<textarea rows="15" cols="" name="ofs_email">{OFS_EMAIL}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('lopa_email', this)">Забытый пароль</a></b>
					<br />Настройка E-Mail сообщения, которое отсылается для восстановления забытого пароля
					<br />
					<br />
					<div id="lopa_email" style="display: none;">
						<b>{*USERNAME*}</b> - имя пользователя<br />
						<b>{*LOSTLINK*}</b> - сылка на генерацию пароля<br />
						<b>{*IP*}</b> - IP адрес отправителя<br />
						<b>{*URL*}</b> - адресс сайта<br /><br />
						<textarea rows="15" cols="" name="lopa_email">{LOPA_EMAIL}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('news_email', this)">Hовая новость</a></b>
					<br />Настройка E-Mail сообщения, которое отсылается при добавлении новой новости на сайте
					<br />
					<br />
					<div id="news_email" style="display: none;">
						 <b>{*TITLE*}</b> - заголовок новости<br />
						 <b>{*USERNAME*}</b> - пользователь, добавивший новость<br />
						 <b>{*DATE*}</b> - дата добавления новости<br />
						 <b>{*CATEGORY*}</b> - категория, в которую добавлена новость<br />
						 <b>{*URL*}</b> - адресс сайта<br /><br />
						 <textarea rows="15" cols="" name="news_email">{NEWS_EMAIL}</textarea>
					</div>
		            <p><input type="hidden" name="action" value="submit" /></p>
					<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
				</div>	
			</form>
		</div>
	</div>
</div>

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
