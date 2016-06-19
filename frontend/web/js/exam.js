/**
 * 试卷相关js
 */
$(function() {
    'use strict';

    // 树状分类
    $('#exam-cat-tree')
        .on('changed.jstree', function(e, data) {
            var node = data.instance.get_node(data.selected[0]);
            console.log(node.text, node.data);
        })
        .jstree();

})
