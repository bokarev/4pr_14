<html>
<body>

  <p>Здравствуйте, <?=$user->profile->full_name?>.</p>
  <p>Вам назначен новый тест.</p>

  <p>
    Детали вы можете просмотреть на странице:<br>
	 <a href="<?= $this->createAbsoluteUrl('/users/profile/tests', array('id'=>$order->product_id, 'order'=>$order->order_id )) ?>">
		 <?= $this->createAbsoluteUrl('/users/profile/tests', array('id'=>$order->product_id, 'order'=>$order->order_id)) ?>
	 </a>
  </p>
</body>
</html>