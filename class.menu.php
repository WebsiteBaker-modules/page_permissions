<?php
/*
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

/*
  This class bases on the script I found on
  http://code.huypv.net/2010/10/how-to-build-unlimited-level-of-menu.html
  after an hint to use wblib. In wbLib, this script has also been used
  like documented in class.wbListBuilder.php.
*/

// prevent this file from being accessed directly
if(!defined('WB_PATH')) die(header('Location: index.php'));

class MenuBuilder
{
 // Menu items
 var $items = array();

 // Create MySQL connection
 function MenuBuilder()
 {
  //$this->conn = mysql_connect( 'localhost', 'user', 'pass' );
  //mysql_select_db( 'example', $this->conn );
 }

 // Perform MySQL query and return all results
 function fetch_assoc_all( $sql )
 {
  global $database, $page_index, $index_page;

  $result = $database->query($sql);
  if ( !$result ) return false;

  $assoc_all = array();

  while( $fetch = $result->fetchRow() ) $assoc_all[] = $fetch;
  //mysql_free_result( $result );
  return $assoc_all;
 }

 // Get all menu items from database
 function get_menu_items()
 {
  // Change the field names and the table name in the query below to match your needs
  $sql = 'SELECT * FROM `'.TABLE_PREFIX.'pages` ORDER BY parent, position;';
  return $this->fetch_assoc_all( $sql );
 }

// Build the menu
 function get_menu_html( $root_id = 0 )
 {
  $this->items = $this->get_menu_items();

  foreach ( $this->items as $item ) $children[$item['parent']][] = $item;

  // loop will be false if the root has no children (i.e., an empty menu!)
  $loop = !empty( $children[$root_id] );

  // initializing $parent as the root
  $parent = $root_id;
  $parent_stack = array();

   while ( $loop && ( ( $option = each( $children[$parent] ) ) || ( $parent > $root_id ) ) )
   {
    if ( $option === false )
    {
     $parent = array_pop( $parent_stack );
    }
    elseif ( !empty( $children[$option['value']['page_id']] ) )
    {
     $tab = str_repeat( "--", ( count( $parent_stack ) + 1 ) * 2 - 1 );

     echo '<tr>
           <td align="right">'.$option['value']['page_id'].'</td>
           <td><a href="'.WB_URL.PAGES_DIRECTORY.$option['value']['link'].'.php" target="_blank">
           '.$tab.$option['value']['page_title'].' ('.$option['value']['page_id'].')'.'</a> <a href="'.WB_URL.'/admin/pages/settings.php?page_id='.$option['value']['page_id'].'"><img src="'.WB_URL.'/modules/page_permission/modify.png" alt="mod" border="0" width="16" height="16" /></td>'.
           $this->group_check($option['value']['page_id']).
           '
           </tr>
           ';

           array_push( $parent_stack, $option['value']['parent'] );
           $parent = $option['value']['page_id'];
    }
    else
     echo '<tr>
           <td align="right">'.$option['value']['page_id'].'</td>
           <td><a href="'.WB_URL.PAGES_DIRECTORY.$option['value']['link'].'.php" target="_blank">
           '.str_repeat( "--", ( count( $parent_stack ) + 1 ) * 2 - 1 ).$option['value']['page_title'].' ('.$option['value']['page_id'].')'.'</a> <a href="'.WB_URL.'/admin/pages/settings.php?page_id='.$option['value']['page_id'].'"><img src="'.WB_URL.'/modules/page_permission/modify.png" alt="mod" border="0" width="16" height="16" /></td>'.
           $this->group_check($option['value']['page_id']).
           '
           </tr>
           ';
   }

   echo '
   ';

   return; //implode( "\r\n", $this->html );
 }

 function group_check($PID)
 {
  global $database, $matrix, $page_index;

  $txt='';

  $sql = 'SELECT * FROM `'.TABLE_PREFIX.'pages` WHERE `page_id` = '.$PID;
  $results = $database->query($sql);
  $results_array = $results->fetchRow();
  $admin_groups = $results_array['admin_groups'];
  $oag = explode(',', $results_array['admin_groups']);
  $anz_oag = count($oag);

  $sql = 'SELECT * FROM `'.TABLE_PREFIX.'groups`';
  $resultg = $database->query($sql);
  $resultg_array = $resultg->fetchRow();
  $num_rowg = $resultg->numRows();

  // Check Matrix
  for ($g = 0;$g < $num_rowg; $g++)
  {
   // Einlesen der Gruppen ?
   $group_id = $resultg_array['group_id'];

   // Feststellen des Indexes der Seite
   $iPID = $page_index[$PID];

   // Erstellen des Formulars
   if ( isset($matrix[$PID][$group_id]) )
   {
    $txt.='<td align="center"><input type="checkbox" name="n'.$iPID.$g.'" value="'.$iPID.'x'.$group_id.'" checked="checked" /></td>
    ';
   }
   else
   {
    $txt.='<td align="center"><input type="checkbox" name="n'.$iPID.$g.'" value="'.$iPID.'x'.$group_id.'" /></td>
    ';
   };
   // Lesen naechster Satz Gruppen
   $resultg_array = $resultg->fetchRow();
  }
 return $txt;
 }
}
?>