<div class="middle0">
	<h1><a href="?m=theme"><img src="{THEME}/images/tpl.png" title="Тема сайта" alt="Тема сайта" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post">
				<div class="uava1">	
					<p><input type="hidden" name="action" value="submit" /></p>
					<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
				</div>	
				<div>
					<b><a class="shab" href="#" onclick="showOrhide('theader', this)">Общий макет страницы Верх (header.tpl)</a></b>
					<br />
					<br />
					<div id="theader" style="display: none;">
						<b>&lt;!-- в начале --&gt; в конце - не удаляйте их </b><br /> 
						<b>{*TITLE*}</b> - заголовок который будет постояено менятся взасимости от переходов<br />
						<b>{CHARSET}</b> - кодировка сайта<br />
						<b>{DESCR}</b> - описание которое будет постояено менятся взасимости от переходов<br />
						<b>{KEYWORDS}</b> - ключевые слова который будут постояено менятся взасимости от переходов<br />
						<b>{*HURL*}</b> - url сайта<br />
						<b>{HTITLE}</b> - заголовок сайта<br />
						<b>{HDESCR}</b> - описание сайта<br />
						<b>{LEFT_BLOCKS}</b> - левые блоки (могут быть в header.tpl или footer.tpl)<br />
     					<b>{RIGHT_BLOCKS}</b> - правые блоки (могут быть в header.tpl или footer.tpl)<br /><br />
						<textarea rows="15" cols="" name="header">{HEADER}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tfooter', this)">Общий макет страницы Низ (footer.tpl)</a></b>
					<br />
					<br />
					<div id="tfooter" style="display: none;">
						<b>{BUTTOM_BLOCKS}</b> - нижнии блоки<br />
     					<b>{LEFT_BLOCKS}</b> - левые блоки (могут быть в header.tpl или footer.tpl)<br />
     					<b>{RIGHT_BLOCKS}</b> - правые блоки (могут быть в header.tpl или footer.tpl)<br /><br />
						<textarea rows="15" cols="" name="footer" style="height:200px;">{FOOTER}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tdefault_middle', this)">Общий макет страницы центр середины по умолчанию (default_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tdefault_middle" style="display: none;">
						<b>{*TITLE*}</b> - заголовок<br />
     					<b>{MIDDLE}</b> - внутриность<br /><br />
						<textarea rows="15" cols="" name="default_middle" style="height:100px;">{DEFAULT_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tdefault_block', this)">Блок по умолчанию (default_block.tpl)</a></b>
					<br />
					<br />
					<div id="tdefault_block" style="display: none;">
						<b>{*TITLE*}</b> - заголовок который задается при создании блока<br />
     					<b>{MIDDLE}</b> - внутриность блока<br /><br />
						<textarea rows="15" cols="" name="default_block" style="height:100px;">{DEFAULT_BLOCK}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tshow_mess', this)">Вывод сообщения (show_mess.tpl)</a></b>
					<br />
					<br />
					<div id="tshow_mess" style="display: none;">
						<b>{*TITLE*}</b> - заголовок сообщения<br />
     					<b>{MIDDLE}</b> - текст сообщения<br /><br />
						<textarea rows="15" cols="4" name="show_mess" style="height:100px;">{SHOW_MESS}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_allshow', this)">Вывод не полной новости (news_allshow.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_allshow" style="display: none;">
						<b>{*TITLE*}</b> - заголовок новости<br />
						<b>{DEL}</b> - возможность удалить новость<br />
     					<b>{EDIT}</b> - возможность отредоктировать новость<br />
     					<b>{DATE}</b> - дата новости<br />
     					<b>{CATE}</b> - категория новости<br />
     					<b>{FULL}</b> - возможность просмотра полной новости<br />
     					<b>{SHORT_STORY}</b> - не полное содержания новости<br />
     					<b>{ID}</b> - ID новости<br />
     					<b>{RATE}</b> - рейтинг новости<br />
     					<b>{AUTOR}</b> - автор новости<br />
     					<b>{NEWS_READ}</b> - количество просмотров<br />
     					<b>{BOOKMARKS}</b> - закладка новости<br /><br />
						<textarea rows="15" cols="" name="news_allshow" style="height:200px;">{NEWS_ALLSHOW}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_show', this)">Вывод полной новости (news_show.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_show" style="display: none;">
						<b>{*TITLE*}</b> - заголовок новости<br />
						<b>{DEL}</b> - возможность удалить новость<br />
     					<b>{EDIT}</b> - возможность отредоктировать новость<br />
     					<b>{DATE}</b> - дата новости<br />
     					<b>{CATE}</b> - категория новости<br />
     					<b>{KOL_COMM}</b> - количество комментариев<br />
     					<b>{FULL_STORY}</b> - полное содержания новости<br />
     					<b>{VOTE}</b> - опрос в новости<br />
     					<b>{ID}</b> - ID новости<br />
     					<b>{RATE}</b> - рейтинг новости<br />
     					<b>{AUTOR}</b> - автор новости<br />
     					<b>{NEWS_READ}</b> - количество просмотров<br />
     					<b>{BOOKMARKS}</b> - закладка новости<br /><br />
						<textarea rows="15" cols="" name="news_show" style="height:200px;">{NEWS_SHOW}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_vote', this)">Опрос в новости (news_vote.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_vote" style="display: none;">
						<b>{*TITLE*}</b> - заголовок опроса<br />
						<b>{VOTES}</b> - варианты опроса<br />
     					<b>{ID}</b> - ID опроса<br /><br />
						<textarea rows="15" cols="" name="news_vote" style="height:200px;">{NEWS_VOTE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_votea', this)">Просмотра хода опроса в новости (news_votea.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_votea" style="display: none;">
						<b>{*TITLE*}</b> - заголовок опроса<br />
						<b>{VOTES}</b> - варианты опроса<br />
     					<b>{KOL_VOTE}</b> - количество голосов в опросе<br />
     					<b>{DATE}</b> - дата начала опроса<br /><br />
						<textarea rows="15" cols="" name="news_votea" style="height:200px;">{NEWS_VOTEA}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_allshowm_middle', this)">Вывод списка новостей (news_allshowm_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_allshowm_middle" style="display: none;">
						<b>{*TITLE*}</b> - заголовок новости<br />
						<b>{DEL}</b> - возможность удалить новость<br />
     					<b>{EDIT}</b> - возможность отредоктировать новость<br />
     					<b>{AUTOR}</b> - автор новости<br />
     					<b>{DATE}</b> - дата новости<br />
     					<b>{NEWS_READ}</b> - количество просмотров<br />
     					<b>{KOL_COMM}</b> - количество комментариев<br /><br />
						<textarea rows="15" cols="" name="news_allshowm_middle" style="height:130px;">{NEWS_ALLSHOWM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tnews_form_middle', this)">Добавление и редактирование новости (news_form_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tnews_form_middle" style="display: none;">
						<textarea rows="15" cols="" name="news_form_middle">{NEWS_FORM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcomments_show', this)">Вывод комментария (comments_show.tpl)</a></b>
					<br />
					<br />
					<div id="tcomments_show" style="display: none;">
						<b>{AUTOR}</b> - автор комментария<br />			
						<b>{DATE}</b> - дата комментария<br />
						<b>{DELС}</b> - возможность удалить комментарии<br />
     					<b>{EDITС}</b> - возможность отредоктировать комментарии<br />
     					<b>{AVATAR}</b> - аватар пользователя котории оставил комментарии<br />
     					<b>{TEXT}</b> - содержание комментария<br />
     					<b>{AUTOR1}</b> - автор комментария как ссылка<br />			
     					<b>{EMAIL}</b> - email пользователя котории оставил комментарии<br />
     					<b>{ICQ}</b> -  icq пользователя котории оставил комментарии<br />
     					<b>{IP}</b> - ip пользователя котории оставил комментарии<br /><br />
						<textarea rows="15" cols="" name="comments_show" style="height:220px;">{COMMENTS_SHOW}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcomments_add_middle1', this)">Добавления комментария для зарегестрированых пользователей (comments_add_middle1.tpl)</a></b>
					<br />
					<br />
					<div id="tcomments_add_middle1" style="display: none;">
						<textarea rows="15" cols="" name="comments_add_middle1" style="height:160px;">{COMMENTS_ADD_MIDDLE1}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcomments_add_middle2', this)">Добавления комментария для не зарегестрированых пользователей (comments_add_middle2.tpl)</a></b>
					<br />
					<br />
					<div id="tcomments_add_middle2" style="display: none;">
						<textarea rows="15" cols="" name="comments_add_middle2" style="height:200px;">{COMMENTS_ADD_MIDDLE2}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcomments_edit_middle', this)">Редоктирование комментария (comments_edit_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tcomments_edit_middle" style="display: none;">
						<textarea rows="15" cols="" name="comments_edit_middle" style="height:160px;">{COMMENTS_EDIT_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tpages', this)">Страници комментариев и новостей (pages.tpl)</a></b>
					<br />
					<br />
					<div id="tpages" style="display: none;">
						<b>{PRIV}</b> - вперед<br />
						<b>{LPAGES}</b> - страницы<br />
						<b>{NEXT}</b> - назад<br /><br />
						<textarea rows="15" cols="" name="pages" style="height:50px;">{PAGES}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tstatik_show', this)">Вывод статической страницы (statik_show.tpl)</a></b>
					<br />
					<br />
					<div id="tstatik_show" style="display: none;">
						<b>{*TITLE*}</b> - заголовок статическои страницы<br />			
						<b>{DEL}</b> - возможность удалить заголовок статическую страницу<br />
     					<b>{EDIT}</b> - возможность отредоктировать заголовок статическую страницу<br />
     					<b>{DATE}</b> - дата заголовок статическои страницы<br />
						<b>{STORY}</b> - содержание статическои страницы<br />
						<b>{AUTOR}</b> - автор комментария<br />
     					<b>{VIEWS}</b> - количество просмотров статическои страницы<br /><br />
						<textarea rows="15" cols="" name="statik_show" style="height:200px;">{STATIK_SHOW}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tstatik_allshowm_middle', this)">Вывод списка статических страниц (statik_allshowm_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tstatik_allshowm_middle" style="display: none;">
						<b>{*TITLE*}</b> - заголовок статическои страницы<br />			
						<b>{DEL}</b> - возможность удалить заголовок статическую страницу<br />
     					<b>{EDIT}</b> - возможность отредоктировать заголовок статическую страницу<br />
     					<b>{AUTOR}</b> - автор комментария<br />
     					<b>{DATE}</b> - дата заголовок статическои страницы<br />
						<b>{VIEWS}</b> - количество просмотров статическои страницы<br /><br />
						<textarea rows="15" cols="" name="statik_allshowm_middle" style="height:120px;">{STATIK_ALLSHOWM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tstatik_form_middle', this)">Добавление и редактирование статической страницы (statik_form_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tstatik_form_middle" style="display: none;">
						<textarea rows="15" cols="" name="statik_form_middle">{STATIK_FORM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tpm_show_middle', this)">Вывод персонального сообщения (pm_show_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tpm_show_middle" style="display: none;">
						<b>{SUBJ}</b> - тема персонального сообщения<br />			
						<b>{USER}</b> - пользователь отправевшый персональное сообщение<br />
     					<b>{DATE}</b> - дата персонального сообщения<br />
     					<b>{TEXT}</b> - содержание персонального сообщения<br /><br />
						<textarea rows="15" cols="" name="pm_show_middle" style="height:250px;">{PM_SHOW_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tpm_allshowm_middle', this)">Вывод списка персональных сообщений (pm_allshowm_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tpm_allshowm_middle" style="display: none;">
						<b>{ID1}</b> - ID персонального сообщения<br />
						<b>{SUBJ}</b> - тема персонального сообщения<br />			
						<b>{USER}</b> - пользователь отправевшый персональное сообщение<br />
     					<b>{DATE}</b> - дата персонального сообщения<br /><br />
						<textarea rows="15" cols="" name="pm_allshowm_middle" style="height:100px;">{PM_ALLSHOWM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tpm_add_middle', this)">Добавление персонального сообщения (pm_add_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tpm_add_middle" style="display: none;">
						<textarea rows="15" cols="" name="pm_add_middle" style="height:200px;">{PM_ADD_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tarhnews_allshowm_middle', this)">Список архивов новостей (arhnews_allshowm_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tarhnews_allshowm_middle" style="display: none;">
						<b>{MIDDLE}</b> - содержание архива новостей<br /><br />
						<textarea rows="15" cols="" name="arhnews_allshowm_middle" style="height:130px;">{ARHNEWS_ALLSHOWM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcategories_allshowm_middle', this)">Список категории новостей (categories_allshowm_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tcategories_allshowm_middle" style="display: none;">
						<b>{MIDDLE}</b> - содержание категории новостей<br /><br />
						<textarea rows="15" cols="" name="categories_allshowm_middle" style="height:130px;">{CATEGORIES_ALLSHOWM_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tlostpass_middle', this)">Форма забытого пароля (lostpass_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tlostpass_middle" style="display: none;">
						<textarea rows="15" cols="" name="lostpass_middle" style="height:200px;">{LOSTPASS_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tregistr_middle', this)">Форма регистрации (registr_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tregistr_middle" style="display: none;">
						<textarea rows="15" cols="" name="registr_middle" style="height:250px;">{REGISTR_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tsearch_middle', this)">Форма поиска (search_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tsearch_middle" style="display: none;">
						<textarea rows="15" cols="" name="search_middle">{SEARCH_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tprofile_middle', this)">Профиль (profile_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tprofile_middle" style="display: none;">
						<textarea rows="15" cols="" name="profile_middle">{PROFILE_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tstatistik_middle', this)">Статистика (statistik_middle.tpl)</a></b>
					<br />
					<br />
					<div id="tstatistik_middle" style="display: none;">
						<textarea rows="15" cols="" name="statistik_middle">{STATISTIK_MIDDLE}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tmesscs', this)">Сообщение когда сайт выключен или ошибка MySQL или заблокированый IP (messcs.tpl)</a></b>
					<br />
					<br />
					<div id="tmesscs" style="display: none;">
						<b>{*TITLE*}</b> - заголовок<br />
						<b>{CHARSET}</b> - кодировка<br />
						<b>{HTITLE}</b> - заголовок сообщения<br />
						<b>{*MESS*}</b> - сообщение<br /><br />
						<textarea rows="15" cols="" name="messcs">{MESSCS}</textarea>
					</div>
					<b><a class="shab" href="#" onclick="showOrhide('tcalendarcss', this)">Календар css который в добавлении или редоктировании новости (calendar.css) </a></b>
					<br />
					<br />
					<div id="tcalendarcss" style="display: none;">
						<textarea rows="15" cols="" name="calendarcss">{CALENDARCSS}</textarea>
					</div>
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
