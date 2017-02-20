var atl_qbi_is_ie6under;
var atl_qbi_is_safari;
var atl_qbi_popupData = new Array();
var atl_qbi_querystring = '';
var agt = navigator.userAgent.toLowerCase();
var is_ie = agt.indexOf("msie")!=-1;

function atlQbiShowElement(elmID) {
  for(i = 0; i < document.getElementsByTagName( elmID ).length; i++) {
    obj = document.getElementsByTagName(elmID)[i];
    if(!obj || !obj.offsetParent) continue;
		if (is_ie&&(obj.readyState==4)&&(obj.tagName.toUpperCase()=='OBJECT')) continue;
    obj.style.visibility = '';
  }
}

function atlQbiHideElement(elmID, overDiv ) {
  for(i = 0; i < document.getElementsByTagName( elmID ).length; i++) {
    obj = document.getElementsByTagName( elmID )[i];
    if(!obj || !obj.offsetParent) continue;
    // Find the element's offsetTop and offsetLeft relative to the BODY tag.
    objLeft   = obj.offsetLeft - overDiv.offsetParent.offsetLeft;
    objTop    = obj.offsetTop;
    objParent = obj.offsetParent;
    while((objParent.tagName.toUpperCase() != 'BODY')&&(objParent.tagName.toUpperCase() != 'HTML')){
      objLeft  += objParent.offsetLeft;
      objTop   += objParent.offsetTop;
      objParent = objParent.offsetParent;}
    objHeight = obj.offsetHeight;
    objWidth  = obj.offsetWidth;
    if((overDiv.offsetLeft + overDiv.offsetWidth) <= objLeft) continue;
    else if((overDiv.offsetParent.offsetTop + overDiv.offsetHeight + 20) <= objTop) continue;
    else if(overDiv.offsetParent.offsetTop >= eval(objTop + objHeight)) continue;
    else if(overDiv.offsetLeft >= eval(objLeft + objWidth)) continue;
    else {
      obj.style.visibility = 'hidden';
    }
  }	    
}

function atlQbiGetPopupDataIndex(targetDivId) {
    var index = -1;
    for(var i=0; i<atl_qbi_popupData.length; i++) {
        if(atl_qbi_popupData[i].targetDiv.id == targetDivId) {
            index = i;
            break;
        }
    }
    return index;
}

//ciCodes is an array of integers
//the first one in this array is reserved for the quickbuy button
//the rest are available for use by specific quickbuy implementations
function atlQbiInitializeEx(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl, queryString) {
    atl_qbi_querystring = queryString;
    atlQbiInitialize(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl);
}

function atlQbiInitializeEx(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl, queryString, returnToMyr) {
    atl_qbi_querystring = queryString;
    atlQbiInitialize(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl, returnToMyr);
}

function atlQbiInitialize(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl) {
  var returnToMyr = "False";
  atlQbiInitialize(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl, returnToMyr);
}
function atlQbiInitialize(targetDiv, quickBuyName, itemTrackingCode, ciCodes, siteUrl, returnToMyr) {
    var index = atlQbiGetPopupDataIndex(targetDiv.id);
    if (index == -1) {
      atl_qbi_popupData[atl_qbi_popupData.length] = { "targetDiv": targetDiv, "quickBuyName": quickBuyName, "siteUrl": siteUrl, "cacheFlag": false, "itemTrackingCode": itemTrackingCode, "ciCodes": ciCodes, "returnToMyr": returnToMyr };
    }
    else {
        atl_qbi_popupData[index].targetDiv = targetDiv;
        atl_qbi_popupData[index].quickBuyName = quickBuyName;
        atl_qbi_popupData[index].siteUrl = siteUrl;
        atl_qbi_popupData[index].cacheFlag = false;
        atl_qbi_popupData[index].itemTrackingCode = itemTrackingCode;
        atl_qbi_popupData[index].ciCodes = ciCodes;
        atl_qbi_popupData[index].returnToMyr = returnToMyr;
    }
	atl_qbi_is_safari = agt.indexOf("safari")!=-1;

	if (is_ie) {
		atl_qbi_is_ie6under = (agt.indexOf("msie 6")!=-1 || agt.indexOf("msie 5")!=-1 || agt.indexOf("msie 4")!=-1);
	}
}

