<?php
file_put_contents('composer-setup.php', file_get_contents('https://getcomposer.org/installer'));
if (hash('SHA384', file_get_contents('composer-setup.php')) === '7228c001f88bee97506740ef0888240bd8a760b046ee16db8f4095c0d8d525f2367663f22a46b48d072c816e7fe19959') {
	echo 'Installer verified';
} else {
	echo 'Installer corrupt';
	unlink('composer-setup.php');
}
exec('php composer-setup.php');
unlink('composer-setup.php');
exec('php composer.phar install');