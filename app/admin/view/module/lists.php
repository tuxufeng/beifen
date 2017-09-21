<extend file='resource/admin/module.php'/>
<block name="content">
    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="{{u('module.lists')}}">模块列表</a></li>
        <li><a href="{{u('module.post')}}">设计模块</a></li>
    </ul>
    <table class="table table-hover">
        <thead>
        <tr>
            <th width="80">ID</th>
            <th>模块图片</th>
            <th>模块名称</th>
            <th width="150">操作</th>
        </tr>
        </thead>
        <tbody>
        <foreach from="$data" value="$v">
        <tr>
            <td>{{$v['id']}}</td>
            <td>
                <img src="{{$v['preview']}}" style="height: 60px;">
            </td>
            <td>{{$v['name']}}</td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a href="javascript:;" onclick="remove('{{$v["name"]}}')" class="btn btn-danger">卸载</a>
                </div>
            </td>
        </tr>
        </foreach>
        </tbody>
    </table>
    <script>
        function remove(name) {
            if(confirm('确认卸载该模块吗?')){
                location.href = "{{u('module.delete')}}&name="+name;
            }
        }
    </script>

</block>