<div class="search">
	<form action="#" method="post">
	   	<div class="soder">
	   		<div class="searchform">
		   		<h3>Поиск по содержанию</h3>
		   		<div class="polya"><input name="keyword" value="" type="text" /> Слова для поиска</div>
		   		<select name="w_find">
					<option selected="selected" value="0">Искать в статьях</option>
				</select>
				<div class="polya">
					<select name="search_date" style="width:167px;">
						<option selected="selected" value="0">За все время</option>
						<option value="1">За сутки назад</option>
						<option value="7">За неделю назад</option>
						<option value="14">За 2 недели назад</option>
						<option value="30">За месяц назад</option>
						<option value="90">За 3 месяца назад</option>
						<option value="180">За 6 месяцев назад</option>
						<option value="365">За год назад</option>
					</select>
					<select name="type_search_date" style="width:80px;">
						<option selected="selected" value="0">и новее</option>
						<option value="1">и старее</option>
					</select>
					Временной период
				</div>
				<div class="polya">
					<select name="sort" style="width:157px;">
						<option value="0" selected="selected">Дата</option>
						<option value="1">Заголовок статьи</option>
				   		<option value="2">Количество просмотров</option>
						<option value="3">Имя автора</option>
					</select>
					<select name="order" style="width:90px;">
						<option selected="selected" value="0">По убыванию</option>
						<option value="1">По возрастанию</option>
					</select>
					Сортировка	
				</div>
		   	</div>
	   	</div>
	   	<div class="autor">
	   		<div class="searchform">
	   			<h3>Поиск по имени автора</h3>
				<div class="polya"><input style="width:190px;" name="autor" type="text" /> Имя автора</div>
				<select class="cats" style="height:93px;" name="cats[]" multiple="multiple">
					<option selected="selected" value="0">- Искать во всех разделах -</option>
		            {CATS}
		        </select>   		
	   		</div>
	   	</div>
	   	<div class="butto">
	   		<div id="searchform">
                <p><input type="hidden" name="action_searchf" value="submit" /></p>
	   			<p><input name="action_searchf" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
	   		</div>
		</div>
	</form>
</div>
