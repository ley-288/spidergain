@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))
@push('after-scripts')
<script src="{{url('/')}}/js/show-password.min.js" type="text/javascript"></script>
@endpush
@section('content')
<div class="row justify-content-center align-items-center">


    <div class="col col-sm-6 align-self-center">

        <img class="mb-5 mt-5" src="{{asset('assets/media/logos/logo-rosso.png?v=3')}}" />
        <div class="card">
            <div class="card-header">
                <strong>
                    @lang('labels.frontend.passwords.reset_password_box_title')
                </strong>
            </div><!--card-header-->

            <div class="card-body">
                
                @if($errors->any())
                <div class="alert alert-danger">                                 
                    @foreach($errors->getMessages() as $this_error)
                    <p>{{$this_error[0]}}</p>
                    @endforeach
                </div>
                @endif 
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif

                {{ html()->form('POST', route('frontend.auth.password.reset'))->class('form-horizontal')->open() }}
                {{ html()->hidden('token', $token) }}

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

                            {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}

                            <div class="input-group">    
                                <input required placeholder="{{__('validation.attributes.frontend.password')}}" type="password" name="password" id="password" class="form-control" data-toggle="password">   
                                <div class="input-group-append">  
                                    <span class="input-group-text">                     
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                
                            </div>
 <span class="text-muted form-text">@lang('auth.password_rules')</span>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}

                                        <div class="input-group">    
                                <input required placeholder="{{__('validation.attributes.frontend.password')}}" type="password" name="password_confirmation" id="password_confirmation" class="form-control" data-toggle="password">   
                                <div class="input-group-append">  
                                    <span class="input-group-text">                     
                                        <i class="fa fa-eye"></i>
                                    </span>
                                    
                                </div>
                                
                            </div>
                                        
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->

                <div class="row">
                    <div class="col">
                        <div class="form-group mb-0 clearfix">
                            {{ form_submit(__('labels.frontend.passwords.reset_password_button'))->class('btn btn-lg btn-brand text-uppercase') }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                {{ html()->form()->close() }}
            </div><!-- card-body -->
        </div><!-- card -->
    </div><!-- col-6 -->
</div><!-- row -->
@endsection
