jQuery(document).ready(function($) {	
	//Setup Flickr Feed
    $('.flickr-feed').jflickrfeed({
      limit: flickrSetings.flickr_item_limit,
      qstrings: {
        id: flickrSetings.flickr_id
      },
      itemTemplate: '<div class="flickr-thumb flickr-photo"><a href="{{image_b}}" target="_blank"><img src="{{image_m}}" alt="{{title}}" /></a></div>'
    });
});    