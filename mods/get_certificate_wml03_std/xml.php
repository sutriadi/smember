<?php
/**
 *
 * Download Certificate (XML Word 2003) Module for SMember Plugin SLiMS
 * Standard Version
 *
 * Copyright (C) 1431 H / 2010 M - Indra Sutriadi Pipii (indra.sutriadi@gmail.com)
 *
 * @file: xml.php
 * @desc: xml full page
 *
 */

if ( ! defined('SENAYAN_BASE_DIR')) { exit(); }

?>
<?php
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>"
		."<?mso-application progid=\"Word.Document\"?>";
?>

<w:wordDocument xmlns:w="http://schemas.microsoft.com/office/word/2003/wordml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:sl="http://schemas.microsoft.com/schemaLibrary/2003/core" xmlns:aml="http://schemas.microsoft.com/aml/2001/core" xmlns:wx="http://schemas.microsoft.com/office/word/2003/auxHint" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882" w:macrosPresent="no" w:embeddedObjPresent="no" w:ocxPresent="no" xml:space="preserve">
    <o:DocumentProperties>
		<o:Title>Keterangan Bebas Pinjam Perpustakaan</o:Title>
		<o:Author>Download Letter for SMember Plugin</o:Author>
		<o:LastAuthor>Indra Sutriadi Pipii</o:LastAuthor>
		<o:Revision>3</o:Revision>
		<o:TotalTime>1</o:TotalTime>
		<o:Created>2010-05-19T21:21:00Z</o:Created>
		<o:LastSaved><?php echo date('Y-m-d');?>T<?php echo date('h:i:s');?>Z</o:LastSaved>
		<o:Pages><?php echo $num_pages;?></o:Pages>
		<o:Version>11.5604</o:Version>
    </o:DocumentProperties>
    <w:fonts>
		<w:defaultFonts w:ascii="Times New Roman" w:fareast="MS Mincho" w:h-ansi="Times New Roman" w:cs="Times New Roman"/>
		<w:font w:name="MS Mincho">
			<w:altName w:val="WenQuanYi Zen Hei"/>
			<w:panose-1 w:val="02020609040205080304"/>
			<w:charset w:val="80"/>
			<w:family w:val="Roman"/>
			<w:notTrueType/>
			<w:pitch w:val="fixed"/>
			<w:sig w:usb-0="00000001" w:usb-1="08070000" w:usb-2="00000010" w:usb-3="00000000" w:csb-0="00020000" w:csb-1="00000000"/>
		</w:font>
		<w:font w:name="@MS Mincho">
			<w:panose-1 w:val="00000000000000000000"/>
			<w:charset w:val="80"/>
			<w:family w:val="Roman"/>
			<w:notTrueType/>
			<w:pitch w:val="fixed"/>
			<w:sig w:usb-0="00000001" w:usb-1="08070000" w:usb-2="00000010" w:usb-3="00000000" w:csb-0="00020000" w:csb-1="00000000"/>
		</w:font>
    </w:fonts>
    <w:styles>
		<w:versionOfBuiltInStylenames w:val="4"/>
		<w:latentStyles w:defLockedState="off" w:latentStyleCount="156"/>
		<w:style w:type="paragraph" w:default="on" w:styleId="Normal">
			<w:name w:val="Normal"/>
			<w:rPr>
				<wx:font wx:val="Times New Roman"/>
				<w:sz w:val="24"/>
				<w:sz-cs w:val="24"/>
				<w:lang w:val="EN-US" w:fareast="JA" w:bidi="HE"/>
			</w:rPr>
		</w:style>
		<w:style w:type="character" w:default="on" w:styleId="DefaultParagraphFont">
			<w:name w:val="Default Paragraph Font"/>
			<w:semiHidden/>
		</w:style>
		<w:style w:type="table" w:default="on" w:styleId="TableNormal">
			<w:name w:val="Normal Table"/>
			<wx:uiName wx:val="Table Normal"/>
			<w:semiHidden/>
			<w:rPr><wx:font wx:val="Times New Roman"/></w:rPr>
			<w:tblPr>
				<w:tblInd w:w="0" w:type="dxa"/>
				<w:tblCellMar>
					<w:top w:w="0" w:type="dxa"/>
					<w:left w:w="108" w:type="dxa"/>
					<w:bottom w:w="0" w:type="dxa"/>
					<w:right w:w="108" w:type="dxa"/>
				</w:tblCellMar>
			</w:tblPr>
		</w:style>
		<w:style w:type="list" w:default="on" w:styleId="NoList">
			<w:name w:val="No List"/>
			<w:semiHidden/>
		</w:style>
		<w:style w:type="paragraph" w:styleId="Header">
			<w:name w:val="header"/>
			<wx:uiName wx:val="Header"/>
			<w:basedOn w:val="Normal"/>
			<w:rsid w:val="007A40E1"/>
			<w:pPr>
				<w:pStyle w:val="Header"/>
				<w:tabs>
					<w:tab w:val="center" w:pos="4320"/>
					<w:tab w:val="right" w:pos="8640"/>
				</w:tabs>
			</w:pPr>
			<w:rPr><wx:font wx:val="Times New Roman"/></w:rPr>
		</w:style>
		<w:style w:type="character" w:styleId="PageNumber">
			<w:name w:val="page number"/>
			<wx:uiName wx:val="Page Number"/>
			<w:basedOn w:val="DefaultParagraphFont"/>
			<w:rsid w:val="007A40E1"/>
		</w:style>
		<w:style w:type="paragraph" w:styleId="Footer">
			<w:name w:val="footer"/>
			<wx:uiName wx:val="Footer"/>
			<w:basedOn w:val="Normal"/>
			<w:rsid w:val="007A40E1"/>
			<w:pPr>
				<w:pStyle w:val="Footer"/>
				<w:tabs>
					<w:tab w:val="center" w:pos="4320"/>
					<w:tab w:val="right" w:pos="8640"/>
				</w:tabs>
				</w:pPr>
			<w:rPr><wx:font wx:val="Times New Roman"/></w:rPr>
		</w:style>
    </w:styles>
    <w:shapeDefaults>
		<o:shapedefaults v:ext="edit" spidmax="3074"/>
		<o:shapelayout v:ext="edit"><o:idmap v:ext="edit" data="1"/></o:shapelayout>
    </w:shapeDefaults>
    <w:docPr>
		<w:view w:val="print"/>
		<w:zoom w:percent="100"/>
		<w:doNotEmbedSystemFonts/>
		<w:attachedTemplate w:val=""/>
		<w:defaultTabStop w:val="720"/>
		<w:punctuationKerning/>
		<w:characterSpacingControl w:val="DontCompress"/>
		<w:optimizeForBrowser/>
		<w:validateAgainstSchema/>
		<w:saveInvalidXML w:val="off"/>
		<w:ignoreMixedContent w:val="off"/>
		<w:alwaysShowPlaceholderText w:val="off"/>
		<w:hdrShapeDefaults>
			<o:shapedefaults v:ext="edit" spidmax="3074"/>
			<o:shapelayout v:ext="edit"><o:idmap v:ext="edit" data="2"/></o:shapelayout>
		</w:hdrShapeDefaults>
		<w:footnotePr>
			<w:footnote w:type="separator">
				<w:p>
					<w:r><w:separator/></w:r>
				</w:p>
			</w:footnote>
			<w:footnote w:type="continuation-separator">
				<w:p>
					<w:r><w:continuationSeparator/></w:r>
				</w:p>
			</w:footnote>
		</w:footnotePr>
		<w:endnotePr>
			<w:endnote w:type="separator">
				<w:p>
					<w:r><w:separator/></w:r>
				</w:p>
			</w:endnote>
			<w:endnote w:type="continuation-separator">
				<w:p>
					<w:r><w:continuationSeparator/></w:r>
				</w:p>
			</w:endnote>
		</w:endnotePr>
		<w:compat>
			<w:breakWrappedTables/>
			<w:snapToGridInCell/>
			<w:applyBreakingRules/>
			<w:wrapTextWithPunct/>
			<w:useAsianBreakRules/>
			<w:dontGrowAutofit/>
			<w:useFELayout/>
		</w:compat>
	</w:docPr>
    <w:body>
		<wx:sect>
<?php
	$number = 1;
	$dxcontents = "<w:p/>";
	foreach($itemid as $index => $value)
	{
		$query = $dbs->query("SELECT $criteria FROM member, mst_member_type AS m_type WHERE member_id = '$value' AND m_type.member_type_id = member.member_type_id");
		$result = $query->fetch_assoc();
		$dxcontents .= dxcontent($confs, $result);
		if ($num_pages > 1 && $num_pages != $number)
			$dxcontents .= dxbreak('page');
		$number++;
	}
	$dxcontents .= dxsection($confs);
	echo $dxcontents;
?>
		</wx:sect>
    </w:body>
</w:wordDocument> 
