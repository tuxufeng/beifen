<extend file='resource/admin/father.php'/>
<block name="content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">分类管理</h3>
        </div>
        <div class="panel-body">
            <form action="" method="post" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">父级栏目:</label>
                    <div class="col-sm-10">
                        <select name="pid" class="form-control">
                                <option value="0">顶级分类</option>
                            <foreach from="$data" value="$v">
                                <if value="$model['pid'] == $v['cid']">
                                    <option value="{{$v['cid']}}"{{$v['_disabled']}} selected='selected'>{{$v['_cname']}}</option>
                                <else/>
                                    <option value="{{$v['cid']}}"{{$v['_disabled']}}>{{$v['_cname']}}</option>
                                </if>
                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类名称:</label>
                    <div class="col-sm-10">
                        <input type="text" name="cname" class="form-control" value="{{$model['cname']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">分类描述:</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" rows="10">{{$model['description']}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">排序:</label>
                    <div class="col-sm-10">
                        <input type="text" name="orderby" class="form-control" value="{{$model['orderby']}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary">保存数据</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</block>