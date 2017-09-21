<?php namespace system\model;
use houdunwang\model\Model;
use houdunwang\session\Session;

class User extends Model{
	//数据表
	protected $table = "user";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
//		['password','required','密码不能为空',self::MUST_VALIDATE ,self::MODEL_BOTH]
	];

	//自动完成
	protected $auto=[
		//['字段名','处理方法','方法类型',验证条件,验证时机]
	];

	//自动过滤
    protected $filter=[
        //[表单字段名,过滤条件,处理时间]
    ];

	//时间操作,需要表中存在created_at,updated_at字段
	protected $timestamps=true;

	public static function login($data){
        if(empty($data['username'])||empty($data['password'])){
            return ['valid'=>0,'message'=>'用户名和密码不能为空'];
        }
        $user = self::where('username',$data['username'])->first();
        if(empty($user)){
            return ['valid'=>0,'message'=>'输入的用户名不存在'];
        }
        if(!password_verify($data['password'],$user['password'])){
            return ['valid'=>0,'message'=>'输入的密码不正确'];
        }
        Session::set('id',$user['id']);
        Session::set('username',$user['username']);
        return ['valid' => 1,'message' => '登录成功'];
    }

    public function changePassword($data){
	    $id = Session::get('id');
	    $model = $this->find($id);
	    if(empty($data['oldpassword'])){
	        $this->setError(['旧密码不能为空']);
	        return false;
        }
        if(empty($data['password'])||empty($data['password_confirm'])){
	        $this->setError(['新密码不能为空']);
	        return false;
        }
        if(!password_verify($data['oldpassword'],$model['password'])){
            $this->setError(['旧密码不正确']);
            return false;
        }
        if($data['password']!=$data['password_confirm']){
            $this->setError(['两次输入密码不一致']);
            return false;
        }
        $model['password']=password_hash($data['password'],PASSWORD_DEFAULT);
        $model->save();
        return true;
    }
}