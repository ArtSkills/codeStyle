<?php
file_put_contents('composer-setup.php', file_get_contents('https://getcomposer.org/installer'));
if (hash('SHA384', file_get_contents('composer-setup.php')) === 'fd26ce67e3b237fffd5e5544b45b0d92c41a4afe3e3f778e942e43ce6be197b9cdc7c251dcde6e2a52297ea269370680') {
	echo 'Installer verified';
} else {
	echo 'Installer corrupt';
	unlink('composer-setup.php');
}
exec('php composer-setup.php');
unlink('composer-setup.php');
exec('php composer.phar install');