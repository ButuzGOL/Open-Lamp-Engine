<div class="middle0">
	<h1><a href="?m=blocks"><img src="{THEME}/images/blocks.png" title="Блоки" alt="Блоки" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=blocks"><img src="{THEME}/images/back.png" title="Блоки" alt="Блоки" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" id="formata">
				<div class="polya">
					<p class="pleft">Описание *</p>
					<p class="pright"><input type="text" maxlength="200" name="descr" value="{DESCR}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Титул</p>
					<p class="pright"><input type="text" maxlength="200" name="title" value="{TITLE}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Место где будет находится</p>
					<p class="pright">
						<select name="place">
							<option value="1">Лево</option>
							<option value="2">Право</option>
							<option value="3">Верх</option>
							<option value="4">Низ</option>
						</select>
					</p>
				</div>
				<p><textarea name="text" cols="" rows="15">{TEXT}</textarea></p>
				<div class="polya">
					<p class="pleft">Шаблон блока (по умол. bl_default.tpl папка с шаблонами uploads/block_templates)</p>
					<p class="pright"><input type="text" maxlength="50" name="tpl" value="{TPL}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Модуль блока (папку с модулями engine/blocks)</p>
					<p class="pright"><input type="text" maxlength="50" name="modul" value="{MODUL}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Состояние блока</p>
					<p class="pright"><input type="radio" name="onoff" {ONOFF_YES} value="1" class="check" /> Да <input type="radio" {ONOFF_NO} name="onoff" value="0" class="check" /> Нет</p>
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
/* <![CDATA[ */
    document.getElementById('formata').place.options[{PLACE}-1].selected = true;
/* ]]> */
</script>