function atlQbiFindChildNode(node, findId) {
	var existingNode = null;
	if (node.hasChildNodes) {
		var currentNode = node.firstChild;
		while (currentNode != null) {
			if (currentNode.id == findId) {
				existingNode = currentNode;
				break;
			}
			currentNode = currentNode.nextSibling;
		}
	}
	return existingNode;
}

function atlQbiClearCache(){
	atl_qbi_cachedFlag = false;
}

function atlQbiClearPopupCache(targetDiv) {
    var index = atlQbiGetPopupDataIndex(targetDiv.id);
    if (index > -1) {
      var popupData = atl_qbi_popupData[index];
      popupData.cacheFlag = false;
    }}

function atlQbiShowInt(targetDiv) {
	if (targetDiv != null) {
		atlQbiSetVisibility(targetDiv.id, true);
	
		if (atl_qbi_is_ie6under) {
			atlQbiHideElement('SELECT', targetDiv);
		}
	}
}

function atlQbiShow(targetDiv, event, element){
  atlQuickBuyBeforeShow();
  var index = atlQbiGetPopupDataIndex(targetDiv.id);
  if (index > -1) {
    var popupData = atl_qbi_popupData[index];
    
    //ci for the quickbuy button click
    //the remaining ci codes in the ciCodes array will be handled by the individual quickbuy popups
    var ciCode = -1;
    if (popupData.ciCodes.length > 0) {
        ciCode = popupData.ciCodes[0];
    }
    
    if ((ciCode > 0) && (typeof FastballEvent_MouseClick == 'function')) {
        FastballEvent_MouseClick(event, ciCode, element, '', 'div');
    }

    if (popupData.cacheFlag && !atl_qbi_is_ie6under) {
      atlQbiShowInt(popupData.targetDiv);
    }
    else {
      atlQbiCallForContent(popupData);
    }
  }
}

function atlQuickBuyBeforeShow(){
  if(typeof (ShowHideDomainSearchDiv) != 'undefined'){
    ShowHideDomainSearchDiv('hide');
  }
}

function atlQuickBuyBeforeClose(){
  if(typeof (ShowHideDomainSearchDiv) != 'undefined'){
    ShowHideDomainSearchDiv('show');
  }
  if (typeof (QuickBuyCloseNotify) != 'undefined') {
    QuickBuyCloseNotify();
  }
}

function atlQbiCallForContent(popupData){
	var request = popupData.siteUrl + "QuickBuy/QuickBuyInsert.aspx";
    if (atl_qbi_querystring.length == 0) {
      request = request + "?callback=atlQbiFillDiv&targetDivId=" + popupData.targetDiv.id;
    }
    else {
      request = request + atl_qbi_querystring + "&callback=atlQbiFillDiv&targetDivId=" + popupData.targetDiv.id;
    }
	
	if ((popupData.quickBuyName != null) && (popupData.quickBuyName != '')) {
		request = request + "&quickBuyName=" + popupData.quickBuyName;
  }
  if ((popupData.itemTrackingCode != null) && (popupData.itemTrackingCode != '')) {
    request = request + "&ItemTrackingCode=" + popupData.itemTrackingCode;
  }
  if ((popupData.returnToMyr != null) && (popupData.returnToMyr != '')) {
    request = request + "&prog_id=" + popupData.returnToMyr;
  }
        
	atlQbiSendServerRequest(request);
}

