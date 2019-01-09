<div id="mymodal" class = "modal fade" style="margin-top: 80px;">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <a href="#" class = "close" data-dismiss = "modal">&times;</a>
                <h3 class="modal-title text-center">Please Login to Continue!</h3>
            </div>

            <div class="modal-body">
                <form class="form" action = "{!! url('/authenticate') !!}">
                    <div class="form-group">

                        <label class="qrcode-text-btn bg-primary">
                            Scan Qr-Code
                            {{--<button class="btn btn-primary btn-block" onclick = "return false;">Scan QR Code</button>--}}
                            <input type="file" accept="image/*" capture="environment"  onchange="openQRCamera(this);" tabindex="-1">
                        </label>

                        <div class="or">
                            <span class="or-text">OR</span>
                            <hr class = "or-divider">
                        </div>

                        <input type="text" class = 'form-control qrcode-text' id = "text" placeholder="Enter Scanned QR Code">

                    </div>

                    <div class="message">
                            <div class="loading-message display-none">
                                <div class="loading">
                                    <p><strong class="loading-text">Please Wait While Processing...</strong></p>
                                    <img src="{!! asset('svg/loading.svg') !!}" alt="Loading..." class = "loading-svg">
                                </div>
                            </div>

                            <p class = "error-message" style = "font-style: italic; color: red;text-align:center;"></p>
                        </div>

                </form>
            </div>

            <div class="modal-footer">
                <button class = "btn btn-default" data-dismiss = "modal">Close</button>
            </div>
        </div>
    </div>

    <script>
        function openQRCamera(node) {
            var reader = new FileReader();

            reader.onload = function() {

                node.value = "";
                qrcode.callback = function(res) {
                    if(res instanceof Error) {
                        alert("No QR code found. Please make sure the QR code is within the camera's frame and try again.");
                    } else {
                        $('.qrcode-text').val(res);
                        // node.parentNode.previousElementSibling.value = res;
                    }
            };

            qrcode.decode(reader.result);

            };

            reader.readAsDataURL(node.files[0]);
        }

    </script>
</div>

