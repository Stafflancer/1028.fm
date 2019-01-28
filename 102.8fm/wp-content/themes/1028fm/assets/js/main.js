	// Change color for range
	// Ready
	function changeColorRangeReady(selector, startColor, endColor) {
		$(document).ready(function() {
			$(selector).each(function() {
			var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
		    
		    $(this).css('background-image',
	        '-webkit-gradient(linear, left top, right top, '
	       	+ 'color-stop(' + val + ',' + startColor + '), '
	        + 'color-stop(' + val + ',' + endColor + ')'
	        + ')'
	        );
			});
		});
	}
	// Click
	function changeColorRange(selector, startColor, endColor) {
		$(selector).change(function () {
	    var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
	    
	    $(this).css('background-image',
	      '-webkit-gradient(linear, left top, right top, '
	      + 'color-stop(' + val + ',' + startColor + '), '
	      + 'color-stop(' + val + ',' + endColor + ')'
	      + ')'
	      );
		});
	}
	// Run
	function changeColorRangeRun(selector, startColor, endColor) {
		setInterval(function() {
			$(selector).each(function() {
		    var val = ($(this).val() - $(this).attr('min')) / ($(this).attr('max') - $(this).attr('min'));
		    
		    $(this).css('background-image',
		      '-webkit-gradient(linear, left top, right top, '
		      + 'color-stop(' + val + ',' + startColor + '), '
		      + 'color-stop(' + val + ',' + endColor + ')'
		      + ')'
		      );
			});
		}, 500);
	}
	// For FRONT
	changeColorRangeReady('.page-template-front-page .small-player input[type="range"]', '#fff', '#e48686');
	changeColorRange('.page-template-front-page .small-player input[type="range"]', '#fff', '#e48686');
	changeColorRangeRun('.page-template-front-page .small-player input[type="range"]', '#fff', '#e48686');
	// For PODCASTS
	changeColorRangeReady('.traks .player-static .tracklist-player input[type="range"]', '#fff', '#888181');
	changeColorRange('.traks .player-static .tracklist-player input[type="range"]', '#fff', '#888181');
	changeColorRangeRun('.traks .player-static .tracklist-player input[type="range"]', '#fff', '#888181');
	// For HEADER
	changeColorRangeReady('.header .navs input[type="range"]', '#fff', '#e89e9e');
	changeColorRange('.header .navs input[type="range"]', '#fff', '#e89e9e');
	// changeColorRangeRun('.header .navs input[type="range"]', '#fff', '#e89e9e');


// Handles the page being scrolled by ensuring the navigation is always in view.
function handleScroll(){
  // check that this is a relatively modern browser
  if (window.XMLHttpRequest){
    // determine the distance scrolled down the page
    var offset = window.pageYOffset
               ? window.pageYOffset
               : document.documentElement.scrollTop;
    // set the appropriate class on the navigation
    document.getElementById('sticky-header').className =
        (offset > 250 ? 'sticky' : '');
  }
}
// add the scroll event listener
if (window.addEventListener){
  window.addEventListener('scroll', handleScroll, false);
}else{
  window.attachEvent('onscroll', handleScroll);
}


/** CLOSE MAIN NAVIGATION WHEN CLICKING OUTSIDE THE MAIN NAVIGATION AREA**/
jQuery(document).ready(function () {
    jQuery(document).click(function (event) {
        var clickover = jQuery(event.target);
        var _opened = jQuery(".navbar-collapse").hasClass("show");
        if (_opened === true && !clickover.hasClass("navbar-toggle") && clickover.parents('.navbar-collapse').length == 0) {
            jQuery("button.navbar-toggler").click();
            jQuery('.animated-icon').removeClass('open');
        }
    });
});



