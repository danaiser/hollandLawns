jQuery(document).ready(function($){
	jQuery(".menu").tinyNav({
	  active: 'selected',
	  header: 'Menu',
	  label: ''
	});
});

/*! http://tinynav.viljamis.com v1.1 by @viljamis */
(function (jQuery, window, i) {
  jQuery.fn.tinyNav = function (options) {

    // Default settings
    var settings = jQuery.extend({
      'active' : 'selected', // String: Set the "active" class
      'header' : '', // String: Specify text for "header" and show header instead of the active item
      'label'  : '' // String: sets the <label> text for the <select> (if not set, no label will be added)
    }, options);

    return this.each(function () {

      // Used for namespacing
      i++;

      var jQuerynav = jQuery(this),
        // Namespacing
        namespace = 'tinynav',
        namespace_i = namespace + i,
        l_namespace_i = '.l_' + namespace_i,
        jQueryselect = jQuery('<select/>').attr("id", namespace_i).addClass(namespace + ' ' + namespace_i);

      if (jQuerynav.is('ul,ol')) {

        if (settings.header !== '') {
          jQueryselect.append(
            jQuery('<option/>').text(settings.header)
          );
        }

        // Build options
        var options = '';

        jQuerynav
          .addClass('l_' + namespace_i)
          .find('a')
          .each(function () {
            options += '<option value="' + jQuery(this).attr('href') + '">';
            var j;
            for (j = 0; j < jQuery(this).parents('ul, ol').length - 1; j++) {
              options += '- ';
            }
            options += jQuery(this).text() + '</option>';
          });

        // Append options into a select
        jQueryselect.append(options);

        // Select the active item
        if (!settings.header) {
          jQueryselect
            .find(':eq(' + jQuery(l_namespace_i + ' li')
            .index(jQuery(l_namespace_i + ' li.' + settings.active)) + ')')
            .attr('selected', true);
        }

        // Change window location
        jQueryselect.change(function () {
          window.location.href = jQuery(this).val();
        });

        // Inject select
        jQuery(l_namespace_i).after(jQueryselect);

        // Inject label
        if (settings.label) {
          jQueryselect.before(
            jQuery("<label/>")
              .attr("for", namespace_i)
              .addClass(namespace + '_label ' + namespace_i + '_label')
              .append(settings.label)
          );
        }

      }

    });

  };
})(jQuery, this, 0);