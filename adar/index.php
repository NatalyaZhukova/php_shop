<?php 
if (empty($_REQUEST['g']) && empty($_REQUEST['l'])) { $g=0;
    $l=0;}
    else{ 
   $g=$_REQUEST['g']; $l=$_REQUEST['l'];}
   include_once 'menu.php';
?>
<html>
    <head></head>
    <body>
        <table style ="background-color: lightcyan;" border="1" width="100%" height="1000">
            <tr align="center" height="50">
                <td width="300"><a href="index.php?g=0&AMP;l=0">База данных</a></td>    
                <td >Дизайн</td>
                <td >Маркетинг</td>
                            </tr> 
             <tr valign="top">
                 <td id="links">
                     <ul>
                <?php 
                for ($i=0;$i<count($menu[$g]); $i++){
                echo '<li><a href="index.php?g=',$g,'&amp;l=',$i,'">',$menu[$g][$i];      }
                 ?>
                     </ul>      
                 </td>
                 <td colspan="2" id="content">
                     <?php 
                     $temp = $menu[$g][$l].".php";
                     include $temp;
                
                                          ?>
                 </td>
             </tr>
           
        </table>    
  </body>
    
    
</html>

