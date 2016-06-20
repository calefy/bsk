/**
 * 试卷相关js
 */
$(function() {
    'use strict';

    // 树状分类
    (function() {
        var treeDom = $('#exam-cat-tree'),
            categories = treeDom.data('categories'),
            currentId = treeDom.data('current'),
            req = treeDom.data('req'),
            lastRoot = {};

        $.each(categories, function(i, c) {
            c.text = c.name;
            c.parent = '#';
            c.icon = false;
            c.state = {};
            if (c.rgt < lastRoot.rgt) {
                c.parent = lastRoot.id;
            } else if (c.rgt - c.lft > 1) {
                lastRoot = c;
                c.state.opened = true;
            }

            if (c.id == currentId) {
                c.state.selected = true;
            }
        })

        treeDom.jstree({
                core: {
                    data: categories
                }
            });
        setTimeout(function() {
            treeDom.on('changed.jstree', function(e, data) {
                    var node = data.instance.get_node(data.selected[0]);
                    req.c = node.id;
                    document.location = '/exam/category?' + $.param(req);
                });
        }, 1000);
    })();

})
