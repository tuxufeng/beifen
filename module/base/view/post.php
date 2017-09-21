<extend file='resource/admin/wechat.php'/>
<block name="content">
    <form action="" method="post" class="form-horizontal" role="form">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">触发关键词</h3>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">触发关键词:</label>
                    <div class="col-sm-10">
                        <input type="text" name="keyword" class="form-control" value="{{$key['keyword']}}">
                    </div>
                </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">回复内容</h3>
        </div>
        <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">回复内容:</label>
                    <div class="col-sm-10">
                        <textarea name="content" class="form-control" rows="10">{{$base['content']}}</textarea>
                    </div>
                </div>


        </div>
    </div>
        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">保存数据</button>
            </div>
        </div>
    </form>

</block>