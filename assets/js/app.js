const $ = jQuery

// $(document).ready(function() {
//     $('.load-more').click(function() {
//         console.log('Load more click')

//         $.post(ajaxurl, data, function(response) {
//             alert('Got this from the server: ' + response);
//         });
//     })
// })

jQuery(document).ready(function($) {
    $('.tag').click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: ajaxurl,
            data: {
                'action': 'post_filter_ajax_request',
                'term': $(this).data('term')
            },
            success: function(res) {
                $('.posts-output').html(res)
            }
        })
    })
});