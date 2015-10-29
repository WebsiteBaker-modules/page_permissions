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

// Create new admin object and print admin header
require('../../config.php');
require_once(WB_PATH.'/framework/class.admin.php');
$admin = new admin('Pages', 'pages_settings');

// Include the WB functions file
require_once(WB_PATH.'/framework/functions.php');

// include core functions of WB 2.7 to edit the optional module CSS files (frontend.css, backend.css)
@include_once(WB_PATH .'/framework/module.functions.php');

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(dirname(__FILE__) .'/languages/' .LANGUAGE .'.php')) {
// no module language file exists for the language set by the user, include default module language file EN.php
        require_once(dirname(__FILE__) .'/languages/EN.php');
} else {
// a module language file exists for the language defined by the user, load it
        require_once(dirname(__FILE__) .'/languages/' .LANGUAGE .'.php');
}

// Alles in $_GET n00=1x1&n01=1x2&n10=5x1&n11=5x2&n20=3x1&n21=3x2& ...
$num_rows=$_GET['pages'];
$num_rowg=$_GET['groups'];

echo '<u>Database Action Log</u><br />';

/* Seiten-Saetze nochmals lesen und mit page_id arbeiten */
$sql = 'SELECT * FROM `'.TABLE_PREFIX.'pages` ORDER BY `page_id`';
$results = $database->query($sql);
$results_array = $results->fetchRow();
//$num_rows = $results->numRows();
for ($i = 0; $i < $num_rows; $i++)
{
 $page_id = $results_array['page_id'];
 // Setzen der Seiten-Zuordnungsarrays für Nummerierung und reverse
 $page_index[$page_id]=$i;
 $index_page[$i]=$page_id;

 // Lesen naechster Satz Seiten
 $results_array = $results->fetchRow();
}

// Splitten page_id, group_id
for ($p=0;$p<$num_rows;$p++)
{
 $new_group='';
 $count=0;
 for ($g=0;$g<$num_rowg;$g++)
 {
  $a='n'.$p.$g;
  if ( isset($_GET[$a]) )
  {
   $count=$count+1;
   $b=explode('x',$_GET[$a]);
   $page_id=$index_page[$b[0]];
   $group_id=$b[1];
   if ( $count == 1 ) $new_group=$group_id; else $new_group=$new_group.','.$group_id;
  }
 }
 if ( $count == 0 )
 {
  $err_page_id=$index_page[$p];
  //$pagetree_url = ADMIN_URL.'/pages/index.php';
  $target_url = ADMIN_URL.'/admintools/tool.php?tool=page_permission';
  //$admin->print_error($MESSAGE['PAGES']['SAVED_SETTINGS'], $target_url );
  $admin->print_error($MOD_PAGE_PERMISSION['TXT_ERROR'].$err_page_id.$MOD_PAGE_PERMISSION['TXT_ERROR_HINT'], $target_url);
 }
 else
 {
  //Zurueckschreiben
  echo 'UPDATE `'.TABLE_PREFIX.'pages` SET `admin_groups` = "'.$new_group.'" WHERE `page_id` = '.$page_id.'<br />';
  $sql = 'UPDATE `'.TABLE_PREFIX.'pages` SET `admin_groups` = "'.$new_group.'" WHERE `page_id` = '.$page_id;
  $database->query($sql);
 }
}

$pagetree_url = ADMIN_URL.'/pages/index.php';
$target_url = ADMIN_URL.'/admintools/tool.php?tool=page_permission';
// Check if there is a db error, otherwise say successful
if($database->is_error())
{
        $admin->print_error($database->get_error(), $target_url );
} else {
        $admin->print_success($MESSAGE['PAGES']['SAVED_SETTINGS'], $target_url );
}
// Print admin footer
$admin->print_footer();

?>