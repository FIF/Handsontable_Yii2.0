<?php
/**
 * The followings are the available columns in table 'tbl_product':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 */
class Products extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return static the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return [];
		// return array(
		// 	array('content, author, email', 'required'),
		// 	array('author, email, url', 'length', 'max'=>128),
		// 	array('email','email'),
		// 	array('url','url'),
		// );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.

		return [];

		// return array(
		// 	'post' => array(self::BELONGS_TO, 'Post', 'post_id'),
		// );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'name' => 'ProductName',
			'produced_year' => 'Create Time',
			'Manufacturer' => 'Manufacturer',
			'Import_price' => 'Import_price',
			'VN_price' => 'VN_price',
			'Note' => 'Note',
		);
	}

	/**
	 * Approves a comment.
	 */
	public function approve()
	{
		// $this->status=Comment::STATUS_APPROVED;
		// $this->update(array('status'));
	}

	/**
	 * @param Post the post that this comment belongs to. If null, the method
	 * will query for the post.
	 * @return string the permalink URL for this comment
	 */
	public function getUrl($post=null)
	{
		if($post===null)
			$post=$this->post;
		return $post->url.'#c'.$this->id;
	}

	/**
	 * @return string the hyperlink display for the current comment's author
	 */
	public function getAuthorLink()
	{
		if(!empty($this->url))
			return CHtml::link(CHtml::encode($this->Manufacturer),$this->url);
		else
			return CHtml::encode($this->Manufacturer);
	}


	/**
	 * @param integer the maximum number of comments that should be returned
	 * @return array the most recently added comments
	 */
	public function findRecentComments($limit=10)
	{
		// return $this->with('post')->findAll(array(
		// 	'condition'=>'t.status='.self::STATUS_APPROVED,
		// 	'order'=>'t.create_time DESC',
		// 	'limit'=>$limit,
		// ));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
				$this->create_time=time();
			return true;
		}
		else
			return false;
	}
}