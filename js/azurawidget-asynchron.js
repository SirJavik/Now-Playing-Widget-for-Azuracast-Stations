( function( $ ) {
    function do_async_task() {
        if(AzuraCastParams['do_async']==="1") {
            $.ajax({
                url: AzuraCastAsyncFile,
                cache: false,
                data: {
                    'instance': AzuraCastParams['azuracast_instanz'],
                    'stationid': AzuraCastParams['station_id'],
                    'options': {
                        'show_cover': AzuraCastParams['show_cover'],
                        'show_track': AzuraCastParams['show_track'],
                        'show_artist': AzuraCastParams['show_artist'],
                        'show_album': AzuraCastParams['show_album']
                    }

                },
                timeout: 2000,
                type: 'POST',
                success: function (result) {
                    if (AzuraCastParams['show_track']) {
                        $('#acnp_api_title').html(result['title']);
                    }

                    if (AzuraCastParams['show_artist']) {
                        $('#acnp_api_artist').html(result['artist']);
                    }

                    if (AzuraCastParams['show_album']) {
                        $('#acnp_api_album').html(result['album']);
                    }

                    if (AzuraCastParams['show_cover']) {
                        $('#acnp_api_img').attr({"src": result['art']});
                    }
                }
            });
        }
    }

    $(document).ready(function() {
        setInterval(function(){
            do_async_task();
        }, AzuraCastParams['async_timer']*1000*60);
    })


} )( jQuery );