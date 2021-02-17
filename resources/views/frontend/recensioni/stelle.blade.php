{{--

  <style type="text/css">
    .rating-stars a {
      display: inline-block;
      width: 64px;
      height: 64px;
      background-repeat: no-repeat;
      background-image: 
      url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IgogICB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDY0IDY0IiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSJub25lIiBzdHJva2U9IiNBN0E5QUMiIHN0cm9rZS13aWR0aD0iNCIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjMxLjg2Niw2LjYxOCA0MC4wOSwyMy4yODEgNTguNDc5LDI1Ljk1MyA0NS4xNzIsMzguOTIzIDQ4LjMxMyw1Ny4yMzkgMzEuODY2LDQ4LjU5MiAxNS40MTgsNTcuMjM5IDE4LjU2LDM4LjkyMyA1LjI1MywyNS45NTMgMjMuNjQyLDIzLjI4MSAiLz48L3N2Zz4=");
      outline: none;
    }
    .rating-stars a.hover {
   
      background-image: url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeD0iMHB4IiB5PSIwcHgiCiAgIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNjQgNjQiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxwb2x5Z29uIGZpbGw9IiM1MUFFQ0QiIHN0cm9rZT0iIzUxQUVDRCIgc3Ryb2tlLXdpZHRoPSI0IiBzdHJva2UtbWl0ZXJsaW1pdD0iMTAiIHBvaW50cz0iMzEuODY2LDYuNjE4IDQwLjA5LDIzLjI4MSA1OC40NzksMjUuOTUzIDQ1LjE3MiwzOC45MjMgNDguMzEzLDU3LjIzOSAzMS44NjYsNDguNTkyIDE1LjQxOCw1Ny4yMzkgMTguNTYsMzguOTIzIDUuMjUzLDI1Ljk1MyAyMy42NDIsMjMuMjgxICIvPjwvc3ZnPgo=");
    }
    .rating-stars a.selected { 
   
      background-image: url("data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4IgogICB3aWR0aD0iNjRweCIgaGVpZ2h0PSI2NHB4IiB2aWV3Qm94PSIwIDAgNjQgNjQiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDY0IDY0IiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkVDMjBGIiBzdHJva2U9IiNGRUMyMEYiIHN0cm9rZS13aWR0aD0iNCIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjMxLjg2Niw2LjYxOCA0MC4wOSwyMy4yODEgNTguNDc5LDI1Ljk1MyA0NS4xNzIsMzguOTIzIDQ4LjMxMyw1Ny4yMzkgMzEuODY2LDQ4LjU5MiAxNS40MTgsNTcuMjM5IDE4LjU2LDM4LjkyMyA1LjI1MywyNS45NTMgMjMuNjQyLDIzLjI4MSAiLz48L3N2Zz4=");
    }
</style>
</head>
<body>

  <div class="rating-stars">
    <a href="" data-rating="1"></a><a href="" data-rating="2"></a><a href="" data-rating="3"></a><a href=""  data-rating="4"></a><a href="" data-rating="5"></a>
  </div>

<script>
function ready(fn) {
  if(document.readyState != 'loading') {
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

var selectedRating = 0;

ready(function(){

  function addClass(el, className) {
    if(typeof el.length == "number") {
      Array.prototype.forEach.call(el, function(e,i){ addClass(e, className) });
      return;
    }
    if (el.classList)
      el.classList.add(className);
    else
      el.className += ' ' + className;    
  }
  function removeClass(el, className) {
    if(typeof el.length == "number") {
      Array.prototype.forEach.call(el, function(e,i){ removeClass(e, className) });
      return;
    }
    if (el.classList)
      el.classList.remove(className);
    else if(el.className)
      el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
  }

  var stars = document.querySelectorAll(".rating-stars a");
  Array.prototype.forEach.call(stars, function(el, i){
    el.addEventListener("mouseover", function(evt){
      removeClass(stars, "selected");
      // For each star up to the highlighted one, add "hover"
      var to = parseInt(evt.target.getAttribute("data-rating"));
      Array.prototype.forEach.call(stars, function(star, i) {
        if(parseInt(star.getAttribute("data-rating")) <= to) {
          addClass(star, "hover");
        }
      });
    });
    el.addEventListener("mouseout", function(evt){
      removeClass(evt.target, "hover");
    });
    el.addEventListener("click", function(evt){
      selectedRating = parseInt(evt.target.getAttribute("data-rating"));
      removeClass(stars, "hover");
      Array.prototype.forEach.call(stars, function(star, i) {
        if(parseInt(star.getAttribute("data-rating")) <= selectedRating) {
          addClass(star, "selected");
        }
      });      
      evt.preventDefault();
    });
  });
  document.querySelector(".rating-stars").addEventListener("mouseout", function(evt){
    // When the cursor leaves the whole rating star area, remove the "hover" class and apply 
    // the "selected" class to the number of stars selected.
    removeClass(stars, "hover");
    if(selectedRating) {
      Array.prototype.forEach.call(stars, function(star, i) {
        if(parseInt(star.getAttribute("data-rating")) <= selectedRating) {
          addClass(star, "selected");
        }
      });      
    }
  });
  
});
</script>

--}}














@for($i = 0; $i<(int)$voto; $i++)
	<img alt="Logo" width="16px" style="margin-left:3px;" src="{{url('/')}}/assets/media/icons/star.png" />
@endfor


@if(($voto - (int)$voto )>0)
	<img alt="Logo" width="16px" style="margin-left:3px;" src="{{url('/')}}/assets/media/icons/star.png" />
@endif


@for($i = 0; $i<(5-ceil($voto)); $i++)
	<img alt="Logo" width="16px" style="margin-left:3px;" src="{{url('/')}}/assets/media/icons/star-outline.png" />
@endfor




{{--@for($i = 0; $i<(int)$voto; $i++)
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" id="Star" fill="#000000" ></path>
    </g>
</svg>
@endfor
@if(($voto - (int)$voto )>0)
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"/>
        <path d="M12,4.25932872 C12.1488635,4.25921584 12.3000368,4.29247316 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 L12,4.25932872 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
        <path d="M12,4.25932872 L12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.277344,4.464261 11.6315987,4.25960807 12,4.25932872 Z" id="Combined-Shape" fill="#000000"/>
    </g>
</svg>
@endif
@for($i = 0; $i<(5-ceil($voto)); $i++)
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
        <path d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z" id="Star" fill="#000000" opacity="0.3"></path>
    </g>
</svg>
@endfor--}}