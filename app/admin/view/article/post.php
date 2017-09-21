<extend file='resource/admin/father.php'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{{u('article.lists')}}">文章列表</a></li>
        <li class="active"><a href="{{u('article.post')}}">添加文章</a></li>
    </ul>
    <form action="" method="post" class="form-horizontal" role="form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">文章管理</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">所属分类:</label>
                    <div class="col-sm-10">
                        <select name="category_cid" id="" class="form-control">
                            <option value="">请选择文章分类</option>

                            <foreach from="$category" value="$v">

                                <if value="$model['category_cid'] == $v['cid']">
                                    <option value="{{$v['cid']}}" selected="selected">{{$v['_cname']}}</option>
                                    <else/>
                                    <option value="{{$v['cid']}}">{{$v['_cname']}}</option>
                                </if>

                            </foreach>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章标题:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{$model['title']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">点击数:</label>
                    <div class="col-sm-10">
                        <input type="text" name="click" class="form-control" value="{{$model['click']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">列表图片:</label>
<!--                    <div class="col-sm-10">-->
<!--                        <input type="text" name="thumb" class="form-control" value="{{$model['thumb']}}">-->
<!--                    </div>-->
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input class="form-control" name="thumb" readonly="" value="{{$model['thumb']}}">
                            <div class="input-group-btn">
                                <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片</button>
                            </div>
                        </div>
                        <div class="input-group" style="margin-top:5px;">
                            <if value="$model['thumb']">
                                <img src="{{$model['thumb']}}" class="img-responsive img-thumbnail" width="150">
                            <else/>
                                <img src="/hdphp/node_modules/hdjs/dist/static/image/nopic.jpg" class="img-responsive img-thumbnail" width="150">
                            </if>
                            <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                onclick="removeImg(this)">×</em>
                        </div>
                    </div>
                    <script>
                        require(['hdjs']);
                        //上传图片
                        function upImage() {
                            require(['hdjs'], function (hdjs) {
                                options = {
                                    multiple: false,//是否允许多图上传
                                    //data是向后台服务器提交的POST数据
                                    data: {name: '后盾人', year: 2099},
                                };
                                hdjs.image(function (images) {
                                    //上传成功的图片，数组类型
                                    $("[name='thumb']").val(images[0]);
                                    $(".img-thumbnail").attr('src', images[0]);
                                }, options)
                            });
                        }
                        //移除图片
                        function removeImg(obj) {
                            $(obj).prev('img').attr('src','/node_modules/hdjs/dist/static/image/nopic.jpg');
                            $(obj).parent().prev().find('input').val('');
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章简介:</label>
                    <div class="col-sm-10">
<!--                        <input type="text" name="description" class="form-control" value="{{$model['description']}}">-->
                        <textarea id="description" name="description" style="height:300px;width:100%;">{{$model['description']}}</textarea>
                        <script>
                            require(['hdjs'], function (hdjs) {
                                var ueditor =  hdjs.ueditor('description', {hash: 2, data: 'hd'}, function (editor) {
                                    console.log(3)
                                });
                            })
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章内容:</label>
                    <div class="col-sm-10">
<!--                        <input type="text" name="content" class="form-control" value="{{$model['content']}}">-->
                        <textarea id="content" name="content" style="height:300px;width:100%;">{{$model['content']}}</textarea>
                        <script>
                            require(['hdjs'], function (hdjs) {
                                var ueditor =  hdjs.ueditor('content', {hash: 2, data: 'hd'}, function (editor) {
                                    console.log(3)
                                });
                            })
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章来源:</label>
                    <div class="col-sm-10">
                        <input type="text" name="source" class="form-control" value="{{$model['source']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">文章作者:</label>
                    <div class="col-sm-10">
                        <input type="text" name="author" class="form-control" value="{{$model['author']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">排序:</label>
                    <div class="col-sm-10">
                        <input type="text" name="orderby" class="form-control" value="{{$model['orderby']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">外部链接:</label>
                    <div class="col-sm-10">
                        <input type="text" name="linkurl" class="form-control" value="{{$model['linkurl']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">关键字:</label>
                    <div class="col-sm-10">
                        <input type="text" name="keywords" class="form-control" value="{{$model['keywords']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否推荐:</label>
                    <div class="col-sm-10">
                        <label class="col-sm-10">
                            <if value="$model['iscommend']==1">
                                <input type="checkbox" name="iscommend" value="" checked="checked"> 推荐
                                <else/>
                                <input type="checkbox" name="iscommend" value="1" > 推荐
                            </if>
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否热门:</label>
                    <div class="col-sm-10">
                        <label class="col-sm-10">
                            <if value="$model['ishot']==1">
                                <input type="checkbox" name="ishot" value="1" checked="checked"> 热门
                                <else/>
                                <input type="checkbox" name="ishot" value="1" > 热门
                            </if>
                        </label>
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