<?php

/**
 * Pages controller
 * @package modules.pages
 */
class PagesController extends Controller
{

	/**
	 * Filter pages by category
	 * @param string $url Category url
	 */
	public function actionList($url)
	{
		$model = PageCategory::model()
			->withFullUrl($url)
			->find();

		if (!$model) throw new CHttpException(404, Yii::t('PagesModule.core', 'Категория не найдена.'));

		$criteria = Page::model()
			->published()
			->filterByCategory($model)
			->getDbCriteria();

		$count = Page::model()->count($criteria);

		$pagination = new CPagination($count);
		$pagination->pageSize = ($model->page_size > 0) ? $model->page_size: $model->defaultPageSize;
		$pagination->applyLimit($criteria);

		$pages = Page::model()->findAll($criteria);

		$view = $this->setDesign($model, 'list');

		$this->render($view, array(
			'model'=>$model,
			'pages'=>$pages,
			'pagination'=>$pagination
		));
	}

	/**
	 * Display page by url.
	 * Example url: /page/some-page-url
	 * @param string $url page url
	 */
	public function actionView($url)
	{
		$model = Page::model()
			->published()
			->withUrl($url)
			->find(array(
				'limit'=>1
			));

		if (!$model) throw new CHttpException(404, Yii::t('PagesModule.core', 'Страница не найдена.'));

		$view = $this->setDesign($model, 'view');

		$this->render($view, array(
			'model'=>$model,
		));
	}

}