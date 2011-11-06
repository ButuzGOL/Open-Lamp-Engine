<div class="mess">{MESS}</div>
<div id="pmform">
	<form action="#" method="post">
		<div class="polya"><input type="text" maxlength="100" name="subj" value="{SUBJ}" /> * Тема</div>
		<div class="polya"><select name="user_id">{USER_ID}</select> * Кому</div>
		<p><textarea cols="" rows="" name="text">{TEXT}</textarea></p>
		<div class="polya"><input type="checkbox" name="is_del_from" {IS_DEL_FROM} class="check" /> Сохранить сообщение в папке "Отправленные"</div>
        <p><input type="hidden" name="action_pmadd" value="submit" /></p>
        <p><input name="action_pmadd" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
	</form>
</div>
