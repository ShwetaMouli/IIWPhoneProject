$(function() {
    $('#searchid').autocomplete({
        source: function( request, response ) {
            $.ajax({
                url : 'live_search_results.php',
                dataType: "json",
                data: {
                   name_startsWith: request.term,
                   type: 'phone_model'
                },
                 success: function( data ) {
                     response( $.map( data, function( item ) {
                        return {
                            label: item.label,
                            icon: item.image,
                        }
                    }));
                }
            })  
        },
        autoFocus: false,
        minLength: 0  
    });
    $('#searchid').data( "ui-autocomplete" )._renderItem = function (ul, item) {
        var $img = $('<img>').attr({ src: item.icon, height:40, width:40 });
        return $('<li>').attr('data-value', item.label).append($img).append(item.label).appendTo(ul);    
    };
});
    