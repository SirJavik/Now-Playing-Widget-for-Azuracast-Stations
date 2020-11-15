(function ($) {
    $(document).ready(function () {
        let opt = {
            subscriber: "websocket",
            reconnect: "session",
        };

        let azuraCastURL = AzuraCastParams['azuracast_instanz'] + "/api/live/nowplaying/" + AzuraCastParams['shortcode'];

        let sub = new NchanSubscriber(azuraCastURL, opt);
        console.log(sub);

        sub.on("message", function (message, message_metadata) {
            if(AzuraCastParams["debug"] == true)
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
            if(AzuraCastParams["debug"] == true)
                console.log("[AzuraCast Widget] Connected.")
        });

        sub.on('disconnect', function (evt) {
            if(AzuraCastParams["debug"] == true)
                console.log("[AzuraCast Widget] Disconnected.")
        });

        sub.on('error', function (code, message) {
            if(AzuraCastParams["debug"] == true)
                console.log("[AzuraCast Widget] Error " + code + ": " + message)
        });
        sub.start();

    })

})(jQuery);