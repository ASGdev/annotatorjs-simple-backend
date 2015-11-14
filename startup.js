
      jQuery(function ($) {
        if (typeof $.fn.annotator !== 'function') {
          alert("Ooops! it looks like you haven't built the Annotator concatenation file. " +
                "Either download a tagged release from GitHub, or modify the Cakefile to point " +
                "at your copy of the YUI compressor and run `cake package`.");
        } else {
          // This is the important bit: how to create the annotator and add
          // plugins
          var app = $('body').annotator();
          app.annotator('addPlugin', 'Store', {
		    // This is the API endpoint. If the server supports Cross Origin Resource
		    // Sharing (CORS) a full URL can be used here. Defaults to /store. The
		    // trailing slash should be omitted.
    		prefix: 'http://projets.dev/RUNNING/ired-engine',
    		urls: {
		      // These are the default URLs.
		      create:  '/annotations/',
		      update:  '/annotations/:id',
		      destroy: '/annotations/:id',
		      search:  '/search'
		    },
    // An object literal containing query string parameters to query the store.
    // If loadFromSearch is set, then we load the first batch of annotations
    //from the ‘search’ URL as set in options.urls instead of the registry path
    // ‘prefix/read’. Defaults to false.
    /*loadFromSearch: {
      'limit': 20,
      'all_fields': 1,
      'uri': 'http://localhost:4000/example/page/to/annotate'
    },*/

    // If true will display the "anyone can view this annotation" checkbox.
    showViewPermissionsCheckbox: false,
    // If true will display the "anyone can edit this annotation" checkbox.
    showEditPermissionsCheckbox: false
  });
        }
      });
    