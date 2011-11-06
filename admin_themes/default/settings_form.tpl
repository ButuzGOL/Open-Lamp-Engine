<div class="middle0">
	<h1><a href="?m=settings"><img src="{THEME}/images/settings.png" title="Настройки" alt="Настройки" /></a> {TITLEE}</h1>
	<div class="back"><a href="?m=start"><img src="{THEME}/images/back.png" title="Главная" alt="Главная" /></a></div>
	<div class="forma">
		{MESS}
		<div class="form">
			<form action="#" method="post" id="formata">
				<div class="menu">
					<img src="{THEME}/images/settings_form1.png" alt="Общие" title="Общие" onclick="tab('general');" /> 
					<img src="{THEME}/images/settings_form2.png" alt="Безопасность" title="Безопасность" onclick="tab('security');" />
					<img src="{THEME}/images/settings_form3.png" alt="Новости и комментарий" title="Новости и комментарий" onclick="tab('newscomm');" />
					<img src="{THEME}/images/settings_form4.png" alt="Пользователи" title="Пользователи" onclick="tab('userss');" />
					<img src="{THEME}/images/settings_form5.png" alt="База данных MySQL" title="База данных MySQL" onclick="tab('mysql');" />
				</div>
				<div id="general" style="display:;">
					<div class="polya">
						<p class="pleft">Домашняя страница сайта * <br /><span class="small">Например: http://yoursite.com/</span></p>
						<p class="pright"><input type="text" maxlength="200" name="url" value="{URL}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Название сайта <br /><span class="small">Например: "Моя домашняя страница"</span></p>
						<p class="pright"><input type="text" maxlength="200" name="title" value="{TITLE}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Используемая кодировка на сайте</p>
						<p class="pright"><input type="text" maxlength="200" name="charset" value="{CHARSET}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Описание сайта</p>
						<p class="pright"><input type="text" maxlength="200" name="descr" value="{DESCR}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Ключевые слова сайта</p>
						<p class="pright"><textarea name="keywords" class="smallta" cols="" rows="">{KEYWORDS}</textarea></p>
					</div>
					<div class="polya">
						<p class="pleft">Автор сайта</p>
						<p class="pright"><input type="text" maxlength="200" name="autor" value="{AUTOR}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Тема сайта</p>
						<p class="pright">
							<select name="themes" style="width:200px">
            					{THEMES}
           					</select>
            			</p>
					</div>
					<div class="polya">
						<p class="pleft">Сайт включен</p>
						<p class="pright"><input type="radio" name="site_onoff" {SITE_ONOFF_YES} value="1" class="check" /> Да <input type="radio" name="site_onoff" {SITE_ONOFF_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Сообщение при выключенном сайте</p>
						<p class="pright"><textarea name="site_monoff" cols="" rows="" class="smallta">{SITE_MONOFF}</textarea></p>
					</div>
					<div class="polya">
						<p class="pleft">Разрешить пользователям загружать картинки</p>
						<p class="pright"><input type="radio" name="allow_dimg" {ALLOW_DIMG_YES} value="1" class="check" /> Да <input type="radio" name="allow_dimg" {ALLOW_DIMG_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Максимально допустимый объём изображения <br /><span class="small">в килобайтах</span></p>
						<p class="pright">
							<select name="simg">
								<option value="100">100</option>
								<option value="200">200</option>
								<option value="300">300</option>
								<option value="400">400</option>
								<option value="600">600</option>
								<option value="800">800</option>
								<option value="1000">1000</option>
								<option value="1200">1200</option>
								<option value="1500">1500</option>
								<option value="2000">2000</option>
								<option value="2500">2500</option>
								<option value="3000">3000</option>
								<option value="4000">4000</option>
								<option value="5000">5000</option>
								<option value="6000">6000</option>
								<option value="7000">7000</option>
								<option value="8000">8000</option>
								<option value="9000">9000</option>
								<option value="10000">10000</option>
							</select>
						</p>
						<br /><br />
					</div>
				</div>
				<div id="security" style="display:none;">
					<div class="polya">
						<p class="pleft">Имя файла панели управления *</p>
						<p class="pright"><input type="text" maxlength="200" name="adm_file" value="{ADM_FILE}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Не запаменать пользователя <br /><span class="small">при авторизации</span></p>
						<p class="pright"><input type="radio" name="allow_renter" {ALLOW_RENTER_YES} value="1" class="check" /> Да <input type="radio" name="allow_renter" {ALLOW_RENTER_NO} value="0" class="check" /> Нет</p>
					</div>
					<br />
				</div>
				<div id="newscomm" style="display:none;">
					<div class="polya">
						<p class="pleft">Количество новостей на страницу</p>
						<p class="pright">
							<select name="news_num">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
								<option value="32">32</option>
								<option value="33">33</option>
								<option value="34">34</option>
								<option value="35">35</option>
								<option value="36">36</option>
								<option value="37">37</option>
								<option value="38">38</option>
								<option value="39">39</option>
								<option value="40">40</option>
								<option value="41">41</option>
								<option value="42">42</option>
								<option value="43">43</option>
								<option value="44">44</option>
								<option value="45">45</option>
								<option value="46">46</option>
								<option value="47">47</option>
								<option value="48">48</option>
								<option value="49">49</option>
								<option value="50">50</option>
								<option value="51">51</option>
								<option value="52">52</option>
								<option value="53">53</option>
								<option value="54">54</option>
								<option value="55">55</option>
								<option value="56">56</option>
								<option value="57">57</option>
								<option value="58">58</option>
								<option value="59">59</option>
								<option value="60">60</option>
								<option value="61">61</option>
								<option value="62">62</option>
								<option value="63">63</option>
								<option value="64">64</option>
								<option value="65">65</option>
								<option value="66">66</option>
								<option value="67">67</option>
								<option value="68">68</option>
								<option value="69">69</option>
								<option value="70">70</option>
								<option value="71">71</option>
								<option value="72">72</option>
								<option value="73">73</option>
								<option value="74">74</option>
								<option value="75">75</option>
								<option value="76">76</option>
								<option value="77">77</option>
								<option value="78">78</option>
								<option value="79">79</option>
								<option value="80">80</option>
								<option value="81">81</option>
								<option value="82">82</option>
								<option value="83">83</option>
								<option value="84">84</option>
								<option value="85">85</option>
								<option value="86">86</option>
								<option value="87">87</option>
								<option value="88">88</option>
								<option value="89">89</option>
								<option value="90">90</option>
								<option value="91">91</option>
								<option value="92">92</option>
								<option value="93">93</option>
								<option value="94">94</option>
								<option value="95">95</option>
								<option value="96">96</option>
								<option value="97">97</option>
								<option value="98">98</option>
								<option value="99">99</option>
								<option value="100">100</option>
							</select>
						</p>
					</div>
					<div class="polya">
						<p class="pleft">Критерий сортировки новостей</p>
						<p class="pright">
							<select name="news_sort">
								<option value="1">По дате публикации</option>
								<option value="2">По просмотрам</option>
								<option value="3">По алфавиту</option>
							</select>
						</p>
					</div>
					<div class="polya">
						<p class="pleft">Порядок сортировки новостей</p>
						<p class="pright">
							<select name="news_msort">
								<option value="1">По убыванию</option>
								<option value="2">По возрастанию</option>
							</select>
						</p>
					</div>
					<div class="polya">
						<p class="pleft">Отсылать Вам E-Mail уведомление при добавлении новой новости</p>
						<p class="pright"><input type="radio" name="news_email" {NEWS_EMAIL_YES} value="1" class="check" /> Да <input type="radio" name="news_email" {NEWS_EMAIL_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Количество комментариев на страницу</p>
						<p class="pright">
							<select name="comm_num">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
								<option value="32">32</option>
								<option value="33">33</option>
								<option value="34">34</option>
								<option value="35">35</option>
								<option value="36">36</option>
								<option value="37">37</option>
								<option value="38">38</option>
								<option value="39">39</option>
								<option value="40">40</option>
								<option value="41">41</option>
								<option value="42">42</option>
								<option value="43">43</option>
								<option value="44">44</option>
								<option value="45">45</option>
								<option value="46">46</option>
								<option value="47">47</option>
								<option value="48">48</option>
								<option value="49">49</option>
								<option value="50">50</option>
								<option value="51">51</option>
								<option value="52">52</option>
								<option value="53">53</option>
								<option value="54">54</option>
								<option value="55">55</option>
								<option value="56">56</option>
								<option value="57">57</option>
								<option value="58">58</option>
								<option value="59">59</option>
								<option value="60">60</option>
								<option value="61">61</option>
								<option value="62">62</option>
								<option value="63">63</option>
								<option value="64">64</option>
								<option value="65">65</option>
								<option value="66">66</option>
								<option value="67">67</option>
								<option value="68">68</option>
								<option value="69">69</option>
								<option value="70">70</option>
								<option value="71">71</option>
								<option value="72">72</option>
								<option value="73">73</option>
								<option value="74">74</option>
								<option value="75">75</option>
								<option value="76">76</option>
								<option value="77">77</option>
								<option value="78">78</option>
								<option value="79">79</option>
								<option value="80">80</option>
								<option value="81">81</option>
								<option value="82">82</option>
								<option value="83">83</option>
								<option value="84">84</option>
								<option value="85">85</option>
								<option value="86">86</option>
								<option value="87">87</option>
								<option value="88">88</option>
								<option value="89">89</option>
								<option value="90">90</option>
								<option value="91">91</option>
								<option value="92">92</option>
								<option value="93">93</option>
								<option value="94">94</option>
								<option value="95">95</option>
								<option value="96">96</option>
								<option value="97">97</option>
								<option value="98">98</option>
								<option value="99">99</option>
								<option value="100">100</option>
							</select>
						</p>
					</div>
					<div class="polya">
						<p class="pleft">Порядок сортировки комментариев</p>
						<p class="pright">
							<select name="comm_msort">
								<option value="1">По убыванию</option>
								<option value="2">По возрастанию</option>
							</select>
						</p>
					</div>
				</div>
				<div id="userss" style="display:none;">
					<div class="polya">
						<p class="pleft">Включить поддержку регистрации на сайте</p>
						<p class="pright"><input type="radio" name="allow_reg" {ALLOW_REG_YES} value="1" class="check" /> Да <input type="radio" name="allow_reg" {ALLOW_REG_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Регистрировать новых пользователей в группе</p>
						<p class="pright">
							<select name="reg_group">
            					{REG_GROUP}
        					</select>
        				</p>
					</div>
					<div class="polya">
						<p class="pleft">Гости сайта в группе</p>
						<p class="pright">
							<select name="gost_group">
								{GOST_GROUP}
							</select>
        				</p>
					</div>
					<div class="polya">
						<p class="pleft">Отсылать письмо с активацией аккаунта на email</p>
						<p class="pright"><input type="radio" name="send_regemail" {SEND_REGEMAIL_YES} value="1" class="check" /> Да <input type="radio" name="send_regemail" {SEND_REGEMAIL_NO} value="0" class="check" /> Нет</p>
					</div>
					<div class="polya">
						<p class="pleft">Максимальное количество зарегистрированных пользователей</p>
						<p class="pright">
							<select name="users_kol">
								<option value="0">Неограничено</option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="30">30</option>
								<option value="40">40</option>
								<option value="50">50</option>
								<option value="60">60</option>
								<option value="70">70</option>
								<option value="80">80</option>
								<option value="90">90</option>
								<option value="100">100</option>
								<option value="120">120</option>
								<option value="140">140</option>
								<option value="160">160</option>
								<option value="180">180</option>
								<option value="200">200</option>
								<option value="230">230</option>
								<option value="260">260</option>
								<option value="290">290</option>
								<option value="300">300</option>
								<option value="340">340</option>
								<option value="380">380</option>
								<option value="400">400</option>
								<option value="450">450</option>
								<option value="500">500</option>
								<option value="550">550</option>
								<option value="600">600</option>
								<option value="650">650</option>
								<option value="700">700</option>
								<option value="750">750</option>
								<option value="800">800</option>
								<option value="850">850</option>
								<option value="900">900</option>
								<option value="1000">1000</option>
								<option value="1100">1100</option>
								<option value="1200">1200</option>
								<option value="1300">1300</option>
								<option value="1400">1400</option>
								<option value="1500">1500</option>
								<option value="1600">1600</option>
								<option value="1700">1700</option>
								<option value="1800">1800</option>
								<option value="1900">1900</option>
								<option value="2000">2000</option>
								<option value="2100">2100</option>
								<option value="2200">2200</option>
								<option value="2300">2300</option>
								<option value="2400">2400</option>
								<option value="2500">2500</option>
								<option value="2700">2700</option>
								<option value="2900">2900</option>
								<option value="3000">3000</option>
								<option value="3500">3500</option>
								<option value="4000">4000</option>
								<option value="4500">4500</option>
								<option value="5000">5000</option>
								<option value="5500">5500</option>
								<option value="6000">6000</option>
								<option value="6500">6500</option>
								<option value="7000">7000</option>
								<option value="7500">7500</option>
								<option value="8000">8000</option>
								<option value="8500">8500</option>
								<option value="9000">9000</option>
								<option value="9500">9500</option>
								<option value="10000">10000</option>
							</select>
						</p>
					</div>
					<br />
				</div>
				<div id="mysql" style="display:none;">
					<div class="polya">
						<p class="pleft">Адрес хоста MySQL *</p>
						<p class="pright"><input type="text" maxlength="200" name="mysql_host" value="{MYSQL_HOST}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">Имя пользователя БД MySQL</p>
						<p class="pright"><input type="text" maxlength="200" name="mysql_user" value="{MYSQL_USER}" /></p>
					</div>
					<div class="polya">
						<p class="pleft">База данных MySQL *</p>
						<p class="pright"><input type="text" maxlength="200" name="mysql_db" value="{MYSQL_DB}" /></p>
					</div>	
					<div class="polya">
						<p class="pleft">Префикс базы данных MySQL *</p>
						<p class="pright"><input type="text" maxlength="200" name="mysql_pref" value="{MYSQL_PREF}" /></p>
					</div>		
				</div>
                <p><input type="hidden" name="action" value="submit" /></p>
				<p><input name="action" type="image" src="{THEME}/images/acceptform.png" class="submit" value="submit" /></p>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
/* <![CDATA[ */
function tab(div) {
    document.getElementById('general').style.display = "none";
    document.getElementById('security').style.display = "none";
    document.getElementById('newscomm').style.display  = "none";
    document.getElementById('userss').style.display  = "none";
    document.getElementById('mysql').style.display  = "none";

    document.getElementById(div).style.display = "";
}
/* ]]> */
</script>

<script type="text/javascript">
/* <![CDATA[ */
    document.getElementById('formata').news_sort.options[{NEWS_SORT}-1].selected     = true;
    document.getElementById('formata').news_msort.options[{NEWS_MSORT}-1].selected   = true;
    document.getElementById('formata').news_num.options[{NEWS_NUM}-1].selected       = true;
    document.getElementById('formata').comm_msort.options[{COMM_MSORT}-1].selected   = true;
    document.getElementById('formata').comm_num.options[{COMM_NUM}-1].selected       = true;

    for (i=0; i < 1000; i++)
        if (document.getElementById('formata').simg.options[i].value == "{SIMG}")
            {document.getElementById('formata').simg.options[i].selected = true; break;}

    for (i=0; i < 1000; i++)
        if (document.getElementById('formata').users_kol.options[i].value == "{USERS_KOL}")
            {document.getElementById('formata').users_kol.options[i].selected = true; break;}
/* ]]> */
</script>
