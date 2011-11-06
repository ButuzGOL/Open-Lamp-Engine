<div class="middle0">
	<h1><a href="?m=wsearch"><img src="{THEME}/images/wsearch.png" title="Поиск и замена текста" alt="Поиск и замена текста" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post">
				<div class="polya">
					<p class="pleft">Выберете таблицу для замены *</p>
					<p class="pright">
						<select name="table[]" multiple="multiple">
							<option value="1" {NEWS_SEL}>в новостях</option>
							<option value="2" {COMM_SEL}>в комментариях</option>
							<option value="3" {PM_SEL}>в персональных сообщениях</option>
							<option value="4" {ST_SEL}>в статических страницах</option>
						</select>
					</p>
				</div>
				<div class="polya">
					<p class="pleft">Введите старый текст *</p>
					<p class="pright"><textarea cols="" rows="" class="smallta" name="text0">{TEXT0}</textarea></p>
				</div>
				<div class="polya">
					<p class="pleft">Введите новый текст</p>
					<p class="pright"><textarea cols="" rows="" class="smallta" name="text1">{TEXT1}</textarea></p>
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>
