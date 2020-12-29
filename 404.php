<?
include './system/common.php';
    
 include './system/functions.php';
        
      include './system/user.php';

  include './system/h.php';  
?>
<div class="block">Запрос <?=htmlspecialchars($_SERVER['REQUEST_URI']);?> не может быть обработан на сервере!</div>
<?
include './system/f.php';  
?>