function atlQbiFillDiv(qbiData) {
	if (qbiData != null) {
	    var index = atlQbiGetPopupDataIndex(qbiData.TargetDivId);
        if (index < 0) return;
        var popupData = atl_qbi_popupData[index];
    
	    var head = document.getElementsByTagName("head").item(0);
		if (qbiData.StyleSheet.length > 0)
		{
            var linkId = 'atlInsertStyles';
			var linkNode = atlQbiFindChildNode(head, linkId);	
			if (linkNode == null) {
				var csslink = document.createElement("link");
				csslink.setAttribute("id", linkId);
				csslink.setAttribute("type", "text/css");
				csslink.setAttribute("rel", "stylesheet");
				csslink.setAttribute("href", qbiData.StyleSheet);
				csslink.setAttribute("media", "screen");
				head.appendChild(csslink);
			}
		}
		
		if (qbiData.ScriptReference.length > 0) {
		    var scriptRefId = 'atlQbi_' + popupData.quickBuyName + "_" + "script";
		    var scriptNode = atlQbiFindChildNode(head, scriptRefId);	
			if (scriptNode == null) {
				var scriptRef = document.createElement("script");
				scriptRef.setAttribute("id", scriptRefId);
				scriptRef.setAttribute("type", "text/javascript");
				scriptRef.setAttribute("language", "javascript");
				scriptRef.setAttribute("src", qbiData.ScriptReference);
				head.appendChild(scriptRef);
			}
		}
		
        atlQbiShowInt(popupData.targetDiv);
		
		popupData.targetDiv.innerHTML = qbiData.Html;

		popupData.cacheFlag = true;

    if(typeof (atlQbiDomainSearchExpressBuy) != 'undefined'){
		  atlQbiDomainSearchExpressBuy._runSearchOnLoad();
		}

    if(typeof (atlQbiDomainSearchExpressBuyVideos1) != 'undefined'){
		  atlQbiDomainSearchExpressBuyVideos1.init();
		}

	}
}

function atlQbiClose(targetDivId) {
    atlQuickBuyBeforeClose();
    var targetDiv = document.getElementById(targetDivId);
	if (targetDiv != null) {
		if (atl_qbi_is_ie6under) {
			atlQbiShowElement('SELECT');
        }
        atlQbiSetVisibility(targetDivId, false);
    }
}

function atlQbiSendCommandToServer(targetDivId, commandName, params, callback, ciCode, event, element) {
    var index = atlQbiGetPopupDataIndex(targetDivId);
    if (index < 0) return;
    var popupData = atl_qbi_popupData[index];
    
    //log the click here if ciCode is available
    if (ciCode > 0 && event != null && element != null && (typeof FastballEvent_MouseClick == 'function')) {
        FastballEvent_MouseClick(event, ciCode, element, '', 'div');
    }
    
    var request = popupData.siteUrl + "QuickBuy/QuickBuyData.aspx";
    if (atl_qbi_querystring.length == 0) {
      request = request + "?callback=" + callback + "&targetDivId=" + popupData.targetDiv.id;
    }
    else {
      request = request + atl_qbi_querystring + "&callback=" + callback + "&targetDivId=" + popupData.targetDiv.id;
    }
	
	if ((popupData.quickBuyName != null) && (popupData.quickBuyName != '')) {
		request = request + "&quickBuyName=" + popupData.quickBuyName;
    }
    
    if ((popupData.itemTrackingCode != null) && (popupData.itemTrackingCode != '')) {
		request = request + "&itemTrackingCode=" + popupData.itemTrackingCode;
    }
    
    if (ciCode > 0) {
		request = request + "&ci=" + ciCode;
}

    if ((popupData.returnToMyr !=null) && (popupData.returnToMyr != '')) {
    request = request + "&returnToMyr=" + popupData.returnToMyr;
    }
    
    if ((commandName != null) && (commandName != '')) {
		request = request + "&commandName=" + commandName;
		
		if (params != null) {
            var strParams = params.join("|");
            if (strParams.length > 0) {
                request = request + "&params=" + escape(strParams);
            }
        }
    }
    
    //randomize the request so that browser makes the request everytime
    var randomNumber = Math.floor(Math.random()*999999999);
    request = request + "&rand=" + randomNumber;
    
    atlQbiSendServerRequest(request);
}

