;
(function() {

  var Modal = function() {

    var prefix = 'Modal-';

    this.Class = {
      stopOverflow: prefix + 'cancel-overflow',
      overlay: prefix + 'overlay',
      box: prefix + 'box',
      close: prefix + 'close'
    };

    this.Selector = {
      overlay: '.' + this.Class.overlay,
      box: '.' + this.Class.box,
      button: '[data-modal=button]'
    };

    this.Markup = {
      close: '<div class="close ' + this.Class.close + ' "></div>',
      overlay: '<div class=" ' + this.Class.overlay + ' "></div>',
      box: '<div class=" ' + this.Class.box + ' "></div>'
    }

    this.youtubeID = false;

  };

  Modal.prototype = {

    toggleOverflow: function() {
      jQuery('body').toggleClass(this.Class.stopOverflow);
    },

    videoContainer: function() {
      return '<div class="video-container"><iframe id="player" src="https://www.youtube.com/embed/' + this.youtubeID + '?autoplay=1&rel=0" frameborder="0"></iframe></div>';
    },

    addOverlay: function() {

      var self = this;

      jQuery(this.Markup.overlay).appendTo('body').fadeIn('slow', function() {
        self.toggleOverflow();
      });

      jQuery(this.Selector.overlay).on('click touchstart', function() {
        self.closeModal();
      })

    },

    addModalBox: function() {
      jQuery(this.Markup.box).appendTo(this.Selector.overlay);
    },

    buildModal: function(youtubeID) {

      this.addOverlay();
      this.addModalBox();

      jQuery(this.Markup.close).appendTo(this.Selector.overlay);
      jQuery(this.videoContainer(youtubeID)).appendTo(this.Selector.box);

    },

    closeModal: function() {

      this.toggleOverflow();

      jQuery(this.Selector.overlay).fadeOut().detach();
      jQuery(this.Selector.box).empty();

    },

    getYoutubeID: function() {
      return this.youtubeID;
    },

    setYoutubeID: function(href) {

      var id = '';

      if (href.indexOf('youtube.com') > -1) {
        // full Youtube link
        id = href.split('v=')[1];
      } else if (href.indexOf('youtu.be') > -1) {
        // shortened Youtube link
        id = href.split('.be/')[1];
      } else {
        // in case it's not a Youtube link, send them on their merry way
        document.location = href;
      }

      // If there's an ampersand, remove it and return what's left, otherwise return the ID
      this.youtubeID = (id.indexOf('&') != -1) ? id.substring(0, amp) : id;

    },

    startup: function(href) {

      this.setYoutubeID(href);

      if (this.youtubeID) {
        this.buildModal();
      }

    }

  };

  jQuery(document).ready(function() {

    var modal = new Modal();

    jQuery(modal.Selector.button).on('click touchstart', function(e) {
      e.preventDefault();
      modal.startup(this.href);
    });

  });

})(this);