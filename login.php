<?php 
require 'db.php';

$data = $_POST;
$errors = array();
if (isset($data['do-login'])){
	$user = R::findOne('users', 'login = ?', array($data['login']));
	if ($user) {
		if (password_verify($data['password'], $user->password)) {
			$_SESSION['logged-user'] = $user;
			echo '<div style="color:green";>Вы успешно авторизировались! <br>Можете перейти на <a href="/">главную</a> страницу!</div><hr>';
		} else {
		$errors[]= "Пароль введен не верно!";
	} 
	}else {
		$errors[]= "Пользователь с таким логином или паролем не найден!!!";
	}
	if (!empty($errors)) {
		echo '<div style="color:red;">'. $errors[0].'</div><hr>';
	}
}
?>
 <form action="login.php" method="POST">
 	<p>
 		<input type="text" name="login" placeholder="Логин" value="<?php echo @data['login'] ?>">
 	</p>
	<p>
		<input type="password" name="password" placeholder="Пароль">
	</p>
	<p>
		<button type="submit" name="do-login">Войти</button>
	</p>
 </form>