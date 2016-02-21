<h1><?php if($message) { echo $message; } ?></h1>
<?php if(!$message) { $this->renderPartial('_messages', array('messages'=>$messages)); }?>

