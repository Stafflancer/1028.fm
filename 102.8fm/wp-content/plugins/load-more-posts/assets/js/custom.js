
Date.prototype.yyyymmdd = function() {
  var mm = this.getMonth() + 1; // getMonth() is zero-based
  var dd = this.getDate();
  var h = this.getHours();
  var m = this.getMinutes();

  return (dd>9 ? '' : '0') + dd + '.' +
        (mm>9 ? '' : '0') + mm + '.' +
        this.getFullYear() + ', ' +
  		(h>9 ? '' : '0') + h + ':' +
  		(m>9 ? '' : '0') + m;
};


var postsDiv;


jQuery( function( $ ) {
	window.post_more_upload = function(){
		try{
			if (posts_block_id != undefined){
				postsDiv = $( posts_block_id ),
				_pages = null;
				$( '.load-more-prev-next' ).show();
				fetchItems();
			}
		}catch(e){}
	}

	function renderItems( data ) {
		//postsDiv.empty();

		$.each( data, function( i, item ) {

			const title = item.title.rendered;
			const link  = item.link;
			var str = '<div class="item news-list-item">';
				str += '<div class="news-item">';
					str += '<div class="name-new"><a href="'+link+'">'+title+'</a></div>';
					str += '<div class="excerpt">'+item.content.rendered.substring(0, 200)+'</div>';
					str += '<div class="date">'+new Date(item.date).yyyymmdd()+'</div>';
				str += '</div>';
			str += '</div>';
			postsDiv.append(str);
		} );
		
		$(document.body).ajaxify();

	}

	window.fetchItems = function() {
		
		if (category_id = $('[name="category_id"]').val()){
			datefilter = '';
			if ($('[name="load_news_from_date"]').val() == "1"){
				var date = $('.datepicker').val().split('.');
				date = date[2]+ '-' + date[1]+ '-' + date[0];
				console.log(date);
				datefilter = '&after='+date+'T00:00:00&before='+date+'T23:59:59';
				postsDiv.empty();
				page=1;
			}
			url = '/wp-json/wp/v2/posts?page='+page+'&categories=' + category_id + datefilter;
			$.getJSON( url, function ( data, st, xhr ) {

				if ($('[name="load_news_from_date"]').val() == "1"){
					_pages = xhr.getResponseHeader( 'X-WP-TotalPages' ) || 1;
					if (!data.length){
						var str = '<div class="item news-list-item">';
							str += '<div class="news-item">';
								str += '<div class="excerpt">За выбранную дату новости не найдены. Измените условия поиска.</div>';
							str += '</div>';
						str += '</div>';
						postsDiv.append(str);
					}
				}else
					_pages = _pages || xhr.getResponseHeader( 'X-WP-TotalPages' ) || 1;
					
				if (page < _pages){
					page++;
					$('.load-more-prev-next .btn-load-more-next').removeAttr('disabled');
				}else
					$('.load-more-prev-next .btn-load-more-next').hide();

				renderItems( data || [] );
				setDurationTracks();
			} );
		}else if (podcast_id = $('[name="podcast_id"]').val()){
			data = {
				"action": "tve_get_records", 
				"pages": page, 
				"podcast_id": podcast_id
			};
			$.post( '/wp-admin/admin-ajax.php', data, function ( data, st, xhr ) {

				_pages = _pages || xhr.getResponseHeader( 'X-WP-TotalPages' ) || 1;
				if (page < _pages){
					page++;
					$('.load-more-prev-next .btn-load-more-next').removeAttr('disabled');
				}else
					$('.load-more-prev-next .btn-load-more-next').hide();

				postsDiv.append(data.html);
				$(document.body).ajaxify();
				setDurationTracks();
			}, 'json' );
		}

	}

	$( 'body' ).on( 'click', '.load-more-prev-next .btn-load-more-next', function () {
		this.disabled = true;
		fetchItems();
	} );
	
	
	post_more_upload();
	
} );
