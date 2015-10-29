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

 -----------------------------------------------------------------------------------------
  DEUTSCHE SPRACHDATEI FÜR DAS PAGE_PERMISSION MODUL
 -----------------------------------------------------------------------------------------
**/

// sprachabhängige Modulbeschreibungen wurden mit WB 2.7 eingeführt (default English in info.php)
$module_description = 'Diese Modul erlaubt es, die Administratoren Gruppen f&uuml;r alle Seiten zu setzen.';

// Array für alle sprachabhängigen Textausgaben im Backend
$MOD_PAGE_PERMISSION = array(
'TXT_DESCRIPTION' => '<b>WARNUNG</b><br />
Mit diesem Modul setzen Sie die Gruppen-Berechtigung aller Seiten.<br />
Jede Seite muss mindestens von einer Admin-Gruppe bearbeitet werden k&ouml;nnen.<br />
Folgende Buttons stehen Ihnen pro Gruppe zur Verf&uuml;gung:<br />
<input type="button" value="++" onclick="" /> alle Seiten werden f&uuml;r diese Gruppe freigegeben.<br />
<input type="button" value="+/- toggle"  onclick="" /> freigegebene Seiten werden gesperrt, gesperrte Seiten werden freigegeben (togglen).<br />
<input type="button" value="--"  onclick="" /> alle Seiten werden f&uuml;r diese Gruppe gesperrt.<br /><br />
Zu jeder Seite ist der Link ins Frontend hinterlegt (neues Fenster), und mit einem Klick auf <img src="'.WB_URL.'/modules/page_permission/modify.png" alt="mod" border="0" width="16" height="16" /> gelangen Sie direkt zu den Seitenoptionen.<br /><br />
<b>VORSICHT</b><br />
Bitte gehen Sie umsichtig mit diesem Modul um und sperren Sie sich nicht selbst von der Seitenadministration aus.<br /><br />',
'TXT_SUBMIT' => 'Rechte &auml;ndern',
'TXT_RESET' => 'zur&uuml;cksetzen',
'TXT_TABLE_HEADER1' => 'Seiten',
'TXT_TABLE_HEADER2' => 'Administratoren Gruppen',
'TXT_TABLE_HEADER3' => 'Seitentitel',
'TXT_ERROR' => '<b>FEHLER</b> in der Rechtezuordnung zur PageID ',
'TXT_ERROR_HINT' => '.<br /><br /><b>FEHLER</b> in der Zuordnung der Rechte!<br />
Jede Seite muss von mindestens einer Gruppe bearbeitet werden k&ouml;nnen.<br />
<i>Ihre &Auml;nderungen wurden nur teilweise &uuml;bernommen.</i><br /><br />
Bitte &uuml;berarbeiten Sie Ihre Einstellungen.'
);
?>