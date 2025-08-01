<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Memos Digitales');
?>
<?php echo $this->Html->docType('html5'); ?> 
<html>
	<head>
		<?php echo $this->Html->charset(); ?>

		<title>
			<?php echo $cakeDescription ?>
			<?php //echo $title_for_layout; ?>
		</title>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-159573556-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-159573556-1');
        </script>

		<?php 
			echo $this->Html->meta('icon');
			echo $this->Html->meta(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no']);
			echo $this->fetch('meta');

            echo $this->Html->script('plugins/jQuery/jQuery-2.1.4.min.js');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('plugins/slimScroll/jquery.slimscroll.min.js');
            echo $this->Html->script('plugins/fastclick/fastclick.js');
            echo $this->Html->script('../dist/js/app.min.js');
            echo $this->Html->script('../dist/js/demo.js');
			//echo $this->Html->script('jquery.min');
			//echo $this->Html->script('CakeAdminLTE/app');
			//echo $this->Html->script('../js/plugins/iCheck/icheck.min');
		?>
        <?php         
            echo $this->Html->css('bootstrap.min.css');
			echo $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
			echo $this->Html->css('ionicons.min.css');
			echo $this->Html->css('//fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic,400italic');
			echo $this->Html->css('../dist/css/AdminLTE.min.css');
            //echo $this->Html->css('CakeAdminLTE.css');
            echo $this->Html->css('skins/_all-skins.min.css');
			echo $this->fetch('css');
			//echo $this->Html->script('libs/jquery-1.10.2.min');
			//echo $this->Html->script('libs/bootstrap.min');
            //echo $this->Html->css('../js/plugins/iCheck/all');
        
			echo $this->fetch('script');
        ?>
	</head>

	<body>

			<?php echo $this->element('menu/top_left_sidebar'); ?>
        
	</body>

</html>