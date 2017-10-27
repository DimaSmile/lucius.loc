<?php 
require 'db.php';

$data = $_POST;
$errors = array();
if (isset($data['do-signup'])) {
		if (trim($data['login']) == '') {
			$errors[] = "Вы не ввели логин!!!";
		}
		if (trim($data['email']) == '') {
			$errors[] = "Вы не ввели E-mail!!!";
		}
		if (trim($data['password']) == '') {
			$errors[] = "Вы не ввели пароль!!!";
		}
		if ($data['password'] != $data['password-repead']) {
			$errors[] = "Пароли должны совпадать!!!";
		}
	}
	if (R::count('users', 'login = ?', array($data['login']))) {
		$errors = 'Пользователь с таким логином уже существует!';
	}
	if (R::count('users', 'login = ?', array($data['email']))) {
		$errors[] = "Пользователь с таким e-mail'ом уже существует!";
	}
	if (empty($errors)){
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->join_date = date('j-F-Y H:i');
		R::store($user);
		echo '<div style="color:green;"> Вы успешно зарегестрировались!</div><hr>';
	}else{
		echo '<div style="color:red;">'. $errors[0].'</div>';
	}
}
 ?>

 <form action="signup.php" method="POST">
 	<p>
 		<input type="text" name="login" placeholder="Логин" value="<?php echo @data['login'] ?>">
 	</p>
	<p>
		<input type="email" name="email" placeholder="Электронная почта" value="<?php echo @data['email'] ?>">
	</p>
	<p>
		<input type="password" name="password" placeholder="Пароль">
	</p>
	<p>
		<input type="password" name="password-repead" placeholder="Повторите пароль">
	</p>
	<p>
		<button type="submit" name="do-signup">Зарегистрироваться</button>
	</p>
 </form>