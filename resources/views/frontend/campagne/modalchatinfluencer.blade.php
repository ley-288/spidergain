<div class="modal fade chats" data-influencer="{{Auth::user()->uuid}}" id="messaggi_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{__('applicazione.messaggi')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
         
                <div class="modal-body">
                  @include('frontend.campagne.chat_influencer')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('applicazione.chiudi')}}</button>
                    
                </div>
                
            </form>
        </div>
    </div>
</div>