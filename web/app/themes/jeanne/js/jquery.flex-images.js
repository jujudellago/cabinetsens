/*
    jQuery flexImages v1.0.4
    Copyright (c) 2014 Simon Steinberger / Pixabay
    GitHub: https://github.com/Pixabay/jQuery-flexImages
    License: MIT
*/
(function($){
    $.fn.flexImages = function(options){
        var o = $.extend({ container: '.item', object: 'img', rowHeight: 180, maxRows: 0, truncate: 0 }, options);
        return this.each(function(){
            var grid = $(this), containers = $(grid).find(o.container), items = [], t = new Date().getTime(),
                s = window.getComputedStyle ? getComputedStyle(containers[0], null) : containers[0].currentStyle;
                
            // START: CUSTOM
            o.margin = (parseInt(s.marginLeft) || 0) + (parseInt(s.marginRight) || 0) + (Math.round(parseFloat(s.borderLeftWidth)) || 0) + (Math.round(parseFloat(s.borderRightWidth)) || 0) + (parseInt(s.paddingLeft) || 0) + (parseInt(s.paddingRight) || 0);
            // END: CUSTOM
            
            // START: ORIGINAL
            //o.margin = (parseInt(s.marginLeft) || 0) + (parseInt(s.marginRight) || 0) + (Math.round(parseFloat(s.borderLeftWidth)) || 0) + (Math.round(parseFloat(s.borderRightWidth)) || 0);
            // END: ORIGINAL
            
            for (j=0;j<containers.length;j++) {
                var c = containers[j],
                    w = parseInt(c.getAttribute('data-w')),
                    norm_w = w*(o.rowHeight/parseInt(c.getAttribute('data-h'))), // normalized width
                    obj = $(c).find(o.object);
                items.push([c, w, norm_w, obj, obj.data('src')]);
            }
            makeGrid(grid, items, o);
            $(window).off('resize.flexImages'+grid.data('flex-t'));
            // CUSTOM: Commented out this line to prevent an unexpected grid row issue on iPad when swiping.
            //$(window).on('resize.flexImages'+t, function(){ makeGrid(grid, items, o); });
            grid.data('flex-t', t)
        });
    }

    function makeGrid(grid, items, o, noresize){
        var x, new_w, ratio = 1, rows = 1, max_w = grid.width()-2, row = [], row_width = 0, row_h = o.rowHeight;
        if (!max_w) max_w = grid.width()-2; // IE < 8 bug

        // define inside makeGrid to access variables in scope
        function _helper(lastRow){
            if (o.maxRows && rows > o.maxRows || o.truncate && lastRow && rows > 1) row[x][0].style.display = 'none';
            else {
                if (row[x][4]) { row[x][3].attr('src', row[x][4]); row[x][4] = ''; }
                
                // START: CUSTOM
                row[x][0].style.width = new_w+'px';
                row[x][0].style.height = row_h+'px';
                row[x][0].style.display = 'block';
                // END: CUSTOM
                
                // START: ORIGINAL
                /*
                row[x][0].style.width = new_w+'px';
                row[x][0].style.height = row_h+'px';
                row[x][0].style.display = 'block';
                */
                // END: ORIGINAL
                
            }
        }

        for (i=0; i<items.length; i++) {
            row.push(items[i]);
            row_width += items[i][2] + o.margin;
            
            // START: CUSTOM
            var lastElementClass = 'last-in-row',
                firstElementClass = 'first-in-row',
                rowNumberClass = 'item-row-' + rows,
                firstRowClass = 'first-row-item';
                
            $( items[i][0] ).removeClass( lastElementClass + ' ' + firstRowClass );
            
            if ( rows > 1 ) {
                firstRowClass = '';
            }
                
            // To remove "row-*" then add the revised one again
            $( items[i][0] ).removeClass( function (index, className) {
                return (className.match (/(^|\s)item-row-\S+/g) || []).join(' ');
            }).addClass( rowNumberClass + ' ' + firstRowClass ).attr( 'data-row', rows );
            // END: CUSTOM
            
            
            if (row_width >= max_w) {
                var margins_in_row = row.length * o.margin;
                ratio = (max_w-margins_in_row) / (row_width-margins_in_row), row_h = Math.ceil(o.rowHeight*ratio), exact_w = 0, new_w;
                for (x=0; x<row.length; x++) {
                    new_w = Math.ceil(row[x][2]*ratio);
                    exact_w += new_w + o.margin;
                    if (exact_w > max_w) new_w -= exact_w - max_w;
                    _helper();
                }
                
                // START: CUSTOM
                $( items[i][0] ).addClass( lastElementClass );
                //console.log( $( items[i][0] ) );
                // END: CUSTOM
                
                // reset for next row
                row = [], row_width = 0;
                rows++;
            }
            
        }
        // layout last row - match height of last row to previous row
        for (x=0; x<row.length; x++) {
            new_w = Math.floor(row[x][2]*ratio), h = Math.floor(o.rowHeight*ratio);
            _helper(true);
        }

        // scroll bars added or removed during rendering new layout?
        // CUSTOM: Commented out this line to prevent adding the last element class to the orphaned last element
        //if (!noresize && max_w != grid.width()) makeGrid(grid, items, o, true);
    }
}(jQuery));
