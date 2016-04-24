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
