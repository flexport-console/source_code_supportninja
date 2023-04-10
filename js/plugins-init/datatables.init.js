(function($) {
    "use strict"

    //workflow
    var table2 = $('#workflow, #sop').DataTable( {
        createdRow: function ( row, data, index ) {
            $(row).addClass('selected')
        },

        "scrollY":        "42vh",
        "scrollCollapse": true,
        "paging":         false
    });

    table2.on('click', 'tbody tr', function() {
        var $row = table2.row(this).nodes().to$();
        var hasClass = $row.hasClass('selected');
        if (hasClass) {
            $row.removeClass('selected')
        } else {
            $row.addClass('selected')
        }
    })
        
    table2.rows().every(function() {
        this.nodes().to$().removeClass('selected')
    });

    // SOP
    // var table3 = $('#sop').DataTable( {
    //     createdRow: function ( row, data, index ) {
    //         $(row).addClass('selected')
    //     },

    //     "scrollY":        "42vh",
    //     "scrollCollapse": true,
    //     "paging":         false
    // });

    // table3.on('click', 'tbody tr', function() {
    //     var $row = table3.row(this).nodes().to$();
    //     var hasClass = $row.hasClass('selected');
    //     if (hasClass) {
    //         $row.removeClass('selected')
    //     } else {
    //         $row.addClass('selected')
    //     }
    // })
        
    // table3.rows().every(function() {
    //     this.nodes().to$().removeClass('selected')
    // });





   
})(jQuery);