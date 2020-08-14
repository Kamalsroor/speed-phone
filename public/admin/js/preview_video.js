$(function() {
    // path = "https://www.youtube.com/watch?v=dbsPPQhHMF8";
    $(".input-video-path-preview").on("blur", function() {
        let pattern = /\?v=([\w-]+)(\&t=(\d+))?/,
            val = $(this).val(),
            matches = pattern.exec(val),
            wrapperPreview = $(".preview-video-youtube");
        if (matches != null && matches.length > 1) {
            let srcVideo = matches[1],
                start =
                    matches.length > 3 && matches[3] != "undefined"
                        ? "?start=" + matches[3]
                        : "";
            wrapperPreview.html(`
                <div class="preview">
                    <iframe
                        width="500"
                        height="300"
                        src="https://www.youtube-nocookie.com/embed/${srcVideo +
                            start}"
                        frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            `);
        } else {
            wrapperPreview.html("");
        }
    });
});