function atlQbiSendServerRequest(request) {
    var head = document.getElementsByTagName("head").item(0);
    var scriptId = 'atlQbiInsert'
	var existingNode = atlQbiFindChildNode(head, scriptId);	
	
	var script = document.createElement("script");
	script.setAttribute("id", scriptId);
	script.setAttribute("type", "text/javascript");
	script.setAttribute("language", "javascript");
	script.setAttribute("src", request);
	
	if (existingNode != null) {
	    head.replaceChild(script, existingNode);
	}
	else {
	    head.appendChild(script);
	}       
}

function atlQbiSetVisibility (elemId, show) {
    var elem = document.getElementById(elemId);
    if (elem) {
        if (show) 
            elem.style.display = "";
        else
            elem.style.display = "none";
    }
}

/* Operating System drop down list related functions - begins */
var atl_qbi_secSet = null;
var atl_qbi_bHover = '';

function atlQbi_qbj_mout(div) {
    atl_qbi_bHover='';
    window.status='';
    atlQbi_qbj_setDDTimeout(div);
}

function atlQbi_qbj_movr(div,status){
    if(atl_qbi_is_safari) {
        atl_qbi_bHover=status;
        window.status=status;
        atlQbi_qbj_setDD(div,status,false);
    }
    else {
        atl_qbi_bHover=status;
        window.status=status;
        setTimeout('atlQbi_qbj_setDD(\'' + div + '\', \'' + status + '\', false)',400);
    }
}

function atlQbi_qbj_setDD(sect, windowStatusVal, bshow) {	
    atlQbi_qbj_hideDDs(sect);
    if ((atl_qbi_bHover==windowStatusVal)||(bshow)) {
        atlQbi_qbjNav(sect,'','show');
        atlQbi_qbj_hv_g(sect+'x');
        if (atl_qbi_secSet != null) window.clearTimeout(atl_qbi_secSet);		
//        if	(document.getElementById(sect)) {
//            if(atl_qbi_is_ie6under) atlQbiHideElement('SELECT', document.getElementById(sect));
//        }
    }
}

function atlQbi_qbj_setDDTimeout(sect){
    if (atl_qbi_secSet != null) window.clearTimeout(atl_qbi_secSet);
    atl_qbi_secSet = window.setTimeout('atlQbi_qbj_hideDD("' + sect + '")',400);
}

function atlQbi_qbj_hideDDs(sect) {
    atlQbi_qbjNav('qb_os',sect,'hide','ov');
    atlQbi_qbj_inApp_hideDDs(sect);
//    atlQbiShowElement('SELECT');
//    atlQbiShowElement('OBJECT');
//    atlQbiShowElement('EMBED');
}

function atlQbi_qbj_inApp_hideDDs(sect){
    atlQbi_qbjNav('qb_dn',sect,'hide','ov');
    atlQbi_qbjNav('qb_ho',sect,'hide','ov');
    atlQbi_qbjNav('qb_ws',sect,'hide','ov');
    atlQbi_qbjNav('qb_em',sect,'hide','ov');
    atlQbi_qbjNav('qb_sc',sect,'hide','ov');
    atlQbi_qbjNav('qb_bs',sect,'hide','ov');
    atlQbi_qbjNav('qb_re',sect,'hide','ov');
}

function atlQbi_qbjNav() { 	
    var p, v, obj, args=atlQbi_qbjNav.arguments, i=0;
    if (!((args[i]==args[i+1])&&(args[i+2]=='hide')&&(args[i+3]=='ov')))
        if ((obj=atlQbi_qbj_findDiv(args[i]))!=null) { v=args[i+2];
	        if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
	        obj.visibility=v; if(v=='hidden'){atlQbi_qbj_of_g(args[i]+'x');}}    
}

