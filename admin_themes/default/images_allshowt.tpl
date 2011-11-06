<div class="middle0">
	<h1><a href="?m=images"><img src="{THEME}/images/images.png" title="Картинки" alt="Картинки" /></a> Картинки <a href="?m=images&amp;a=add"><img src="{THEME}/images/add.png" alt="добавить" title="добавить" /></a></h1>
	{MESS}
	<form action="?m=images" method="post" id="formata">
		<div class="head">
			<input type="checkbox" name="master_box" title="Выбрать все" onclick="check_uncheck_all(); diss();" />
            <input type="hidden" name="action" value="submit" />
            <input type="image" style="vertical-align:top;" src="{THEME}/images/accept_dis.png" id="image" name="action" class="submit" disabled="disabled" />
			<select name="make" onchange="diss();">
				<option value="" onclick="diss();">-- Действие --</option>
				<option value="1">Удалить</option>
			</select>
		</div>
