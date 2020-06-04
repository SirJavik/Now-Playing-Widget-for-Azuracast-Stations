(function ($) {
    function do_async_task() {
        if(AzuraCastParams['do_async']==="1") {
            $.ajax({
                url: AzuraCastAsyncFile,
                cache: false,
                data: {
                    'instance': AzuraCastParams['azuracast_instanz'],
                    'shortcode': AzuraCastParams['shortcode'],
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
        if(AzuraCastParams["use_websocket"] == "1") {
            let opt = {
                subscriber: "websocket",
                reconnect: "session",
            };

            let azuraCastURL = AzuraCastParams['azuracast_instanz'] + "/api/live/nowplaying/" + AzuraCastParams['shortcode'];

            let sub = new NchanSubscriber(azuraCastURL, opt);
            console.log(sub);

            sub.on("message", function (message, message_metadata) {
                console.log("[AzuraCast Widget] Message received.");
                let nowPlaying = JSON.parse(message);
                let currentSong = nowPlaying["now_playing"]["song"];

                if (AzuraCastParams["show_cover"] == "1") {
                    let cover = $("#acnp_cover");

                    cover.attr("src", currentSong["art"]);
                }

                if (AzuraCastParams["show_artist"] == "1") {
                    let artist = $("#acnp_api_artist");
                    artist.html(currentSong["artist"]);
                }

                if (AzuraCastParams["show_track"] == "1") {
                    let title = $("#acnp_api_title");
                    title.html(currentSong["title"]);
                }

                if (AzuraCastParams["show_album"] == "1") {
                    let album = $("#acnp_api_album");
                    album.html(currentSong["album"]);
                }
            });

            sub.on('connect', function (evt) {
                console.log("[AzuraCast Widget] Connected.")
            });

            sub.on('disconnect', function (evt) {
                console.log("[AzuraCast Widget] Disconnected.")
            });

            sub.on('error', function (code, message) {
                console.log("[AzuraCast Widget] Error " + code + ": " + message)
            });
            sub.start();
        } else {
            setInterval(function(){
                do_async_task();
            }, 500*60);
        }
    })

})(jQuery);