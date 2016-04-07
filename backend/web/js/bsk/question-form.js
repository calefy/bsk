$(function() {
    'use strict';

    var global_config = window.bsk_question || {};
    var countor = 1;
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
            ['Image', 'Table', 'SpecialChar', 'Mathjax'],
            ['Maximize']
        ],
        filebrowserImageUploadUrl: '/bsk-question/image-upload?fileparam=upload',
        mathJaxLib: global_config.mathjaxLib,
        extraPlugins: 'mathjax'
    };
    // 所有editor都使用上面的config
    CKEDITOR.on( 'instanceCreated', function ( event  ) {
        $.extend(event.editor.config, editorConfig);
    } );

    function init() {
        setTimeout(initTreeInputs, 600); // 修改treeview.change事件处理需要初始化后执行，因此延时调用
        //initEditors();
        initForm();
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
    function initForm() {
        var type = global_config.type,
            isSelect = type === 1, // 选择题
            isFill = type === 2; // 填空题
        if (isSelect || isFill) {
            var infoInput = $('#' + global_config.infoId),
                info = infoInput.val();
            info = info ? JSON.parse(info) : info;

            if (info) {
                $.each(info, function(i, item) {
                    _addOption(isFill, item);
                });
            } else {
                _addOption(isFill);
            }
        }

        CKEDITOR.replace(global_config.analyzeId);
        CKEDITOR.replace(global_config.answerId);
        CKEDITOR.replace(global_config.commentId);

        // 监听事件
        $('#questionBody')
            .on('click', 'button[data-role=addOption]', function() {
                _addOption(isFill);
            })
            .on('click', 'a[data-role=delete]', function(e) {
                e.preventDefault();
                var target = $(e.currentTarget),
                    dd = target.parent(),
                    editor;
                editor = CKEDITOR.instances[dd.children(':last').attr('id')];
                if (editor) {
                    editor.destroy();
                }

                if (isSelect) { // 修改前缀
                    dd.siblings('dd').each(function(i, item) {
                        $(item).children('[data-role=prefix]').text(String.fromCharCode(65 + i));
                    });
                }

                dd.remove();
            });
            // 在表单校验前，获取editor中的数据
            $('form').on('beforeValidate', function(e) {
                var form = $(e.currentTarget);
                // 解析
                $('#' + global_config.analyzeId).val(CKEDITOR.instances[global_config.analyzeId].getData());
                $('#' + global_config.answerId).val(CKEDITOR.instances[global_config.answerId].getData());
                $('#' + global_config.commentId).val(CKEDITOR.instances[global_config.commentId].getData());
                // title
                var tval = CKEDITOR.instances.title.getData();
                $('#' + global_config.titleId).val(tval);
                // options
                var opts = [];
                var hasCorrect = false;
                $('#questionBody dd').each(function(i, dd) {
                    dd = $(dd);
                    var obj = { text: '' },
                        id = dd.children(':last').attr('id'),
                        editor = CKEDITOR.instances[id];
                    if (editor) {
                        obj.text = editor.getData();
                    }
                    if (isSelect && dd.children('input').is(':checked')) {
                        obj.correct = true;
                        hasCorrect = true;
                    }
                    opts.push(obj);
                });
                $('#' + global_config.infoId).val(opts.length ? JSON.stringify(opts) : '');

                if (!tval) {
                    alert('标题不能为空');
                    return false;
                } else if (isSelect && !opts.length) {
                    alert('选项不能为空');
                    return false;
                } else if (isFill && !opts.length) {
                    alert('填空答案不能为空');
                    return false;
                } else if (isSelect && !hasCorrect) {
                    alert('选项必须设置一个为正确答案');
                    return false;
                }
            });
    }

    function _addOption(isFill, contentObj) {
        contentObj = contentObj || {};
        var body = $('#questionBody'),
            container = body.find('dl[data-role=options]'),
            len = container.children('dd').length,
            id = 'option-' + (countor++),
            item;
        item =  '<dd>' +
                '    <a data-role="delete" href="#"><i class="glyphicon glyphicon-remove"></i></a>' +
                (isFill ? '' : '    <input type="checkbox" '+(contentObj.correct ? 'checked' : '')+' />') +
                (isFill ? '' : '    <span data-role="prefix">'+String.fromCharCode(65 + len)+'</span>. ')+
                '    <div class="dib vat" contenteditable="true" id="'+id+'">'+(contentObj.text ? contentObj.text : '点击这里编辑'+(isFill ? '填空答案' : '选项'))+'</div>' +
                '</dd>'

        container.append(item);
        CKEDITOR.inline(id);
    }

});
