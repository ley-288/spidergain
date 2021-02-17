@if(auth()->user() && session()->has("admin_user_id") && session()->has("temp_user_id"))
    <div class="alert alert-warning logged-in-as">
        Sei loggato come  {{ auth()->user()->name }}. <a href="{{ route("frontend.auth.logout-as") }}">Loggati di nuovo come {{ session()->get("admin_user_name") }}</a>.
    </div><!--alert alert-warning logged-in-as-->
@endif
