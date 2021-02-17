<div class="form-group row">
    
        <label class="col-xl-12 col-lg-12 col-form-label">@lang('applicazione.immagine')</label>
        <div class="col-lg-12 col-xl-12">
            <div class="kt-avatar kt-avatar--outline kt-avatar--circle-" id="kt_apps_user_add_avatar">

                @if(Auth::user()->avatar_location == '')
                <div id="img_holder" class="kt-avatar__holder" style="overflow: hidden; background-image: url('{{url('/img/frontend/placeholder.jpg')}}')">

                    

                </div>

                @else
                <div id="img_holder" class="kt-avatar__holder" style="overflow: hidden; background-image: url('{{asset('storage/'.Auth::user()->avatar_location)}}')">
                    
                </div>
                @endif

            </div>
             
        </div>

   
</div>

<div class="table-responsive">

    <table class="table table-striped table-hover table-bordered">

        <tr>
            <th>@lang('labels.frontend.user.profile.name')</th>
            <td>{{ $logged_in_user->name }}</td>
        </tr>
        <tr>
            <th>@lang('labels.frontend.user.profile.email')</th>
            <td>{{ $logged_in_user->email }} {{ $logged_in_user->role }}</td>

        </tr>
    </table>
</div>

<div class="form-group row ">
    <form id="cancella_profilo" action="{{route('frontend.user.utente.delete')}}" method="post">
        @csrf
        <a class="btn btn-sm btn-danger cancella_profilo" href="#" >@lang('applicazione.cancella_account')</a>
    </form>
</div>