<style>

@media screen and (max-width: 1024px) {	
	
	#kt_footer{
	display:none;
	}
}


</style>

</div>
	</div>

	<!-- begin:: Footer -->
		<div class="kt-footer kt-grid__item" id="kt_footer">
						<div class="kt-container">
							<div class="kt-footer__wrapper">
								<div class="kt-footer__copyright">
									2021&nbsp;&copy;&nbsp;<a href="#" target="_blank" class="kt-link">SpiderGain</a>
								</div>
								<div class="kt-footer__menu">
									<a href="{{route('frontend.privacy')}}" class="kt-link">Privacy</a>
                                                                          <a href="{{route('frontend.termini')}}" class="kt-link">{{__('applicazione.termini')}}</a>
								</div>
							</div>
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->


		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>

		<!-- end::Scrolltop -->


		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"light": "#ffffff",
						"dark": "#282a3c",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
						"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
					}
				}
			};
		</script>

		<!-- end::Global Config -->


@if(config('analytics.google-analytics') && config('analytics.google-analytics') !== 'UA-XXXXX-X')
    {{-- Google Analytics: change UA-XXXXX-X to be your site's ID. --}}
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','{{ config('analytics.google-analytics') }}','auto');ga('send','pageview');
    </script>
@endif
