<?php namespace system\model;
use houdunwang\model\Model;
class Category extends Model{
	//数据表
	protected $table = "category";

	//允许填充字段
	protected $allowFill = ['*'];

	//禁止填充字段
	protected $denyFill = [ ];

	//自动验证
	protected $validate=[
		//['字段名','验证方法','提示信息',验证条件,验证时间]
		['cname','required','分类名称不能为空',self::MUST_VALIDATE,self::MODEL_BOTH],
        ['orderby','/^\d+$/','排序必须是数字',self::MUST_VALIDATE,self::MODEL_BOTH]
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

//	增强数据的方法（树状）
	public static function getCategory(){
       $data = self::get()->toArray();
        return Arr::tree($data,'cname','cid','pid');
    }


    public static function getCategoryByCid($model){
	    $data = self::getCategory();

        foreach ($data as $k=>$v){
            //	    判断修改的信息的父级不能为自己
            if($model['cid']==$v['cid']){
                $data[$k]['_disabled'] = "disabled='disabled'";
            }else{
                $data[$k]['_disabled'] = '';
            }
            //        判断当前栏目的子栏目不能为父级
            if(Arr::isChild($data, $v['cid'], $model['cid'], 'cid', 'pid')){
                $data[$k]['_disabled'] = "disabled='disabled'";
            }
        }
	    return $data;
    }


//    删除数据的方法
    public function delete($cid){
//        全部数据
        $data = self::getCategory();
//        单条数据
        $model =$this->find($cid);
        if(Arr::hasChild($data, $cid, 'pid')){
            $this->setError(['请先删除子栏目']);
            return false;
        }
       return $model->destory();

    }
}