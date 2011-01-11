/*
 *
 * Member Card Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: card.js
 * @desc: member card javascript
 *
 */

var fileadded=''

function reload(css,dir)
{
	//~ alert(dir)
	if(fileadded.length!=0)
		remove()
	if(fileadded!=css){
		var filename=dir+css+"/main.css"
		var fileref=document.createElement("link")
		fileref.setAttribute("rel", "stylesheet")
		fileref.setAttribute("type", "text/css")
		fileref.setAttribute("href", filename)
		document.getElementsByTagName("head")[0].appendChild(fileref)
		fileadded=css
		dir=dir
	}
}

function remove()
{
	var filename=fileadded
	var targetattr='href'
	var allsuspects=document.getElementsByTagName('link')
	for(var i=allsuspects.length;i>=0;i--){
		if(allsuspects[i]&&allsuspects[i].getAttribute(targetattr)!=null&&allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1)
			allsuspects[i].parentNode.removeChild(allsuspects[i])
	}
}

function checkside(t)
{
	if(t.checked==true)
		showside()
	else
		hideside()
}

function crtside(indeed)
{
	var side=document.createElement("div")
	side.className='bg_second'
	side.innerHTML=indeed
	return side
}

function showside()
{
	var backin=document.getElementById('backside').childNodes[0].innerHTML
	var divtag=document.getElementsByTagName('div')
	for(i=0;i<divtag.length;i++)
	{
		if(divtag[i].className=='bg_first')
			divtag[i].parentNode.insertBefore(crtside(backin), divtag[i].nextSibling)
	}
}

function hideside()
{
	var divtag=document.getElementsByTagName('div')
	for(i=0;i<divtag.length;i++)
	{
		if(divtag[i].className=='bg_second'&&divtag[i].parentNode.getAttribute('id')!='backside')
			divtag[i].parentNode.removeChild(divtag[i])
	}
}