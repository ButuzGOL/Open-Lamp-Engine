<div class="middle0">
	<h1><a href="?m=usersgroup"><img src="{THEME}/images/usersgroup.png" title="Группы пользователей" alt="Группы пользователей" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=vote"><img src="{THEME}/images/back.png" title="Группы пользователей" alt="Группы пользователей" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post">
				<div class="polya">
					<p class="pleft">Название группы *</p>
					<p class="pright"><input type="text" maxlength="32" name="group_name" value="{GROUP_NAME}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Доступные категории <br /><span class="small">при просмотре сайта</span></p>
					<p class="pright">
						<select name="allow_cats[]" style="height:80px;" multiple="multiple" {IS_ADM}>
		   					<option value="0" {ALLOW_CATS_SEL}>- Все -</option>
							{ALLOW_CATS}
						</select>
					</p>
				</div>
				<div class="polya">
					<p class="pleft">Доверительные категории <br /><span class="small">при добавлении новости</span></p>
					<p class="pright">
						<select name="cat_add[]" style="height:80px;" multiple="multiple" {IS_ADM}>
		   					<option value="0" {CAT_ADD_SEL}>- Все -</option>
							{CAT_ADD}
						</select>
					</p>
				</div>	
				<div class="polya">
					<p class="pleft">Разрешить просмотр отключенного сайта</p>
					<p class="pright"><input type="radio" name="allow_offline" value="1" {ALLOW_OFFLINE_YES} class="check" /> Да <input type="radio" name="allow_offline" value="0" {IS_ADM} {ALLOW_OFFLINE_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить доступ в панель управления</p>
					<p class="pright"><input type="radio" name="allow_admin" value="1" {ALLOW_ADMIN_YES} class="check" /> Да <input type="radio" name="allow_admin" value="0"  {IS_ADM} {ALLOW_ADMIN_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Скрывать полную новость из недоступных разделов</p>
					<p class="pright"><input type="radio" name="allow_short" value="1" {ALLOW_SHORT_YES} class="check" /> Да <input type="radio" name="allow_short"  value="0" {IS_ADM} {ALLOW_SHORT_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить выставление рейтинга новостей</p>
					<p class="pright"><input type="radio" name="allow_rating" value="1" {ALLOW_RATING_YES} class="check" /> Да <input type="radio" name="allow_rating"  value="0" {IS_ADM} {ALLOW_RATING_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить добавлять новости</p>
					<p class="pright"><input type="radio" name="allow_adds" value="1" {ALLOW_ADDS_YES} class="check" /> Да <input type="radio" name="allow_adds"  value="0" {IS_ADM} {ALLOW_ADDS_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Публиковать новости без проверки</p>
					<p class="pright"><input type="radio" name="moderation" value="1" {MODERATION_YES} class="check" /> Да <input type="radio" name="moderation" value="0" {IS_ADM} {MODERATION_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить публиковать на главной</p>
					<p class="pright"><input type="radio" name="allow_main" value="1" {ALLOW_MAIN_YES} class="check" /> Да <input type="radio" name="allow_main"  value="0" {IS_ADM} {ALLOW_MAIN_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Редактирование собственных новостей</p>
					<p class="pright"><input type="radio" name="allow_edit" value="1" {ALLOW_EDIT_YES} class="check" /> Да <input type="radio" name="allow_edit" value="0" {IS_ADM} {ALLOW_EDIT_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Редактирование всех новостей</p>
					<p class="pright"><input type="radio" name="allow_all_edit"  value="1" {ALLOW_ALL_EDIT_YES} class="check" /> Да <input type="radio" name="allow_all_edit" value="0" {IS_ADM} {ALLOW_ALL_EDIT_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить добавлять статическую страницу</p>
					<p class="pright"><input type="radio" name="allow_addst" value="1" {ALLOW_ADDST_YES} class="check" /> Да <input type="radio" name="allow_addst"  value="0" {IS_ADM} {ALLOW_ADDST_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Публиковать статическую страницу без проверки</p>
					<p class="pright"><input type="radio" name="moderationst"  value="1" {MODERATIONST_YES} class="check" /> Да <input type="radio" name="moderationst" value="0" {IS_ADM} {MODERATIONST_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Редактирование собственных статических страниц</p>
					<p class="pright"><input type="radio" name="allow_editst" value="1" {ALLOW_EDITST_YES} class="check" /> Да <input type="radio" name="allow_editst" value="0" {IS_ADM} {ALLOW_EDITST_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Редактирование всех статических страниц</p>
					<p class="pright"><input type="radio" name="allow_all_editst" value="1" {ALLOW_ALL_EDITST_YES} class="check" /> Да <input type="radio" name="allow_all_editst" value="0" {IS_ADM} {ALLOW_ALL_EDITST_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить добавление комментариев</p>
					<p class="pright"><input type="radio" name="allow_addc" value="1" {ALLOW_ADDC_YES} class="check" /> Да <input type="radio" name="allow_addc" value="0" {IS_ADM} {ALLOW_ADDC_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Изменение своих комментариев</p>
					<p class="pright"><input type="radio" name="allow_editc" value="1" {ALLOW_EDITC_YES} class="check" /> Да <input type="radio" name="allow_editc"  value="0" {IS_ADM} {ALLOW_EDITC_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Удаление своих комментариев</p>
					<p class="pright"><input type="radio" name="allow_delc" value="1" {ALLOW_DELC_YES} class="check" /> Да <input type="radio" name="allow_delc"  value="0" {IS_ADM} {ALLOW_DELC_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Изменение всех комментариев</p>
					<p class="pright"><input type="radio" name="edit_allc" value="1" {EDIT_ALLC_YES} class="check" /> Да <input type="radio" name="edit_allc" value="0" {IS_ADM} {EDIT_ALLC_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Удаление всех комментариев</p>
					<p class="pright"><input type="radio" name="del_allc"  value="1" {DEL_ALLC_YES} class="check" /> Да <input type="radio" name="del_allc" value="0" {IS_ADM} {DEL_ALLC_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Не показывать код безопасности</p>
					<p class="pright"><input type="radio" name="captcha" value="1" {CAPTCHA_YES} {IS_ADM} class="check" /> Да <input type="radio" name="captcha" value="0" {CAPTCHA_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Просмотр скрытого текста <br /><span class="small">[HIDE][/HIDE]</span></p>
					<p class="pright"><input type="radio" name="allow_hide" value="1" {ALLOW_HIDE_YES} class="check" /> Да <input type="radio" name="allow_hide" value="0" {IS_ADM} {ALLOW_HIDE_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Использование персональных сообщений</p>
					<p class="pright"><input type="radio" name="allow_pm" value="1" {ALLOW_PM_YES} class="check" /> Да <input type="radio" name="allow_pm" value="0" {IS_ADM} {ALLOW_PM_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешить голосовать в опросах</p>
					<p class="pright"><input type="radio" name="allow_poll" value="1" {ALLOW_POLL_YES} class="check" /> Да <input type="radio" name="allow_poll" value="0" {IS_ADM} {ALLOW_POLL_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Использование поиска по сайту</p>
					<p class="pright"><input type="radio" name="allow_search" value="1" {ALLOW_SEARCH_YES} class="check" /> Да <input type="radio" name="allow_search" value="0" {IS_ADM} {ALLOW_SEARCH_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Разрешыть HTML код<br /><span class="small"> В полях где используется BBcodes</span></p>
					<p class="pright"><input type="radio" name="allow_html" value="1" {ALLOW_HTML_YES} class="check" /> Да <input type="radio" name="allow_html" value="0" {IS_ADM} {ALLOW_HTML_NO} class="check" /> Нет</p>
				</div><br />
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>
