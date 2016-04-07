$(function() {
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
        mathJaxLib: '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML',
        extraPlugins: 'mathjax'
    };
    // 所有editor都使用上面的config
    CKEDITOR.on( 'instanceCreated', function ( event  ) {
        $.extend(event.editor.config, editorConfig);
    } );

    // 元素上设置了 data-ckeditor 的，自动使用ckeditor注册
    $('[data-ckeditor]').each(function(i, item) {
        var editor = CKEDITOR.replace(item);
        var $el = $(item);
        if ($el.is('textarea')) {
            editor.on('change', function() {
                $el.val(editor.getData())
                    .trigger('change.yiiActiveForm');
            });
        }
    })
});
