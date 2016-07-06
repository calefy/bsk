/**
 *  @author Eugene Terentev <eugene@terentev.net>
 */
// 配置mathjax不显示右键菜单，下面两项联合配置生效
setTimeout(function() {
    if (window.MathJax) {
        MathJax.Hub.Config({
            context: 'Browser',
            showMathMenu: false
        });
    }
}, 200);


// bootstrap下拉菜单点击变化
$(function() {
    $('.dropdown-menu a').on('click', function(e) {
        e.preventDefault();
        var target = $(e.currentTarget);
        target.parents('.input-group-btn:eq(0)')
            .find('input[data-role=button]')
            .val(target.data('key') || target.text())
            .end()
            .find('button .text')
            .text(target.text());
    })

});