function createFilterSelect(){
	var x, i, j, selElmnt, a, b, c;
	/*look for any elements with the class "filter-select":*/
	x = document.getElementsByClassName("filter-select");
	for (i = 0; i < x.length; i++) {
	  selElmnt = x[i].getElementsByTagName("select")[0];
	  /*for each element, create a new DIV that will act as the selected item:*/
	  a = document.createElement("DIV");
	  a.setAttribute("class", "select-selected");
	  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
	  x[i].appendChild(a);
	  /*for each element, create a new DIV that will contain the option list:*/
	  b = document.createElement("DIV");
	  b.setAttribute("class", "select-items select-hide");
	  for (j = 1; j < selElmnt.length; j++) {
		/*for each option in the original select element,
		create a new DIV that will act as an option item:*/
		c = document.createElement("DIV");
		c.innerHTML = selElmnt.options[j].innerHTML;
		c.addEventListener("click", function(e) {
			/*when an item is clicked, update the original select box,
			and the selected item:*/
			var y, i, k, s, h;
			s = this.parentNode.parentNode.getElementsByTagName("select")[0];
			h = this.parentNode.previousSibling;
			for (i = 0; i < s.length; i++) {
			  if (s.options[i].innerHTML == this.innerHTML) {
				s.selectedIndex = i;
				h.innerHTML = this.innerHTML;
				y = this.parentNode.getElementsByClassName("same-as-selected");
				for (k = 0; k < y.length; k++) {
				  y[k].removeAttribute("class");
				}
				this.setAttribute("class", "same-as-selected");
				break;
			  }
			}
			h.click();
		});
		b.appendChild(c);
	  }
	  x[i].appendChild(b);
	  a.addEventListener("click", function(e) {
		  /*when the select box is clicked, close any other select boxes,
		  and open/close the current select box:*/
		  e.stopPropagation();
		  closeAllSelect(this);
		  this.nextSibling.classList.toggle("select-hide");
		  this.classList.toggle("select-arrow-active");
	  });
	}
}
createFilterSelect();
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);


