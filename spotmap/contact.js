
jQuery.noConflict();

/* JavaScript Document
 * jQuery gMap
 *
 * @url		http://gmap.nurtext.de/
 * @author	Cedric Kastner <cedric@nur-text.de>
 * @version	1.0.3
 */
(function($)
{
	// Main plugin function
	$.fn.gMap = function(options)
	{
		// Check if the browser is compatible with Google Maps
		if (!window.GBrowserIsCompatible || !GBrowserIsCompatible()) return this;
		// Build main options before element iteration
		var opts = $.extend({}, $.fn.gMap.defaults, options);
		// Iterate each matched element
		return this.each(function()
		{
			// Create new map and set initial options
			$gmap = new GMap2(this);
			// Try to center to the first marker
			if (!opts.latitude && !opts.longitude)
			{
				// Check for at least one marker
				if (is_array(opts.markers) && opts.markers.length >= 1)
				{
					// Center to the first marker
					opts.latitude  =  opts.markers[0].latitude;
					opts.longitude =  opts.markers[0].longitude;
				}
				else
				{
					// Center Earth and lower zoom
					opts.latitude = 34.885931;
					opts.longitude = 9.84375;
					opts.zoom = 2;
					
				}
			}
			// Center the map and set the maptype
			$gmap.setCenter(new GLatLng(opts.latitude, opts.longitude), opts.zoom);
			$gmap.setMapType(opts.maptype);
			
			// Check for custom map controls
			if (opts.controls.length == 0)
			{
				// Default map controls
				$gmap.setUIToDefault();
				
			}
			else
			{
				// Add custom map controls
				for (var i = 0; i < opts.controls.length; i++)
				{
					// Eval is evil - I know. ;)
					eval('$gmap.addControl(new ' + opts.controls[i] + '());');
				}
			}	
			// Check if scrollwheel should be enabled when using custom controls
			if (opts.scrollwheel == true && opts.controls.length != 0) { $gmap.enableScrollWheelZoom(); }
			// Add all map markers
			for (var j = 0; j < opts.markers.length; j++)
			{
				// Get the options from current marker
				marker = opts.markers[j];
				// Create new icon
				gicon = new GIcon();
				// Set icon properties from global options
				gicon.image = opts.icon.image;
				gicon.shadow = opts.icon.shadow;
				gicon.iconSize = (is_array(opts.icon.iconsize)) ? new GSize(opts.icon.iconsize[0], opts.icon.iconsize[1]) : opts.icon.iconsize;
				gicon.shadowSize = (is_array(opts.icon.shadowsize)) ? new GSize(opts.icon.shadowsize[0], opts.icon.shadowsize[1]) : opts.icon.shadowsize;
				gicon.iconAnchor = (is_array(opts.icon.iconanchor)) ? new GPoint(opts.icon.iconanchor[0], opts.icon.iconanchor[1]) : opts.icon.iconanchor;
				gicon.infoWindowAnchor = (is_array(opts.icon.infowindowanchor)) ? new GPoint(opts.icon.infowindowanchor[0], opts.icon.infowindowanchor[1]) : opts.icon.infowindowanchor;
				if (marker.icon)
				{
					// Overwrite global options with ther marker one's
					gicon.image = marker.icon.image;
					gicon.shadow = marker.icon.shadow;
					gicon.iconSize = (is_array(marker.icon.iconsize)) ? new GSize(marker.icon.iconsize[0], marker.icon.iconsize[1]) : marker.icon.iconsize;
					gicon.shadowSize = (is_array(marker.icon.shadowsize)) ? new GSize(marker.icon.shadowsize[0], marker.icon.shadowsize[1]) : marker.icon.shadowsize;
					gicon.iconAnchor = (is_array(marker.icon.iconanchor)) ? new GPoint(marker.icon.iconanchor[0], marker.icon.iconanchor[1]) : marker.icon.iconanchor;
					gicon.infoWindowAnchor = (is_array(marker.icon.infowindowanchor)) ? new GPoint(marker.icon.infowindowanchor[0], marker.icon.infowindowanchor[1]) : marker.icon.infowindowanchor;
					
				}			
				// Create a new marker on the map
				gmarker = new GMarker(new GPoint(marker.longitude, marker.latitude), gicon);
				
				// Only display info window if the marker contains a description
				if (marker.html)
				{
					// Bind the info window to marker
					gmarker.bindInfoWindowHtml(opts.html_prepend + marker.html + opts.html_append);
					// Add overlay if marker was created and check if popup should be shown when map is loaded
					if (gmarker) { $gmap.addOverlay(gmarker); }
					if (marker.popup == true) { gmarker.openInfoWindowHtml(opts.html_prepend + marker.html + opts.html_append); }
				}
				else
				{
					// Add overlay marker
					if (gmarker) { $gmap.addOverlay(gmarker); }
				}
			}
		});
	}
	// Function to check if array or not
	function is_array(input)
	{
		return typeof(input) == 'object' && (input instanceof Array);
  	}
	// Set default settings
	$.fn.gMap.defaults =
	{
		latitude:				0,
		longitude:				0,
		zoom:					6,
		markers:				[],
		controls:				[],
		scrollwheel:			true,
		maptype:				G_NORMAL_MAP,
		html_prepend:			'<div class="gmap_marker">',
		html_append:			'</div>',
		icon:
		{
			image:				"http://www.google.com/mapfiles/marker.png",
			shadow:				"http://www.google.com/mapfiles/shadow50.png",
			iconsize:			[20, 34],
			shadowsize:			[37, 34],
			iconanchor:			[9, 34],
			infowindowanchor:	[9, 2]
		}
	}
})(jQuery);


