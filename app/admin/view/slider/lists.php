<extend file='resource/admin/father.php'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('slider.lists')}}">轮播图列表</a></li>
        <li><a href="{{u('slider.post')}}">添加轮播图</a></li>
    </ul>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="100">ID</th>
            <th>标题</th>
            <th>排序</th>
            <th>缩略图</th>
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        <foreach from="$data" value="$v">
            <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v['title']}}</td>
                <td>{{$v['orderby']}}</td>
                <td>
                    <img src="{{$v['thumb']}}" style="width: 60px;">
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{u('slider.post',['id'=>$v['id']])}}" class="btn btn-default">编辑</a>
                        <a href="javascript:;" onclick="del({{$v['id']}})" class="btn btn-default">删除</a>
                    </div>
                </td>
            </tr>
        </foreach>
        </tbody>
    </table>
    {{$data->links()}}
    <script>
        function del(id) {
            if(confirm('确定删除吗')){
                location.href = "{{u('slider.delete')}}&id="+id;
            }

        }
    </script>
</block>