// управление плеером
jQuery(function($){
	var player = document.getElementById('music'); // id for audio element
	var duration; // Duration of audio clip
	btnPlayPause = $('#btnPlayPause');
	btnMute      = $('#btnMute');
	btnMute1     = $('#btnMute');
	progressBar  = $('#progress-bar');
	volumeBar    = $('#volume-bar');
	source       = $('#audioSource');
	
	
	volumeBar.change(function(evt) {
		player.volume = parseInt($(this).val()) / 10;
		//$('.volume-bar').val($(this).val());
	});
	player.addEventListener('timeupdate', function(){
		progressBar.val( Math.floor((100 / player.duration) * player.currentTime));
	}, false);

	player.addEventListener('ended', function() { 
		this.pause(); 
		this.currentTime = 0;
		progressBar.val(0);
		$.each($('.song-source'), function(){
			if ($(this).data('track') == player.src){
				btn = $(this).parents('.audio_player').find('.btnPlayPause');
				changeButtonType(btn, 'play');
			}
		});
		
	}, false);	

	
	
	// Stop the current media from playing, and return it to the start position
	function stopAudio() {
		player.pause();
		if (player.currentTime) player.currentTime = 0;
	}

	// Toggles the media player's mute and unmute status
	btnMute.click(function() {
		if (player.muted) {
			// Change the button to a mute button
			changeButtonType(btnMute, 'mute');
			player.muted = false;
		}
		else {
			// Change the button to an unmute button
			changeButtonType(btnMute, 'unmute');
			player.muted = true;
		}
	});

	// Updates a button's title, innerHTML and CSS class
	function changeButtonType(btn, value) {
		btn.attr('title', value);
		btn.removeClass('play pause mute unmute');
		btn.addClass(value);
	}
	
	
	
	$('body').on('click', '.track-list-item .play, .track-list-item .pause', function(){
		
		if ($(this).parents('.audio_player').find('.song-source').length){
			if (player.src != $(this).parents('.audio_player').find('.song-source').data('track')){
				$('.track-list-item .pause').removeClass('pause').addClass('play');
				player.pause();
				player.src = $(this).parents('.audio_player').find('.song-source').data('track');
				if (player.src != $(this).parents('.audio_player').find('.song-source').data('track')) // костыль для кирилицы в названии файла
					$(this).parents('.audio_player').find('.song-source').data('track', player.src);
				player.play();
				changeButtonType($(this), 'pause');
			}else{
				if (player.paused || player.ended) {
					// Change the button to a pause button
					changeButtonType($(this), 'pause');
					player.play();
				}
				else {
					// Change the button to a play button
					changeButtonType($(this), 'play');
					player.pause();
				}
			}
		}else{
			if (player.src != $(this).next().data('track')){
				$('.track-list-item .pause').removeClass('pause').addClass('play');
				player.pause();
				player.src = $(this).next().data('track');
				if (player.src != $(this).next().data('track')) // костыль для кирилицы в названии файла
					$(this).next().data('track', player.src);
				player.play();
				changeButtonType($(this), 'pause');
			}else{
				if (player.paused || player.ended) {
					// Change the button to a pause button
					changeButtonType($(this), 'pause');
					player.play();
				}
				else {
					// Change the button to a play button
					changeButtonType($(this), 'play');
					player.pause();
				}
			}
		}
		changeButtonType($(btnPlayPause), 'play');
		$('.progressBar').val(0);
		progressBar = $(this).parents('.item').find('.progressBar');
		$(progressBar).click(function(){
			player.currentTime = player.duration * $(progressBar).val() / 100;
		});
		volumeBar = $(this).parents('.item').find('.volume-bar');
		volumeBar.change(function(evt) {
			player.volume = parseInt($(volumeBar).val()) / 10;
			//$('.volume-bar, #volume-bar').val($(volumeBar).val());
		});
		btnMute1 = $(this).parents('.item').find('.mute');
		btnMute1.click(function() {
			if (player.muted) {
				changeButtonType($(this), 'mute');
				player.muted = false;
			}
			else {
				changeButtonType($(this), 'unmute');
				player.muted = true;
			}
		});
		
		
	});
	
	btnPlayPause.click(function(){
		if (player.src != $('#song-source').data('track')){
			player.pause();
			player.src = $('#song-source').data('track');
			player.play();
			changeButtonType($(this), 'pause');
			changeButtonType($('.track-list-item .pause'), 'play');
		}else{
			if (player.paused || player.ended) {
				// Change the button to a pause button
				changeButtonType($(this), 'pause');
				player.play();
			}
			else {
				// Change the button to a play button
				changeButtonType($(this), 'play');
				player.pause();
			}
		}
	});
	
	function getDuration(ths) {
		var audio = new Audio();
		$(audio).on("loadedmetadata", function(){
			var s = parseInt(audio.duration),
				m = '';
			if (s > 60){
				m = Math.floor(s/60);
				s = s - m * 60;
			}
			$(ths).find('.timetrack').html((m? m+':' : '0:') + (s<10? '0' : '') + s);
			$(ths).parents('.track-list-item').find('.disable-song').remove();
		});
		audio.src = $(ths).data('track');
	}
	
	window.setDurationTracks = function(){
		$.each($('.track-item'), function(){
			if (!$(this).find('.timetrack').html()){
				getDuration($(this));
			}
		});
	}
	setDurationTracks();
	
	/*
	function tve_radio(){
		// news
		if ($('.radio-news-in-hour').length){
			if (player.paused || player.ended){
				jQuery.get( '/wp-admin/admin-ajax.php', {action: 'tve_get_last_news'}, function(d) {
					if (d.status == 'success'){
						if ($('.radio-news-in-hour .song-source').data('track') != d.file){
							$('.radio-news-in-hour .song-source').data('track', d.file);
							$('.radio-news-in-hour .post-date').html('обновлено ' + d.date);
						}
					}
				}, 'json');
			}
		}

		// road
		if ($('.radio-road-in-hour').length){
			if (player.paused || player.ended){
				jQuery.get( '/wp-admin/admin-ajax.php', {action: 'tve_get_last_road'}, function(d) {
					if (d.status == 'success'){
						if ($('.radio-road-in-hour .song-source').data('track') != d.file){
							$('.radio-road-in-hour .song-source').data('track', d.file);
							$('.radio-road-in-hour .post-date').html('обновлено ' + d.date);
						}
					}
				}, 'json');
			}
		}
	}
	//tve_radio(); // обовление при загрузке страницы
	//setInterval(tve_radio, 120000); // каждые 120 сек или 120/60=2мин
	setInterval(tve_radio, 60000);
	tve_radio();
	*/
	window.player_stop = function(){
		if (!player.paused && !player.ended)
			if (player.src != $('#song-source').data('track')){
				player.pause();
				changeButtonType($('.track-list-item .play'), 'pause');
			}
				
	}
	
});



