<?php 
require 'db.php';

$data = $_POST;
$errors = array();
if (isset($data['do-signup'])) {
	if (trim($data['login']) == '') {
		$errors[] = "Вы не ввели логин!!!";
	}
	if (trim($data['login']) == '') {
		$errors[] = "Вы не ввели E-mail!!!";
	}
	if (trim($data['login']) == '') {
		$errors[] = "Вы не ввели пароль!!!";
	}
	if ($data['password'] != $data['password-repead']) {
		$errors[] = "Пароли должны совпадать!!!";
	}
	if (empty($errors)){
		$user = R::dispense('users');
		$user->login = $data['login'];
		$user->email = $data['email'];
		$user->password = $data['password'];
		$user->join_date = date('j-F-Y H:i');
		R::store($user);
		echo '<div style="color:green;"> Вы успешно зарегестрировались!</div><hr>';
	}else{
		echo '<div style="color:red;">'. $errors[0].'</div>';
	}
}
 ?>

 <form action="signup.php">
 	<p>
 		<input type="text" name="text" placeholder="Логин">
 	</p>
	<p>
		<input type="email" name="password-repead" placeholder="Электронная почта">
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