<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <style id="" media="all">
        /* devanagari */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJbecmNE.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJnecmNE.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiEyp8kv8JHgFVrJJfecg.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* devanagari */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiByp8kv8JHgFVrLDD4Z11lFc-K.woff2) format('woff2');
            unicode-range: U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiByp8kv8JHgFVrLDD4Z1JlFc-K.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: 800;
            src: url(/fonts.gstatic.com/s/poppins/v15/pxiByp8kv8JHgFVrLDD4Z1xlFQ.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

    </style>
    <link href="{{asset('/')}}css/main.css" rel="stylesheet" />
    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div class="s004">
        <form>
            <fieldset>
                <legend>Find Your Cheapest Price </legend>
                <div class="inner-form">
                     <div class="input-field">
                        <input class="form-control" id="choices-text-preset-values" type="text"
                            placeholder="Type to search..." />
                        <a class="btn-search" href="/products">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </a >
                    </form>
                </div>
                <div class="suggestion-wrap">
                    <span>New Arrivals</span>
                    <span>Ladies</span>
                    <span>Mens</span>
                    <span>Accessories</span>
                    <span>Sale</span>
                </div>
            </fieldset>
        </form>
    </div>
    <script src="{{asset('/')}}/js/extention/choices.js"></script>
    <script>
        var textPresetVal = new Choices('#choices-text-preset-values', {
            removeItemButton: true,
        });
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js"
        data-cf-beacon='{"rayId":"67fba67f7dfc4cbf","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.8.0","si":10}'>
    </script>
</body>

</html>
