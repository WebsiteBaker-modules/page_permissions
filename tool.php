<?php
/**
  Module developed for the Open Source Content Management System Website Baker (http://websitebaker.org)
  Copyright (C) 2012, Andreas Schmidt
  Contact me: webmaster(at)hillschmidt.de, http://www.hillschmidt.de

  This module is free software. You can redistribute it and/or modify it
  under the terms of the GNU General Public License  - version 2 or later,
  as published by the Free Software Foundation: http://www.gnu.org/licenses/gpl.html.

  This module is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
**/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));

// include core functions of WB 2.7 to edit the optional module CSS files (frontend.css, backend.css)
@include_once(WB_PATH.'/framework/module.functions.php');

// Include the WB functions file
//require_once(WB_PATH.'/framework/functions.php');
//require_once(WB_PATH.'/framework/functions-utf8.php');

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(dirname(__FILE__) .'/languages/' .LANGUAGE .'.php')) {
// no module language file exists for the language set by the user, include default module language file EN.php
        require_once(dirname(__FILE__) .'/languages/EN.php');
} else {
// a module language file exists for the language defined by the user, load it
        require_once(dirname(__FILE__) .'/languages/' .LANGUAGE .'.php');
}

// Feststellen der Anzahl der Seiten
$sql = 'SELECT * FROM `'.TABLE_PREFIX.'pages` ORDER BY `page_id`';
$results = $database->query($sql);
$results_array = $results->fetchRow();
$num_rows = $results->numRows();

// Feststellen der Anzahl der Gruppen
$sql = 'SELECT * FROM `'.TABLE_PREFIX.'groups`';
$resultg = $database->query($sql);
$resultg_array = $resultg->fetchRow();
$num_rowg = $resultg->numRows();

// Ausgabe Header
echo '<div>'.$MOD_PAGE_PERMISSION['TXT_DESCRIPTION'].'</div>
      <script src="'.WB_URL.'/modules/page_permission/tool.js" type="text/javascript"></script>
      <form name="settings" action="'.WB_URL.'/modules/page_permission/tool2.php" method="get">
      <table cellpadding="2" cellspacing="0" border="0" align="left" summary="Permissions">
      <tr style="background:#EBF6DF;" >
      <th colspan="2">'.$MOD_PAGE_PERMISSION['TXT_TABLE_HEADER1'].'</th>
      <th colspan="5">'.$MOD_PAGE_PERMISSION['TXT_TABLE_HEADER2'].'</th>
      </tr>
      <tr style="background:#F3F3F3;"><th>PageID</th><th>'.$MOD_PAGE_PERMISSION['TXT_TABLE_HEADER3'].'</th>
      ';

// Gruppenkopf mit Gruppenname
for ($i = 0; $i < $num_rowg; $i++)
{
 echo '<th align="center">'.$resultg_array['name'].' ('.$resultg_array['group_id'].')<br />
       <input type="button" onclick="all_on('.$num_rows.','.$i.');return true;" value="++" />
       <input type="button" onclick="toggle('.$num_rows.','.$i.');return true;" value="+/- toggle" />
       <input type="button" onclick="all_off('.$num_rows.','.$i.');return true;" value="--" /></th>
 ';

 // Lesen naechster Satz
 $resultg_array = $resultg->fetchRow();
}
echo '</tr>
';

// Seitenauswertung für Gruppen pro Seite und Setzen der Seiten-Arrays
for ($i = 0; $i < $num_rows; $i++)
{
 $page_id = $results_array['page_id'];
 $admin_groups = $results_array['admin_groups'];
 $oag = explode(',', $results_array['admin_groups']); //old admin groups
 $anz_oag = count($oag);

 for ($j = 0; $j < $anz_oag; $j++)
 {
  // Setzen des Ergebnisvektors
  $matrix[$page_id][$oag[$j]] = 1;
 }
 // Setzen der Seiten-Zuordnungsarrays für Nummerierung und reverse
 $page_index[$page_id]=$i;
 $index_page[$i]=$page_id;

 // Lesen naechster Satz Seiten
 $results_array = $results->fetchRow();
}

// Einlesen und Darstellen des Menus
include('class.menu.php');
$menu = new MenuBuilder();
$menu->get_menu_html();

echo '<tr><td colspan="3">
<input type="submit" onmouseover="checkForm('.$num_rows.','.$num_rowg.',\''.LANGUAGE.'\');" name="submit" value="'.$MOD_PAGE_PERMISSION['TXT_SUBMIT'].'" />
<input type="reset" name="reset" value="'.$MOD_PAGE_PERMISSION['TXT_RESET'].'" /></td>
</tr>
</table>';

//Uebergabe Anzahl Seiten, Anzahl Gruppen
echo '<input type="hidden" name="pages" value="'.$num_rows.'" />
<input type="hidden" name="groups" value="'.$num_rowg.'" />
</form>
';

?>