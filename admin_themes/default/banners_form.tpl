<div class="middle0">
	<h1><a href="?m=banners"><img src="{THEME}/images/banners.png" title="Баннеры" alt="Баннеры" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=banners"><img src="{THEME}/images/back.png" title="Баннеры" alt="Баннеры" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" id="formata">
				<div class="polya">
					<p class="pleft">Описание *</p>
					<p class="pright"><input type="text" maxlength="200" name="descr" value="{DESCR}" /></p>
				</div>
				<div class="polya">
					<p class="pleft">Место где будет находится</p>
					<p class="pright">
						<select name="place">
							<option value="1">Верх</option>
							<option value="2">Центр</option>
							<option value="3">Низ</option>
							<option value="4">Верх, центр</option>
							<option value="5">Верх, низ</option>
							<option value="6">Низ, центр</option>
							<option value="7">Верх, центр, низ</option>
						</select>
					</p>
				</div>
				<div class="polya">
					<p class="pleft">В каких категориях будет показыватся</p>
					<p class="pright">
						<select name="cats[]" style="height:80px;" multiple="multiple">
        					<option value="0" {CATS_SEL}>- Все -</option>
        					{CATS}
        				</select>
					</p>
				</div>
				<p><textarea name="code" cols="" rows="12">{CODE}</textarea></p>
				<div class="polya">
					<p class="pleft">Показывать группам</p>
					<p class="pright">
						<select name="access[]" style="height:80px;" multiple="multiple">
			   				<option value="0" {ACCESS_SEL}>- Все -</option>
							{ACCESS}
						</select>
					</p>
				</div>
				<div class="polya">
					<p class="pleft">Состояние рекламного материала</p>
					<p class="pright"><input type="radio" name="onoff" {ONOFF_YES} value="1" class="check" /> Да <input type="radio" {ONOFF_NO} name="onoff" value="0" class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Зафексировать</p>
					<p class="pright"><input type="radio" {FIXED_YES} name="fixed" value="1" class="check" /> Да <input type="radio" name="fixed" {FIXED_NO} value="0" class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод на главной</p>
					<p class="pright"><input type="radio" name="allow_main" value="1" {ALLOW_MAIN_YES} class="check" /> Да <input type="radio" name="allow_main" value="0" {ALLOW_MAIN_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод в категориях</p>
					<p class="pright"><input type="radio" name="allow_cate" value="1" {ALLOW_CATE_YES} class="check" /> Да <input type="radio" name="allow_cate" value="0" {ALLOW_CATE_NO} class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод в статических страницах</p>
					<p class="pright"><input type="radio" name="allow_statik" value="1" {ALLOW_STATIK_YES} class="check" /> Да <input type="radio" name="allow_statik" {ALLOW_STATIK_NO} value="0" class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод в полной новости</p>
					<p class="pright"><input type="radio" name="allow_news" value="1" {ALLOW_NEWS_YES} class="check" /> Да <input type="radio" name="allow_news" {ALLOW_NEWS_NO} value="0" class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод в архиве новостей</p>
					<p class="pright"><input type="radio" name="allow_arhnews" value="1" {ALLOW_ARHNEWS_YES} class="check" /> Да <input type="radio" name="allow_arhnews" {ALLOW_ARHNEWS_NO} value="0" class="check" /> Нет</p>
				</div>
				<div class="polya">
					<p class="pleft">Вывод в поиске</p>
					<p class="pright"><input type="radio" name="allow_search" value="1" {ALLOW_SEARCH_YES} class="check" /> Да <input type="radio" name="allow_search" {ALLOW_SEARCH_NO} value="0" class="check" /> Нет</p>
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
