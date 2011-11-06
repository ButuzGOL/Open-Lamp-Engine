<style type="text/css" media="all">
#vote {margin:0px 10px 0px 3px;}
#vote1 {width:100%;}
#vote1 h3 { margin-bottom:7px; font-weight:normal; color:#333333; font-family:Georgia, "Times New Roman", Times, serif; font-size:18px; width:100%; text-align:center;}
#vote1 .votes { margin-bottom:7px;}
#vote1 .buttons {text-align:center; width:100%}
#vote1 input.submit {margin-top:10px; border:1px solid #cccccc; background:#FFFFFF; width:80px; background:#fafafa; color:#666666; padding:2px; font-size:10px;}
</style>
<div id="vote">
	<div id="vote1">
		<h3>{TITLE}</h3>
		<div class="votes">
			{VOTES}
		</div>
		<div class="buttons">
			<input class="submit" type="button" value="Голосовать" onclick="if (!vote_help) vote_help=1; gogoAj('vote','vote','id={ID}&amp;vote='+vote_help+'','{TEMPLATE}',0);" /> <input type="button" class="submit" value="Результаты" onclick="gogoAj('vote','vote','id={ID}','{TEMPLATE}',0)" />
		</div>
	</div>
</div>
