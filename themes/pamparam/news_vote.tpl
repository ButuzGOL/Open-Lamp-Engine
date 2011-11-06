<div id="news_vote">
    <div id="news_vote1">
    	<h3>{TITLE}</h3>
    	<div class="votes">
    		{VOTES}
    	</div>
    	<div class="buttons">
    	<input class="submit" type="button" value="Голосовать" onClick="if (!news_vote_help) news_vote_help=1; gogoAj('news_vote','newsvote','id={ID}&vote='+news_vote_help+'','{THEME}',0);"> <input type="button" class="submit" value="Результаты" onClick="gogoAj('news_vote','newsvote','id={ID}','{THEME}',0)">
    	</div>
    </div>
</div>
