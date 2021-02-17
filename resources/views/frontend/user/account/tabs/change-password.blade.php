@push('after-scripts')
<script src="{{url('/')}}/js/show-password.min.js" type="text/javascript"></script>
@endpush
{{ html()->form('PATCH', route('frontend.auth.password.update'))->class('form-horizontal')->open() }}
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.old_password'))->for('old_password') }}

            {{ html()->password('old_password')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
                    ->autofocus()
                    ->required() }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">

            {{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
            <div class="input-group">    
                <input placeholder="{{__('validation.attributes.frontend.password')}}" type="password" required name="password" id="password" class="form-control" data-toggle="password">   
                <div class="input-group-append">  
                    <span  class="input-group-text">                     
                        <i class="fa fa-eye"></i>
                    </span>
                </div>

            </div>
            <span class="form-text text-muted">{{__('auth.password_rules')}}</span>
        </div><!--form-group-->

    </div><!--col-->
</div><!--row-->

<div class="row">
    <div class="col">
        <div class="form-group">
            {{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
            <div class="input-group">    
                <input placeholder="{{__('validation.attributes.frontend.password_confirmation')}}" type="password" required name="password_confirmation" id="password_confirmation" class="form-control" data-toggle="password">   
                <div class="input-group-append">  
                    <span  class="input-group-text">                     
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
            {{ form_submit(__('labels.general.buttons.update') . ' ' . __('validation.attributes.frontend.password'))->class('btn btn-success') }}
        </div><!--form-group-->
    </div><!--col-->
</div><!--row-->
{{ html()->form()->close() }}
