<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Equipments;
use yii\helpers\Html; 

class EquipmentController extends Controller {
	
	// public $layout='column3';    // for product2
	public $products;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Declares class-based actions.
	*/
	public function actions()
	{

	}

	public function actionIndex() {

		// die('hard');
		// Yii::$app->db->createCommand('select * from equipments')->queryAll();
		$products = (new \yii\db\Query())
		    ->select(['*'])
		    ->from('equipments')
		    // ->where(['last_name' => 'Smith'])
		    ->limit(100)            // may be paginate
		    ->all();

		// $products = Equipments::all();
		$products = json_encode($products);
		// $this->products = $products;
		// print_r($products);
		// die();

		$this->render('index', ['products'=>$products]);
	}	

	public function actionLoad() {

		$response = [];
		// $products = \Yii::$app->db->createCommand('select name, VN_price, produced_year, Manufacturer, Import_price, Note  from products')->queryAll();
		// TODO hide id from edit in view
		$products = Equipments::all();
		// $products = \Yii::$app->db->createCommand('select * from equipments')->queryAll();

		// foreach($products as $product) {
		// 	$response[] = array_values( (array)$product );
		// }

		// $response = array_values( (array)$response );
		// echo "<pre/>";
		echo json_encode(['data'=>$products]);

		// print_r($response);
		// echo json_encode(['data' => $response]);
		exit;
	}

	public function actionSave() {

		// ID truyen len ko phai id tu DB ma la handson ve ra
		// Vi the khi chen row co the se loi, column thi ko lien quan
		// Cant add column because data used is object (bla blah)
		// use array datasource is ok ?
		// remove is the same

		$data = $_POST['data'];

		foreach($data as $dt) {
			// Yii::log($dt[0].$dt[1], 1, 'system.web.ProductController');
			// if($this->validateData($dt) == true) {
			if(1) {
				if($dt['id'] > 0) {    // has id, so update
					$this->updateProduct($dt);
				} else {
					// insert new
					if($dt['name'] != "") {
						$this->saveProduct($dt);
					}
				}
			} else {
				// $_POST['result'] = 'err';
				// echo json_encode($_POST);
				// exit;
			}
		}

		$_POST['result'] = 'ok';
		echo json_encode($_POST);
		exit;
	}

	public function actionUpdate() {

		// Change in only one cell of the sheet
		// So only update one column.

		// TODO Nooooooooo, there is some action that affect multi-row n multi-col
		// ie. drag, swap ... ?
		$product = $_POST['changes'][0];

		$this->updateProductProperty($product);

		// $res['result'] = 'ok';
		$product['result'] = 'ok';
		echo json_encode($product);
		exit;
	}

	/**
	 * This is the action to handle external exceptions.
	*/
	public function actionError()
	{
		if($error=\Yii::$app->errorHandler->error)
		{
			if(\Yii::$app->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	// check valid product rows data
	// pass if at least 1 column has data
	public function validateData($data) {
		// if(!empty($data)) {
		// 	return true;
		// }

		$this->otherValidate($data);
		// return false;
	}

	public function updateProduct($pd) {
		// VN_price, produced_year, Manufacturer, Import_price, Note, Available
		// TODO use Model instead of raw query

		$query = \Yii::$app->db->createCommand('update equipments set name="'.$pd['name']. 
			'", vn_price="'.$pd['vn_price']. '", produced_year="'.$pd['produced_year']. '", manufacturer="'.
			$pd['manufacturer']. '", import_price="'.$pd['import_price']. '", color="'.$pd['color']. '", note="'.$pd['note'].
			'", available="'. $pd['available']. '" where id='. $pd['id']. ';')->query();

		return;
	}

	public function updateProductProperty($pd) {

		// VN_price, produced_year, Manufacturer, Import_price, Note
		// TODO use Model instead of raw query
		$column = ['id', 'name', 'vn_price', 'produced_year', 'manufacturer', 'import_price','color', 'note', 'available'];
		// $column_name = $column[$pd[1]]; // change array [1] is column of cell changing.
		$column_name = $pd[1]; // array[1] in change[] is key of this cell data

		if($pd[0] > 0) { // update 
			// TODO id here get from js table view, not render by DB
			// So it all has number

			// how can i check this
			$query = \Yii::$app->db->createCommand('select * from equipments where id='. ($pd[0]+1). ';')->query();
			if(count($query) > 0) {
				$query = \Yii::$app->db->createCommand('update equipments set '. $column_name.'="'.$pd['3']. '" where id='. ($pd[0]+1). ';')->query();
			} else {
				// new item, TODO use Model instead of sql
				// TODO has name ?
				$product = [];
				for($i=0; $i < count($column); $i++) {
					$product[] = ($pd[1] == $column[$i]) ? $pd[3] : '';
				}
				$this->saveProduct($product);
			}
		} else {  // insert
			// $product = [];
			// for($i=1; $i < count($column); $i++) {
			// 	$product[] = ($pd[1] == $column[$i]) ? $pd[3] : '';
			// }
			// $this->saveProduct($product);
		}

		return;
	}

	public function saveProduct($pd) {
		// VN_price, produced_year, Manufacturer, Import_price, Note
		// TODO use Model instead of raw query
		$data = '"'.implode('","', $pd). '"';
		$query = \Yii::$app->db->createCommand('insert into equipments values('. $data .');')->query();

		return;
	}

	public function otherValidate($data) {
		if(empty($data)) return false;
		if($data[1] == "") return false; // product name

		return true;
		// $length = 0;
		// foreach($data as $dt) {
		// 	$length += strlen($dt);
		// }

		// return ($length) ? true : false;
	}





	/********************* Other demos *************************************/
	public function actionValidationDemo() {

		$this->render('validation', []);
	}

	// @return array of product name (equipment name)
	// public function listProductName() {
	public function listEquipName() {
		// used in auto complete cell 

		// $equipment_names = Equipments::model()->findAll();
		$equipment_names = \Yii::$app->db->createCommand('select distinct(name)  from equipments')->queryAll();
		// echo "<pre/>";
		// print_r($equipment_names);
		$equipment_names['result'] = 'ok';
		if(count($equipment_names) > 0) {

			// TODO handle data ?
			foreach($equipment_names as $name) {
				$response[] = array_values( (array)$name );
			}

			$response = array_values( (array)$response );
			echo json_encode(['data' => $response]);
			exit;
		}

		echo json_encode(['data' => $equipment_names]);
		exit;
	}

	public function actionListEquipName() {
		// used in auto complete cell 

		// $equipment_names = Equipments::model()->findAll();
		$equipment_names = \Yii::$app->db->createCommand('select distinct(name)  from equipments')->queryAll();
		// echo "<pre/>";
		// print_r($equipment_names);
		$equipment_names['result'] = 'ok';
		if(count($equipment_names) > 0) {

			// TODO handle data ?
			foreach($equipment_names as $kep => $name) {
				// print_r($name['name']);

				$response[] = @$name['name'];
				// print_r($response);
				// die;
			}

			$response = array_values( (array)$response );
			echo json_encode(['data' => $response]);
			exit;
		}

		echo json_encode(['data' => $equipment_names]);
		exit;
	}
}