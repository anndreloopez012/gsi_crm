 <aside class="main-sidebar sidebar-dark-primary elevation-4 fondoColor">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
     <span class="brand-text font-weight-light">&nbsp;&nbsp;&nbsp;&nbsp;GSI 1.0</span>
   </a>

   <!-- Sidebar -->
   <div class="sidebar">

     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <?php
          if (is_array($arrModulo) && (count($arrModulo) > 0)) {
            reset($arrModulo);
            foreach ($arrModulo as $rTMP['key'] => $rTMP['value']) {
              if ($_SESSION[$rTMP["value"]['item']] == 1) {
          ?>

               <li class="nav-item">
                 <a href="gsi.0/<?php echo  $rTMP["value"]['url']; ?>" class="nav-link">
                   <?php echo  $rTMP["value"]['btn']; ?>
                   <p>
                     <?php echo  $rTMP["value"]['descrip']; ?>
                     <?php //echo $_SESSION[$rTMP["value"]['ITEM']] ; ?>
                     <?php //echo  $rTMP["value"]['ITEM']; ?>
                    
                   </p>
                 </a>
               </li>

         <?PHP
              }
            }
          }
          ?>

       </ul>
     </nav>

   </div>
 </aside>

 <style>

 </style>