// Copyright (c) 2011 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.
var me = "nberard";
var envs = ["devng","dev","preprod","recette","prod"];
var idxCurrent = 1;
var current = envs[idxCurrent];
var reg = /https?:\/\/(.*(meetic|match|lexa|msn|yahoo|spiegel|dating|direct|skynet|neu\.de|orange|terra)\.[^\.\/]*)((\.dev|\.preprod|\.recette)?)\/.*/ig ;
var site = "";

function checkForValidUrl(url) {
	console.debug('checkForValidUrl with '+url+' returns '+(url.match(reg) != null));
	var matches = reg.exec(url);
	console.dir(matches);
	if(matches != null)
		site = matches[1];
	return (url.match(reg) != null);
}

function updateUrl(tab) {
console.debug('updateUrl current = '+current+' car idxCurrent = '+idxCurrent);
	var avant = current;
	var url = tab.url;
	console.debug("avant : "+avant);
	console.debug("url avant : "+url);
	switch(avant) {
		case "devng": 
			url = url.replace(me+".", "");
		break;
		case "dev": 
			url = url.replace("dev", "preprod");
		break;
		case "preprod": 
			url = url.replace("preprod", "recette");
		break;
		case "recette": 
			url = url.replace(".recette", "");
		break;
		case "prod": 
			url = url.replace(site, me+"."+site+".dev");
		break;
	}
	idxCurrent = (idxCurrent + 1) %5;
	current = envs[idxCurrent];
	chrome.tabs.update(tab.id, {url: url});
	console.debug("current apres : "+current);
	console.debug("url apres : "+url);
	console.debug('fin updateUrl current = '+current+' car idxCurrent = '+idxCurrent);
	
}
function updateIcon(tab) {
console.debug('updateIcon current = '+current+' car idxCurrent = '+idxCurrent);
	if(checkForValidUrl(tab.url)) {
		if(tab.url.indexOf(".dev") != -1) {
			if(tab.url.indexOf(me) != -1) {
				idxCurrent = 0;
			}
			else idxCurrent = 1;
		}
		else if(tab.url.indexOf(".preprod") != -1) {
			idxCurrent = 2;
		}
		else if(tab.url.indexOf(".recette") != -1) {
			idxCurrent = 3;
		}
		else {
			idxCurrent = 4;
		}
		current = envs[idxCurrent];
		console.debug("current = "+current);
		chrome.browserAction.setIcon({path:"icon_" + current + ".png"});
		console.debug('fin updateIcon current = '+current+' car idxCurrent = '+idxCurrent);
	}
	else chrome.browserAction.setIcon({path:"icon_not.png"});
}
chrome.browserAction.onClicked.addListener(function(tab) {if(checkForValidUrl(tab.url)) updateUrl(tab);});
chrome.tabs.onActivated.addListener(function(activeInfo) { chrome.tabs.get(activeInfo.tabId, function(tab) {updateIcon(tab);});});
chrome.tabs.onUpdated.addListener(function(tabId, changeInfo, tab){updateIcon(tab);});