/* Inititalize Google Map */
jQuery(document).ready(function() {
	jQuery("#map").gMap({ 
			markers: [
					  // Corporate Office
					  { latitude: 13.02917,
					  	longitude: 80.25010,
						html: "Corporate Office"
						},
					  // regional Alwarpet
					  { latitude: 13.04024,
					  	longitude: 80.25772,
						html: "Regional Office Alwarpet"
						},
					  // regional Adayar
					  { latitude: 13.02891,
					  	longitude: 80.25653,
						html: "Regional Office Adayar"
						},
						
					  // regional AnnaNagar
					  { latitude: 13.08487,
					  	longitude: 80.21291,
						html: "Regional Office AnnaNagar"
						},
						
					  // regional Vadapalani
					  { latitude: 13.04743,
					  	longitude: 80.20163,
						html: "Regional Office Vadapalani"
						},
						
					  // regional Velachery
					  { latitude: 12.97229,
					  	longitude: 80.22655,
						html: "Regional Office Velachery"
						},
						
					  // regional Coimbatore
					  { latitude: 11.01320,
					  	longitude: 76.96337,
						html: "Regional Office Coimbatore"
						},
						
					  // regional Trichy
					  { latitude: 10.80289,
					  	longitude: 78.69875,
						html: "Regional Office Trichy"
						},
						
					  // regional Pondicherry
					  { latitude: 11.93197,
					  	longitude: 79.81645,
						html: "Regional Office Pondicherry"
						},
					// regional Calicut
					  { latitude: 11.25561,
					  	longitude: 75.78103,
						html: "Regional Office Calicut"
						},
					// regional Cochin1
					  { latitude:  9.96505,
					  	longitude: 76.28910,
						html: "Regional Office Cochin"
						},
					// regional Cochin2
					  { latitude:  9.93925,
					  	longitude: 76.25962,
						html: "Regional Office Cochin"
						},
					// regional THRISSUR
					  { latitude:  10.57595,
					  	longitude: 76.02939,
						html: "Regional Office Thrissur"
						},
					// regional KOTTAYAM
					  { latitude:  9.64318,
					  	longitude: 76.54557,
						html: "Regional Office Kottayam"
						},
					// regional Trivandrum
					  { latitude:  8.52057,
					  	longitude: 76.94198,
						html: "Regional Office Trivandrum"
						},
					// regional KOLLAM
					  { latitude: 8.52616,
					  	longitude: 76.93909,
						html: "Regional Office Kollam"
						},
					// regional PATHANAMTHITTA
					  { latitude: 9.27000,
					  	longitude: 76.78000,
						html: "Regional Office Pathanamthitta"
						},
					// regional AMEERPET
					  { latitude: 17.43523,
					  	longitude: 78.45189,
						html: "Regional Office Ameerpet"
						},
					// regional MALAKPET
					  { latitude: 17.37223,
					  	longitude: 78.51043,
						html: "Regional Office Malakpet"
						},
					// regional Tirupati
					  { latitude: 13.63690,
					  	longitude: 79.42274,
						html: "Regional Office Tirupati"
						},
					// regional Mehdipattinam
					  { latitude: 17.39867,
					  	longitude: 78.43256,
						html: "Regional Office Mehdipattinam"
						},
					// regional Secundrabad
					  { latitude: 17.44136,
					  	longitude: 78.49158,
						html: "Regional Office Secundrabad"
						},
					// regional Visakhapatnam
					  { latitude: 17.71707,
					  	longitude: 83.30919,
						html: "Regional Office Visakhapatnam"
						},
					// regional Anakapalle
					  { latitude: 17.68600,
					  	longitude: 83.00878,
						html: "Regional Office Anakapalle"
						},
					// regional Kukatpally
					  { latitude: 17.48498,
					  	longitude: 78.37847,
						html: "Regional Office Kukatpally"
						},
					// regional Rajahmundry
					  { latitude: 17.01016,
					  	longitude: 81.78791,
						html: "Regional Office Rajahmundry"
						},
					// regional Bangalore
					  { latitude: 12.97543,
					  	longitude: 77.58636,
						html: "Regional Office Bangalore"
						},
					// regional JayNagar
					  { latitude:  12.92745,
					  	longitude: 77.59060,
						html: "Regional Office JayNagar"
						},
					// regional Mysore
					  { latitude:  13.07116,
					  	longitude: 77.53830,
						html: "Regional Office Mysore"
						},
					// orissa Map
					  { latitude:  20.28262,
					  	longitude: 85.81662,
						html: "Regional Office orissa"
						},
					// assam Map
					  { latitude:  26.13596,
					  	longitude: 91.80246,
						html: "Regional Office Assam"
						},
					// uttarpradesh Map
					  { latitude:  18.85491,
					  	longitude: 83.87174,
						html: "Regional Office Uttarpradesh"
						}
					],
			latitude: 18.170906,
			longitude: 84.272459,
			zoom: 4,
			controls: ["GSmallMapControl", "GMapTypeControl"]
	});


});