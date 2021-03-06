<?php
use yii\helpers\Url;

// 定义标题和面包屑信息
$this->title = '角色信息';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--前面导航信息-->
<p>
    <button class="btn btn-white btn-success btn-bold me-table-create">
        <i class="ace-icon fa fa-plus bigger-120 blue"></i>
        添加
    </button>
    <button class="btn btn-white btn-warning btn-bold me-table-delete">
        <i class="ace-icon fa fa-trash-o bigger-120 orange"></i>
        删除
    </button>
    <button class="btn btn-white btn-info btn-bold me-hide">
        <i class="ace-icon fa  fa-external-link bigger-120 orange"></i>
        隐藏
    </button>
    <button class="btn btn-white btn-primary btn-bold orange2 me-table-reload">
        <i class="ace-icon fa fa-refresh bigger-120 orange"></i>
        刷新
    </button>
</p>
<!--表格数据-->
<table class="table table-striped table-bordered table-hover" id="show-table"></table>
<?php $this->beginBlock('javascript');?>
<script type="text/javascript">
    // 设置表单信息
    function setOperate(td, data, rowArr, row, col)
    {
        var str = '<a class="btn btn-success btn-xs" href="<?=Url::toRoute(['role/view'])?>?name=' + rowArr['name'] + '"><i class="glyphicon glyphicon-zoom-in"></i></a> ';
        str += '<a class="btn btn-info btn-xs" href="javascript:;" onclick="m.update('+row+');"><i class="glyphicon glyphicon-edit "></i></a> ';
        str += '<a class="btn btn-warning btn-xs" href="<?=Url::toRoute(['role/edit'])?>?name=' + rowArr['name'] + '" ><i class="glyphicon glyphicon-edit "></i>编辑权限</a> ';
        str += '<a class="btn btn-danger btn-xs" href="javascript:;" onclick="m.delete('+row+');"><i class="glyphicon glyphicon-trash "></i></a>';
        $(td).html(str);
    }

    var m = mt({
        title: "角色信息",
        operations: {
            isOpen: false
        },
        table: {
            "aoColumns":[
                {"title": "角色名称", "data": "name", "sName": "name", "edit": {"type": "text", "options": {"required": true, "rangelength": "[2, 64]"}}, "search": {"type": "text"}, "bSortable": false},
                {"title": "说明描述", "data": "description", "sName": "description", "edit": {"type": "text", "options": {"required": true, "rangelength": "[2, 255]"}}, "search": {"type": "text"}, "bSortable": false},
                {"title": "创建时间", "data": "created_at", "sName": "created_at", "defaultOrder": "desc", "createdCell" : mt.dateTimeString},
                {"title": "修改时间", "data": "updated_at", "sName": "updated_at", "createdCell" : mt.dateTimeString},
                {"data": null, "title":"操作", "bSortable":false, "createdCell":setOperate, "width":"200px"}
            ]
        }
    });

    mt.fn.extend({
        afterShow: function(){
            $(this.options.sFormId).find('input[name=name]').attr('readonly', this.action == 'update');
            return true;
        }
    });

    $(function(){
        m.init();
    })
</script>
<?php $this->endBlock(); ?>
