jQuery.fn.exists = function(callback) {
	var args = [].slice.call(arguments, 1);
	if (this.length) {
		callback.call(this, args);
	}
	return this;
};

(function($) {

	var makanewsLite = {
		initAll: function() {
			this.scrollTop();
			this.toggledMenu();
			this.searchShow();
			this.stickyMenu();
			this.socialSharer();
			this.loadSocialScript(document, 'script');
			if (typeof loadStyle != 'undefined') {
				if (loadStyle === 'infinite') {
					this.infiniteScroll();
				} else {
					this.infiniteLoading();	
				}
			}
		},
		stickyMenu: function() {
			var self = this;

			var catcher = $('#catcher'),
				sticky  = $('#sticky'),
				bodyTop = $('body').offset().top;

			if ( sticky.length ) {
				$(window).scroll(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
				$(window).resize(function() {
					self.stickThatMenu(sticky,catcher,bodyTop);
				});
			}
		},
		isScrolledTo: function(elem,top) {
			var docViewTop = $(window).scrollTop();
			var docViewBottom = docViewTop + $(window).height();

			var elemTop = $(elem).offset().top - top;
			var elemBottom = elemTop + $(elem).height();

			return ((elemTop <= docViewTop));
		},
		stickThatMenu: function(sticky,catcher,top) {
			var self = this;

			if(self.isScrolledTo(sticky,top)) {
				sticky.addClass('sticky-nav');
				catcher.height(sticky.height());
			} 
			var stopHeight = catcher.offset().top;
	
			if ( stopHeight > sticky.offset().top) {
				sticky.removeClass('sticky-nav');
				catcher.height(0);
			}
		},
		searchShow: function() {
			$('#trigger-overlay').on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				$('.overlay-slideleft').addClass('show');
				$('.search-row').find('input').focus();
			});
			$('.overlay-close').on('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				$('.overlay-slideleft').removeClass('show');
			});
			$(document).on('click', function(e){
				$('.overlay-slideleft').removeClass('show');
			});
			$('.overlay-slideleft').click(function(e){
				e.preventDefault();
				e.stopPropagation();
			});
		},
		toggledMenu: function() {
			var $top_menu = $('#top-menu');
			var $secondary_menu = $('#menu-main-menu');
			var $first_menu = '';
			var $second_menu = '';

			$('.sub-menu').parent().append('<span class="arrow-menu"><i class="fa fa-plus"></i></span>');

			if ($top_menu.length == 0 && $secondary_menu.length == 0) {
				return;
			} else {
				if ($top_menu.length) {
					$first_menu = $top_menu;
					if($secondary_menu.length) {
						$second_menu = $secondary_menu;
					}
				} else {
					$first_menu = $secondary_menu;
				}
			}
			var menu_wrapper = $first_menu
			.clone().attr('class', 'top-menu')
			.wrap('<div id="mobile-menu-wrapper" class="mobile-only"></div>').parent()
			.appendTo('body');
			
			// Add items from the other menu
			if ($second_menu.length) {
				$second_menu.clone().appendTo('#mobile-menu-wrapper');
			}

			$('.menu-toggle').click(function(e) {
				e.preventDefault();
				e.stopPropagation();
				$('#mobile-menu-wrapper').show(); // only required once
				$('body').toggleClass('mobile-menu-active');
			});

			$('#page').click(function() {
				if ($('body').hasClass('mobile-menu-active')) {
					$('body').removeClass('mobile-menu-active');
				}
			});

			if($('#wpadminbar').length) {
				$('#mobile-menu-wrapper').addClass('wpadminbar-active');
			}


			$('.arrow-menu').on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				var subMenuOpen = $(this).hasClass('sub-menu-open');

				if ( subMenuOpen ) {
					$(this).removeClass('sub-menu-open');
					$(this).find('i').removeClass('fa-minus').addClass('fa-plus');
					$(this).prev('ul.sub-menu').slideUp();
				} else {
					$(this).prev('ul.sub-menu').slideDown();
					$(this).addClass('sub-menu-open');
					$(this).find('i').removeClass('fa-plus').addClass('fa-minus');
				}

			});

		},
		scrollTop : function() {
			$(".back-to-top").click(function () {
				$('html, body').animate({scrollTop : 0},800);
				return false;
			});

			$(document).scroll ( function() {
				var topPositionScrollBar = $(document).scrollTop();
				if ( topPositionScrollBar < "150" ) {
					$(".back-to-top").fadeOut();
				} else {
					$(".back-to-top").fadeIn();
				}
			});
		},
		socialSharer: function() {
			if( $('.tc-social-sharing').length ) {
				//Call jqSocialSharer
				$('.tc-social-sharing a').jqSocialSharer();

				$('.btn-hide').on('click', function(e) {
					e.preventDefault();
					var open = $(this).hasClass('active');
					if(!open) {
						$(this).addClass('active');
						$('.sticky-left').addClass('hide-social');
					} else {
						$(this).removeClass('active');
						$('.sticky-left').removeClass('hide-social');
					}
				});
			}
		},
		infiniteLoading: function() {
			var pageNumber = 2;

			jQuery("#load-more-post").on('click', function(e) {

			if ( pageNumber <= totalPages ) {
				var that = this;
				e.preventDefault();

				var data = {
							action: 'infinite_scroll',
							nonce: blackwhiteLoadMore.nonce,
							page: pageNumber,
							query: blackwhiteLoadMore.query,
						};

				jQuery.ajax({
					url: blackwhiteLoadMore.url,
					type:'POST',
					data: data,
					beforeSend : function() {
						jQuery(that).html(jQuery(that).data('loading'));
					}

				}).done(function(html) {
					jQuery(".post-wrap").append(html);
					jQuery(that).html(jQuery(that).data('more'));
				});
				pageNumber++;

				if ( pageNumber > totalPages ) {
					jQuery(this).parent().hide();
				}
			}

			e.preventDefault();

			});

		},
		infiniteScroll: function() {
			var pageNumber = 2;
			var isLoading = false;
			jQuery(window).scroll(function(){

				if($(window).scrollTop() + $(window).height() > $('#main').height()) {

					if (pageNumber <= totalPages && isLoading === false) {

						var data = {
							action: 'infinite_scroll',
							nonce: blackwhiteLoadMore.nonce,
							page: pageNumber,
							query: blackwhiteLoadMore.query,
						};
						
						jQuery.ajax({
							url: blackwhiteLoadMore.url,
							type: 'POST',
							data: data,
							beforeSend: function () {
								isLoading = true;
								$('.infinite-scroll').show();
							},
							success: function (data) {
								jQuery(".post-wrap").append(data); 
								isLoading = false;
								pageNumber++;
								$('.infinite-scroll').removeAttr('style');
							}

						});

					}
				}
			}); 
		},
		socialSaring: function() {
			var offsetTop = $('#content').offset();

			$('.wmpro-social-sharing.social-sharing-left').css('top', offsetTop.top + 130 );

			jQuery('.social-popup').on('click', function(e){
				var width = 580;
				var height = 470;

				var leftPosition, topPosition;

				leftPosition = (window.screen.width / 2) - ((width / 2) + 10);

				topPosition = (window.screen.height / 2) - ((height / 2) + 50);
				var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";

				var url = $(this).attr('href');
				window.open(url, 'socialSharer', windowFeatures);
				e.preventDefault();
			});

			//pinterest
			$('.social-pinterst').on("click", function(t) {
				t.preventDefault();

				try {
					var e = document.createElement('script');
					e.setAttribute('type', 'text/javascript');
					e.setAttribute('charset', 'UTF-8');
					e.setAttribute('src', '//assets.pinterest.com/js/pinmarklet.js?r=' + Math.random() * 99999999);
					document.body.appendChild(e);
				} catch (e) {

				}

				//record share
				Nova.Social.recordShare($(this).attr('data-socialsite'), $(this).attr('data-location'), Nova.System.articleId);
			});
		},
		loadSocialScript: function(d,s) {
			var js, fjs = d.getElementsByTagName(s)[0],
			load = function(url, id) {
				if (d.getElementById(id)) {
					return;
				}
				js = d.createElement(s);
				js.src = url;
				js.id = id;
				fjs.parentNode.insertBefore(js, fjs);
			};
			$('span.facebookbtn, .fb-like-box').exists(function() {
				load('//connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
			});
			$('span.gplusbtn').exists(function() {
				load('https://apis.google.com/js/plusone.js', 'gplus1js');
			});
			$('span.twitterbtn').exists(function() {
				load('//platform.twitter.com/widgets.js', 'tweetjs');
			});
			$('span.linkedinbtn').exists(function() {
				load('//platform.linkedin.com/in.js', 'linkedinjs');
			});
			$('span.pinbtn, .tc-pinterest-profile').exists(function() {
				load('//assets.pinterest.com/js/pinit.js', 'pinterestjs');
			});
			$('span.stumblebtn').exists(function() {
				load('//platform.stumbleupon.com/1/widgets.js', 'stumbleuponjs');
			});
		},
		skipLinkFocusFix: function() {
			var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
			is_opera	= navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
			is_ie		= navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

			if ( ( is_webkit || is_opera || is_ie ) && document.getElementById && window.addEventListener ) {
				window.addEventListener( 'hashchange', function() {
					var element = document.getElementById( location.hash.substring( 1 ) );

					if ( element ) {
						if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
							element.tabIndex = -1;

						element.focus();
					}
				}, false );
			}
		}
	};

	$(document).ready(function() {
		makanewsLite.initAll();
	});

})(jQuery);