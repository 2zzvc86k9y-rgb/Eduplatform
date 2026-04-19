@extends('frontend.dashboard.user_dashboard')

@section('userdashboard')
<div class="setting-body">
    <div class="cat-btn-box mt-28px">
        <h3 class="pb-4 fs-17 font-weight-semi-bold">Chat en direct</h3>
        <div id="app">
            <chat-message></chat-message>
        </div>
    </div>
</div>
@endsection
