<extend file='resource/admin/wechat.php'/>
<block name="content">
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#" role="tab" data-toggle="tab">系统回复</a></li>
    </ul>
    <form action="" method="post" role="form" class="form-horizontal">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">系统回复</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">默认消息回复</label>
                    <div class="col-sm-10">
                        <input type="text" name="default_message" value="{{$model['default_message']}}" class="form-control">
                        <span class="help-block">设置没有关键词匹配时的回复消息</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">欢迎消息回复</label>
                    <div class="col-sm-10">
                        <input type="text" name="welcome" value="{{$model['welcome']}}" class="form-control">
                        <span class="help-block">设置关注公众号时的欢迎消息回复</span>
                    </div>
                </div>
        </div>
        <button class="btn btn-primary">保存配置</button>
    </form>
</block>