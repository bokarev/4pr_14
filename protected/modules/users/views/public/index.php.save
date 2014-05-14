<?php

/**
 * @var $profile UserProfile
 * @var $user User
 */

// Fancybox ext
$this->widget('application.extensions.fancybox.EFancyBox', array(
	'target'=>'a.thumbnail',
));

$this->pageTitle=Yii::t('UsersModule.core', 'Профиль пользователя');
?>
<h3 class="has_background"><?php //TODO_WUD : ! [cabinet]

echo Yii::t('UsersModule.core', 'Профиль пользователя');

?></h3>

<div class="row">
      <!-- Main Blog Content -->
    <div class="nine columns" role="content">

    <table>

	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('full_name'); ?>
		</td>
		<td>
			<?php echo $profile->full_name; ?>
		</td>

		<?php if ($profile->image <> '') : ?>
		<td rowspan="4">
		    	<a class="thumbnail" href="<?php echo Yii::app()->params['storeImages']['userpicUrl'] . $profile->image; ?>"> <img src='<?php echo Yii::app()->params['storeImages']['userpicUrl'] . 'thumb_' . $profile->image; ?>'> </a>
		</td>
		<?php endif; ?>

	</tr>

	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('city_id'); ?>
		</td>
		<td>
			<?php echo Cities::model()->findByPK($profile->city_id)->name; ?>
		</td>
	</tr>

	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('country_id'); ?>
		</td>
		<td>
			<?php echo Countries::model()->findByPK($profile->country_id)->name; ?>
		</td>
	</tr>


<?php if(!Yii::app()->user->isGuest): ?>

	<tr>
		<td>
			<?php echo $user->getAttributeLabel('email'); ?>
		</td>
		<td>
			<?php echo $user->email; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('phone'); ?>
		</td>
		<td>
			<?php echo $profile->phone; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('skype'); ?>
		</td>
		<td>
			<?php echo $profile->skype; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('sex'); ?>
		</td>
		<td>
			<?php if ($profile->sex > 0): ?>
				<?php  ($profile->sex == 1) ? 'Мужской' : 'Женский' ?>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('age'); ?>
		</td>
		<td>
			<?php echo $profile->age; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('income'); ?>
		</td>
		<td>
			<?php echo $profile->income; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('marital'); ?>
		</td>
		<td>
			<?php echo $profile->marital; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('have_auto'); ?>
		</td>
		<td>
			<?php ( $profile->have_auto == 1 ) ? 'Да' : 'Нет' ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('have_estate'); ?>
		</td>
		<td>
			<?php ( $profile->have_estate == 1 ) ? 'Да' : 'Нет' ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('foreign'); ?>
		</td>
		<td>
			<?php echo $profile->foreign; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('education'); ?>
		</td>
		<td>
			<?php echo $profile->education; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('profession'); ?>
		</td>
		<td>
			<?php echo $profile->profession; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('occupation'); ?>
		</td>
		<td>
			<?php echo $profile->occupation; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('known_computer'); ?>
		</td>
		<td>
			<?php ( $profile->known_computer == 1 ) ? 'Да' : 'Нет' ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('food'); ?>
		</td>
		<td>
			<?php echo $profile->food; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('travel'); ?>
		</td>
		<td>
			<?php echo $profile->travel; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('hobby'); ?>
		</td>
		<td>
			<?php echo $profile->hobby; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('sport'); ?>
		</td>
		<td>
			<?php echo $profile->sport; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('have_children'); ?>
		</td>
		<td>
			<?php ( $profile->have_children == 1 ) ? 'Да' : 'Нет' ?>
		</td>
	</tr>
 	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('district_home'); ?>
		</td>
		<td>
			<?php echo $profile->district_home; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $profile->getAttributeLabel('district_work'); ?>
		</td>
		<td>
			<?php echo $profile->district_work; ?>
		</td>
	</tr>

<?php endif; ?>
</table>
    </div>
<?php if(!Yii::app()->user->isGuest): ?>
        <!-- Sidebar -->
    <aside class="three columns">

       <?php    // TODO_WUD : part cab
		$this->renderPartial('//site/partCabinetMenu');
        ?>

      <div class="panel">
        <h5>Wiki помощь</h5>
        <p>Чтобы лучше узнать как работать в личном кабинете, используйте наш справочник</p>
        <a href="/index.php?r=wiki/default/pageIndex">Подробнее &rarr;</a>
      </div>

    </aside>
    <!-- End Sidebar -->
<?php endif; ?>

</div>