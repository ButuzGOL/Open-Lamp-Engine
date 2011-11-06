var xmlHttp = createXmlHttpRequestObject();
var showErrors = true;
var cache = new Array();
var vote_help = 0;
var news_vote_help = 0;

function gogoAj(di, mod, str, img, type) {
	img_dir      = img;
	modul        = mod;
	div          = di;
	type_loading = type;
	goAj(div, modul, str); 
	 	
}

function createXmlHttpRequestObject() {
  var xmlHttp;
  try {
    xmlHttp = new XMLHttpRequest();
  }
  catch(e) {
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    for (var i=0; i < XmlHttpVersions.length && !xmlHttp; i++) {
      try { 
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {} 
    }
  }
  if (!xmlHttp)
	  alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}


function goAj(di, mod, str) {
  if (xmlHttp) {
    try {
      cache.push(str); 
	  if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0) && 
		  cache.length > 0) {
		div = di;
		modul = mod;
		
		if (type_loading==0) document.getElementById(div).innerHTML = "<div style=\"width:100%; text-align:center; height:90px; padding-top:60px;\"><img src='"+img_dir+"/images/loading.gif'></div>";
		if (type_loading==1) document.getElementById(div).innerHTML = "<div style=\"padding-left:35px;\"><img src='"+img_dir+"/images/loading1.gif' align=top></div>"; 
		if (type_loading==2) document.getElementById(div).innerHTML = "<img src='"+img_dir+"/images/loading1.gif' align=top>";
		
		xmlHttp.open("POST", "ajax.php?m="+modul, true);    
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");        
		xmlHttp.onreadystatechange = handleHttpGet;
        xmlHttp.send(cache.shift());
      }
    }
    catch(e) {
      displayError(xmlHttp.statusText);
    }
  }
}

function handleHttpGet() { 
  if (xmlHttp.readyState == 4) {
    if (xmlHttp.status == 200) {
      try {
        getResult();
      }
      catch(e) {
        displayError(xmlHttp.statusText);
      }
    } 
    else {
      displayError(xmlHttp.statusText);
    }        
  }
}

function getResult()
{ 
  response = xmlHttp.responseText;

  if (response.indexOf("ERRNO") >= 0
      || response.indexOf("error:") >= 0
      || response.length == 0)
    throw(response.length == 0 ? "Void server response." : response);

  response = response.slice(response.indexOf("<response>")+10,response.indexOf("</response>"));

  response = response.replace(/\[/g,"<");
  response = response.replace(/\]/g,">");

  if (div!="") document.getElementById(div).innerHTML = response;
}

function displayError($message) {
  if (showErrors) {
    showErrors = false;
    alert("Error encountered: \n" + $message);
  }
}

/**
 * @author r0n9.GOL
 * @copyright 2008
 */
