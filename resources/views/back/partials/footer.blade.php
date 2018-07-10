<!-- MESSAGE BOX-->
@if (Sentinel::check())
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn no-box-shadow btn-default btn-md">Yes</a>
                    <button class="btn btn-default btn-md no-box-shadow  mb-control-close">No</button>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<!-- END MESSAGE BOX-->
<!-- START PRELOADS -->
<audio id="audio-alert" src="{{url('/back_assets')}}/audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="{{url('/back_assets')}}/audio/fail.mp3" preload="auto"></audio>