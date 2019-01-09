@extends('Master.template')

@section('body')

    <div class="container-fluid">
        <div class="row">
            @include('Master.navbar')
        </div>
    </div>


    <div class="container" id = "king-queen-selection">
        <!-- including fresher king field -->
        @if(isset($data))
           @include($data['view_name'])
        @endif

        <!-- only include modal if the user is not logged in -->
        @if(\Illuminate\Support\Facades\Session::get('status') !== "logged_in")
            @include('modal')
        @else
            <script>
                //only load when all the jquery files are being loaded
                document.body.onload = function() {
                    //placeholder for section like #fresher-king-selection, #fresher-queen-selection
                    let section,
                        //contestant_type like fresher-king, fresher-queen
                        type,
                        ajaxRequestURI = window.location.origin + "/UCSMV/public/index.php",
                        buttons = document.getElementsByTagName('button'),
                        NumberOfBtn = buttons.length,
                        contestantId,
                        buttonId,
                        url,
                        @if($user_id  = \Illuminate\Support\Facades\Session::get('user_id'))
                            //this will store current login user-id
                            userId = "<?= $user_id ?>";
                        @endif

                    //attach event that will show "Are you sure..." alert when the user is logged in and make an ajax request to store to the database
                    for(let i = 0; i < NumberOfBtn; i++) {
                        buttons[i].onclick = function () {
                            contestantId = $(this).attr('id');

                            url = ajaxRequestURI + '/ajaxDatabaseUpdateRequest/' + userId + '/' + contestantId;

                            if (confirm("Are You Sure You Want to Vote For This Contestant")) {
                                ajaxDatabaseUpdateRequest(url, function () {
                                    window.location.reload();
                                });
                            }

                        };
                    }

                    //when the ajaxDatabaseUpdateRequest() function is called it will get clicked contestant id
                    //by this id we will know the contestant type and remove all the button from those contestant types
                    @foreach(\Illuminate\Support\Facades\Session::get('contestant_types') as $contestant_type)
                        type = "<?= $contestant_type?>";
                        section = '#' + type + "-selection button";
                        $(section).addClass('display-none');
                    @endforeach

                    //giving feedback to the user to which contestant they just voted
                    @foreach(\Illuminate\Support\Facades\Session::get('contestant_ids') as $button_id)
                        buttonId = "<?= $button_id?>";
                        $('#' + buttonId).parent().append('<p class ="alert alert-success text-center" style="font-size:1.2em;">Thank You For Voting & You Voted This Contestant !!!</p>')
                    @endforeach
                }
            </script>
        @endif
    </div>

@endsection


