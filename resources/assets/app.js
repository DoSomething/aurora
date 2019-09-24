import $ from 'jquery';
import Turbolinks from 'turbolinks';

// Import Forge, the DoSomething.org pattern library.
import '@dosomething/forge';

// Import stylesheets.
import './app.scss';

// Utilities
import ready from './utilities/dom-ready';
import confirm from './utilities/confirm';
import formLoader from './utilities/form-loader';
import methodLink from './utilities/method-link';

// Users
import lazyCount from './users/lazy-user-count';

/**
 * Let's go!
 */
ready(function() {
  // Let's go turbo!
  Turbolinks.start()
  let scrollPosition = null;

  // Optionally, keep scroll position when loading a page via Turbolinks:
  const noScrollSelector = '[data-turbolinks-scroll=false]';
  $(document).on('click', noScrollSelector, () => scrollPosition = window.scrollY);
  $(document).on('turbolinks:render', () => {
    if (scrollPosition) {
      window.scrollTo(0, scrollPosition);
    }

    scrollPosition = null;
  });

  // Display environment badge on local, dev, or QA:
  require('environment-badge')();

  // Lazy-load user count in the background.
  lazyCount.initialize();

  // Initialize `data-confirm` link handler.
  confirm.initialize();

  // Prevent form double submission.
  formLoader.initialize();

  // Initialize `data-method` link handler.
  methodLink.initialize();
});