function atlQbi_qbj_findDiv(n, d) { 
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=atlQbi_qbj_findDiv(n,d.layers[i].document);
    if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function atlQbi_qbj_hv_g(idval){
    if(idval=='qb_osx'){document.getElementById('qb_os_dd').className = 'qbb qb_ov_u';}
}
function atlQbi_qbj_of_g(idval){	
  if(idval=='qb_osx'){document.getElementById('qb_os_dd').className = 'qbb qb_ov_d';}
}

function atlQbi_qbj_hideDD(sect) {
    atlQbi_qbj_of_g(sect+'x'); atlQbi_qbjNav(sect,'','hide'); atlQbi_qbj_hideDDs('');
}

function atlQbi_osSubOn(div){
    document.getElementById(div).style.backgroundColor='#F0F0F0';
}

function atlQbi_osSubOff(div){
    document.getElementById(div).style.backgroundColor='#FFFFFF';
}

var atlQbi_selectedOSIds = new Array();
function atlQbi_osSubClick(targetDivId, os){
    var index = atlQbiGetSelectedOSIdIndex(targetDivId);
    if (index == -1) {
        atlQbi_selectedOSIds[atlQbi_selectedOSIds.length] = {"targetDivId": targetDivId, "selectedOSId": os};
    }
    else {
        atlQbi_selectedOSIds[index].selectedOSId = os;
    }
    
    var linux_div = document.getElementById('qb_' + targetDivId + '_osdiv_l');
    var windows_div = document.getElementById('qb_' + targetDivId + '_osdiv_w');
    if(linux_div && windows_div ) {
        if (os=="l"){
            windows_div.style.display='none';
            linux_div.style.display='';
        }
        else{
            linux_div.style.display='none';
            windows_div.style.display='';}
    }

    var linux_plans = document.getElementById('qb_' + targetDivId + '_plans_l');
    var windows_plans = document.getElementById('qb_' + targetDivId + '_plans_w');
    if(linux_plans && windows_plans ) {
        if (os=="l"){
            windows_plans.style.display='none';
            linux_plans.style.display='';
        }
        else{
            linux_plans.style.display='none';
            windows_plans.style.display='';}
    }

    var linux_features = document.getElementById('qb_' + targetDivId + '_features_l');
    var windows_features = document.getElementById('qb_' + targetDivId + '_features_w');
    if(linux_features && windows_features ) {
        if (os=="l"){
            windows_features.style.display='none';
            linux_features.style.display='';
        }
        else{
            linux_features.style.display='none';
            windows_features.style.display='';}
    }
    
    atlQbi_qbj_mout('qb_' + targetDivId + '_os');
}

function atlQbiGetSelectedOSIdIndex(targetDivId)
{
    var index = -1;
    for(var i = 0; i < atlQbi_selectedOSIds.length; i++)
    {
        if (atlQbi_selectedOSIds[i].targetDivId == targetDivId) {
            index = i;
            break;
        }
    }
    return index;
}
/* Operating System drop down list related functions - ends */

/* Product Radio button realted functions - begins */

var atlQbiSelectedProductIds = new Array();
function atlQbiProductRadioClicked(targetDivId, radioName, radioElem) {
    var index = atlQbiGetSelectedProductIdIndex(targetDivId, radioName);
    if (index == -1) {
        atlQbiSelectedProductIds[atlQbiSelectedProductIds.length] = {"targetDivId": targetDivId, "radioName": radioName, "selectedProductId": radioElem.value};
    }
    else {
        atlQbiSelectedProductIds[index].selectedProductId = radioElem.value;
    }
    radioElem.checked = true;
}

function atlQbiGetSelectedProductIdIndex(targetDivId, radioName)
{
    var index = -1;
    for(var i = 0; i < atlQbiSelectedProductIds.length; i++)
    {
        if (atlQbiSelectedProductIds[i].targetDivId == targetDivId && atlQbiSelectedProductIds[i].radioName == radioName) {
            index = i;
            break;
        }
    }
    return index;
}
/* Product Radio button realted functions - ends */
function atlQb_qhHideHelp(field) {
  var helpObj;
  if (document.all) {
    helpObj = document.all["atlQbQhi_" + field + "_Help"];
  }
  else if (document.getElementById) {
  helpObj = document.getElementById("atlQbQhi_" + field + "_Help");
  }
  if(helpObj) helpObj.style.display = "none";
  if (atl_qbi_is_ie6under) {
    atlQbiShowElement("select");
    atlQbiShowElement("object");
    atlQbiShowElement("embed");
  }
}
function atlQb_qhShowHelp(obj, field, TargetDivId, hide) {
  var helpObj;
  if (document.all) {
    helpObj = document.all["atlQbQhi_" + field + "_Help"];
  }
  else if (document.getElementById) {
    helpObj = document.getElementById("atlQbQhi_" + field + "_Help");
  }
  if (helpObj) {
    var divWidth = 340;
    var offsetLeft = atlQb_qhGetOffsetLeft(obj);
    var screenWidth = (window.innerWidth) ? window.innerWidth - 25 : document.body.clientWidth;
    if ((offsetLeft + divWidth) > screenWidth) offsetLeft = screenWidth - divWidth;
    newX = offsetLeft;
    var divHeight = helpObj.offsetHeight;
    var offsetTop = atlQb_qhGetOffsetTop(obj) + obj.offsetHeight;
    var screenHeight = (window.innerHeight) ? window.innerHeight - 25 : document.body.clientHeight;
    if ((offsetTop + divHeight) > screenHeight + atlQb_qhGetScrollY()) offsetTop = atlQb_qhGetOffsetTop(obj) - divHeight;
    newY = offsetTop;

    helpObj.style.top = newY.toString() + "px";
    helpObj.style.left = newX.toString() + "px";
    if (atl_qbi_is_ie6under) {
      atlQbiHideElement("select", helpObj);
      atlQbiHideElement("object", helpObj);
      atlQbiHideElement("embed", helpObj);
    }
    //get TargetDivId coords
    var TargetDiv = document.getElementById(TargetDivId);
    if (TargetDiv)
    {
      offsetLeft = atlQb_qhGetOffsetLeft(TargetDiv);
      newX -= offsetLeft;
      offsetTop = atlQb_qhGetOffsetTop(TargetDiv);
      newY -= offsetTop;
    }
    helpObj.style.top = newY.toString() + "px";
    helpObj.style.left = newX.toString() + "px";

    helpObj.style.display = "";
  }
}
function atlQb_qhGetOffsetTop(elm) {
  var mOffsetTop = elm.offsetTop;
  var mOffsetParent = elm.offsetParent;
  while (mOffsetParent) {
    mOffsetTop += mOffsetParent.offsetTop;
    mOffsetParent = mOffsetParent.offsetParent;
  }
  return mOffsetTop;
}
function atlQb_qhGetOffsetLeft(elm) {
  var mOffsetLeft = elm.offsetLeft;
  var mOffsetParent = elm.offsetParent;
  while (mOffsetParent) {
    mOffsetLeft += mOffsetParent.offsetLeft;
    mOffsetParent = mOffsetParent.offsetParent;
  }
  return mOffsetLeft;
}
function atlQb_qhGetScrollY() {
  var scrOfY = 0;
  if (typeof (window.pageYOffset) == 'number') {
    //Netscape
    scrOfY = window.pageYOffset;
  }
  else if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
    //DOM
    scrOfY = document.body.scrollTop;
  }
  else if (document.documentElement &&
      (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
    //IE6
    scrOfY = document.documentElement.scrollTop;
  }
  return scrOfY;
}