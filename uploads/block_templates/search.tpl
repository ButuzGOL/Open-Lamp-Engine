<style type="text/css" media="all">
#search {margin:10px;}
#search input {background:#fafafa; border:1px solid #cccccc;color:#666666; width:70%; padding:4px;}
#search input.submit {border:none; width:32px; height:32px; vertical-align:top;}
</style>
<div id="search">
	<form action="index.php?m=search" method="post">
    	<p><input type="hidden" name="action_search" value="submit" /></p>
    	<p><input type="text" name="search" /> <input type="image" name="action_search" value="submit" class="submit" src="{BLOCK_TEMPLATE}/images/search.png" /></p>
	</form>
</div>
