$(function() {
    'use strict';

    var global_config = window.bsk_question || {};

    function init() {
        setTimeout(initTreeInputs, 600); // 修改treeview.change事件处理需要初始化后执行，因此延时调用
        initEditors();
        initInfo();
    }

    init();

    // 修改treeInput选择实现，只能选择叶子节点
    function initTreeInputs() {
        $($.map(global_config.treeInputIds, function(id){ return '#'+id; }).join(','))
            .off('treeview.change')
            .on('treeview.change', function(e, key, desc) {
                var input = $(e.currentTarget),
                    d = input.data('treeinput'),
                    vkey = [], vdesc = [], keys;
                if (key) {
                    keys = ('' + key).split(',');
                    keys.forEach(function(item) {
                        var li = d.$tree.find('li[data-key=' + item +']');
                        if (li.data('lft') > 1 && li.data('rgt') - li.data('lft') === 1) {
                            vkey.push(item);
                            vdesc.push(li.find('>.kv-tree-list .kv-node-label').text());
                        }
                    });
                }

                if (!d.treeview.multiple && d.autoCloseOnSelect) {
                    d.$input.closest('.kv-tree-dropdown-container').removeClass('open');
                }
                input.val(vkey.join(''));
                d.setInput(vdesc);
            });
    }


    // 编辑器配置
    function initEditors() {
        var editorConfig = {
            title: false,
            height: 100,
            uiColor: '#eeeeee',
            resize_enabled: false,
            enterMode: CKEDITOR.ENTER_BR,
            removeButtons: '',
            toolbar: [
                ['Undo', 'Redo'],
                ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'],
                ['Image', 'SpecialChar', 'Mathjax'],
                ['Maximize']
            ],
            filebrowserImageUploadUrl: '',
            mathJaxLib: global_config.mathjaxLib,
            extraPlugins: 'mathjax'
        };

        // 初始化编辑器
        $.each(global_config.editorIds, function(i, id) {
            var editor = CKEDITOR.replace(id, editorConfig);
            editor.on('change', function(){ // 动态更新数据内容
                $('#' + id)
                    .val(editor.getData())
                    .trigger('change.yiiActiveForm');
            });
        });
    }


    // 初始化选项或填空答案部分
    function initInfo() {
        var type = global_config.type,
            isSelect = type === 1, // 选择题
            isFill = type === 2; // 填空题
        if (!isSelect && !isFill) return;
        var infoInput = $('#' + global_config.infoId),
            info = infoInput.val();
        info = info ? JSON.parse(info) : info;
    }

});
