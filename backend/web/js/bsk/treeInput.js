$(function() {
    setTimeout(replaceChangeHandle, 500);


    // 替换有tree-leaf标记的treeViewInput控件选择方法，仅能选择叶子节点
    // 因treeView事件生效需要时间，因此要延迟触发
    function replaceChangeHandle() {
        $('[data-tree-leaf]')
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
                input.val(vkey.join(','));
                d.setInput(vdesc);
            });
    }
});
