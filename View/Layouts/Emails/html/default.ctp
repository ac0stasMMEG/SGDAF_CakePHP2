<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts.Email.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
	<title><?php echo $this->fetch('title'); ?></title>
</head>
<body>
	<?php echo $this->fetch('content'); ?>

	<?php echo $this->Html->image("footer_email.png", ['fullBase' => true]); ?><br>
    <?php echo 'Para ver el proceso, inicie '.$this->Html->link('sesión', array('controller' => 'users', 'action' => 'login', 'full_base' => true)).' en el sistema SGDAF.'; ?><br>
    <?php echo 'ESTA NOTIFICACIÓN HA SIDO ENVIADA AUTOMÁTICAMENTE. POR LO TANTO, NO ES POSIBLE RESPONDER A ESTE CORREO ELECTRÓNICO.'; ?>
    
</body>
</html>