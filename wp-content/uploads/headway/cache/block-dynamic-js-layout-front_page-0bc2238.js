jQuery(document).ready(function(){

					if ( typeof window.selectnav != "function" )
						return false;

					selectnav(jQuery("#block-10").find("ul.menu")[0], {
						label: "-- Navigation --",
						nested: true,
						indent: "-",
						activeclass: "current-menu-item"
					});

					jQuery("#block-10").find("ul.menu").addClass("selectnav-active");

				});



