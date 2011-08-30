//      data.js
//      
//      Copyright 2011 Indra Sutriadi Pipii <indra.sutriadi@gmail.com>
//      
//      This program is free software; you can redistribute it and/or modify
//      it under the terms of the GNU General Public License as published by
//      the Free Software Foundation; either version 2 of the License, or
//      (at your option) any later version.
//      
//      This program is distributed in the hope that it will be useful,
//      but WITHOUT ANY WARRANTY; without even the implied warranty of
//      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//      GNU General Public License for more details.
//      
//      You should have received a copy of the GNU General Public License
//      along with this program; if not, write to the Free Software
//      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//      MA 02110-1301, USA.

	/*** jQuery dataTables ***/

	var asInitVals = new Array();
	var oTable;
	var oCache = { iCacheLower: -1 };

	function fnSetKey( aoData, sKey, mValue )
	{
		for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
		{
			if ( aoData[i].name == sKey )
			{
				aoData[i].value = mValue
			}
		}
	}

	function fnGetKey( aoData, sKey )
	{
		for ( var i=0, iLen=aoData.length ; i<iLen ; i++ )
		{
			if ( aoData[i].name == sKey )
			{
				return aoData[i].value
			}
		}
		return null;
	}

	function fnDataTablesPipeline ( sSource, aoData, fnCallback ) {
		$.ajax( {
			"dataType": 'json', 
			"type": "POST", 
			"url": sSource, 
			"data": aoData, 
			"success": fnCallback
		} );
		var iPipe = 5; /* Ajust the pipe size */
		
		var bNeedServer = false;
		var sEcho = fnGetKey(aoData, "sEcho");
		var iRequestStart = fnGetKey(aoData, "iDisplayStart");
		var iRequestLength = fnGetKey(aoData, "iDisplayLength");
		var iRequestEnd = iRequestStart + iRequestLength;
		oCache.iDisplayStart = iRequestStart;
		
		/* outside pipeline? */
		if ( oCache.iCacheLower < 0 || iRequestStart < oCache.iCacheLower || iRequestEnd > oCache.iCacheUpper )
		{
			bNeedServer = true;
		}
		
		/* sorting etc changed? */
		if ( oCache.lastRequest && !bNeedServer )
		{
			for( var i=0, iLen=aoData.length ; i<iLen ; i++ )
			{
				if ( aoData[i].name != "iDisplayStart" && aoData[i].name != "iDisplayLength" && aoData[i].name != "sEcho" )
				{
					if ( aoData[i].value != oCache.lastRequest[i].value )
					{
						bNeedServer = true;
						break;
					}
				}
			}
		}
		
		/* Store the request for checking next time around */
		oCache.lastRequest = aoData.slice();
		
		if ( bNeedServer )
		{
			if ( iRequestStart < oCache.iCacheLower )
			{
				iRequestStart = iRequestStart - (iRequestLength*(iPipe-1));
				if ( iRequestStart < 0 )
				{
					iRequestStart = 0;
				}
			}
			
			oCache.iCacheLower = iRequestStart;
			oCache.iCacheUpper = iRequestStart + (iRequestLength * iPipe);
			oCache.iDisplayLength = fnGetKey( aoData, "iDisplayLength" );
			fnSetKey( aoData, "iDisplayStart", iRequestStart );
			fnSetKey( aoData, "iDisplayLength", iRequestLength*iPipe );
			
			$.getJSON( sSource, aoData, function (json) { 
				/* Callback processing */
				oCache.lastJson = jQuery.extend(true, {}, json);
				
				if ( oCache.iCacheLower != oCache.iDisplayStart )
				{
					json.aaData.splice( 0, oCache.iDisplayStart-oCache.iCacheLower );
				}
				json.aaData.splice( oCache.iDisplayLength, json.aaData.length );
				
				fnCallback(json)
			} );
		}
		else
		{
			json = jQuery.extend(true, {}, oCache.lastJson);
			json.sEcho = sEcho; /* Update the echo for each response */
			json.aaData.splice( 0, iRequestStart-oCache.iCacheLower );
			json.aaData.splice( iRequestLength, json.aaData.length );
			fnCallback(json);
			return;
		}
	}

	$(document).ready(function() {
		$('#formulir').submit( function() {
			var df=document.formulir.dofirst
			if (df.selectedIndex!=0) {
				$("#validateTips").text("Yakin akan melakukan "+df.options[df.selectedIndex].text).effect("highlight", {}, 1500);
				$('#dialog').dialog("option", "buttons", {
					OK: function() {
						var sData = $('input', oTable.fnGetNodes()).serialize();
						document.formulir.submit();
						document.formulir.dofirst.selectedIndex=0;
						chform('', '');
						$(this).dialog('close');
					},
					Cancel: function() {
						$(this).dialog('close');
					},
				}),
				$('#dialog').dialog('open');
			}
			return false;
		} );
		$("#card_conf_accordion, #cert_conf_accordion").accordion({
			autoHeight: false,
			collapsible: true,
			header: "h3"
		});
		var dialog_conf = {
			bgiframe: true,
			autoOpen: false,
			modal: true,
		}
		var card_conf = {
			height: "400",
			width: "600",
			buttons: {
				"Save": function() {
					$.post(
						"./php/setup.php?conf=card",
						$('form[name="card_conf_form"]').serializeArray(),
						function(data){
							if(data.track=="sukses")
								$("#validateTips").text("Data sudah disimpan!").effect("highlight", {}, 1500);
							else
								$("#validateTips").text("Data gagal disimpan!").effect("highlight", {}, 1500);
							$('#dialog').dialog("option", "buttons", {"OK": function() { $(this).dialog("close"); } } );
							$('#dialog').dialog('open');
						},
						"json"
					);
					$(this).dialog('close');
				},
				Cancel: function() {
					$(this).dialog('close');
				}
			},
		}
		$.extend(true, card_conf, dialog_conf);
		$("#card_conf").dialog(eval(card_conf));
		$("#dialog").dialog(eval(dialog_conf));

		$('#tutup').click(function() { window.close() });
		$('#reload').click(function() { window.location.reload() });
		
		$('button').button();
		$('#to-conf-card').button().click(function() {
			$('#card_conf').dialog("open");
		});

		var jsDef = {
			"bProcessing": true,
			"bServerSide": true,
			"bAutoWidth": false,
			"bJQueryUI": true,
			"bFilter": true,
			"aLengthMenu": [[5, 10, 20, 30, 40, 50], [5, 10, 20, 30, 40, 50]],
			"sPaginationType": "full_numbers",
			"sAjaxSource": "../../library/dataTables/php/processing.php?plugin=smember&table=smember",
			"fnServerData": fnDataTablesPipeline,
			"sScrollY": "200px",
			"oLanguage": {
				"sSearch": "Search all:"
			}
		};
		
		$.extend(true, jsDef, phpDef);

		oTable=$('#members').dataTable( jsDef );

		$("tfoot input").keyup( function () {
			/* Filter on the column (the index) of this element */
			oTable.fnFilter( this.value, $("tfoot input").index(this) );
		} );
		
		/*
		 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
		 * the footer
		 */
		$("tfoot input").each( function (i) {
			asInitVals[i] = this.value;
		} );
		
		$("tfoot input").focus( function () {
			if ( this.className == "search_init" )
			{
				this.className = "";
				this.value = "";
			}
		} );
		
		$("tfoot input").blur( function (i) {
			if ( this.value == "" )
			{
				this.className = "search_init";
				this.value = asInitVals[$("tfoot input").index(this)];
			}
		} );

		/* untuk ngetes doang */
		//~ $("#ngetes").click( function() {
			//~ $.get("../../library/dataTables/php/processing.php?plugin=smember&table=smember", {},
			   //~ function(data){
				 //~ alert(data);
			   //~ }, "html"
			//~ );
		//~ });

	} );

	/*** some addition function ***/
	
	function chform(target, action)
	{
		var f=document.formulir
		f.target=target
		f.action=action
	}

	function allcheck(t)
	{
		f=t.form
		cb=f.elements['members[]']
		for(n=0;n<cb.length;n++)
			cb[n].checked=true
	}
	
	function alluncheck(t)
	{
		f=t.form
		cb=f.elements['members[]']
		for(n=0;n<cb.length;n++)
			cb[n].checked=false
	}
	
	function invertcheck(t)
	{
		f=t.form
		cb=f.elements['members[]']
		for(n=0;n<cb.length;n++)
			cb[n].checked=cb[n].checked==true?false:true
	}
	
	function chtheme(t)
	{
		s=t.selectedIndex
		if(s!=0)
			alert('No theme!')
	}
