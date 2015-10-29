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
  ENGLISH LANGUAGE FILE FOR PAGE_PERMISSION MODUL
 -----------------------------------------------------------------------------------------
**/

$module_description = 'This module allows you to change the admin group setting of multiple pages at once.';

$MOD_PAGE_PERMISSION = array(
'TXT_DESCRIPTION' => '<b>WARNING</b><br />
Using this module will allow you to set the admin groups for all pages.<br />
Each page requires at least one admin group.<br />
Per group, you have the following buttons:<br />
<input type="button" value="++" onclick="" /> all pages can be administered for this group.<br />
<input type="button" value="+/- toggle"  onclick="" /> allowed pages are blocked, blocked pages become allowed (toggle the setting).<br />
<input type="button" value="--"  onclick="" /> all pages are blocked for this group.<br /><br />
Each page is linked to the frontend in a new window, and a click on <img src="'.WB_URL.'/modules/page_permission/modify.png" alt="mod" border="0" width="16" height="16" /> will show you the page options.<br /><br />
<b>ATTENTION</b><br />
Use this module with care, and do not limit your own right as superadmin to edit all pages.<br /><br />',
'TXT_SUBMIT' => 'Change Permissions',
'TXT_RESET' => 'Reset',
'TXT_TABLE_HEADER1' => 'Pages',
'TXT_TABLE_HEADER2' => 'Administrator Groups',
'TXT_TABLE_HEADER3' => 'Pagetitle',
'TXT_ERROR' => '<b>ERROR</b> for page PageID ',
'TXT_ERROR_HINT' => '.<br /><br /><b>ERROR</b> in setting permission rights!<br />
Each page needs at least ONE administrator group.<br />
<i>Only some changes were put into the database.</i><br /><br />
Please rework your setting.'
);
?>