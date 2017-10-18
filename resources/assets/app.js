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
  // Lazy-load user count in the background.
  lazyCount.initialize();

  // Initialize `data-confirm` link handler.
  confirm.initialize();

  // Prevent form double submission.
  formLoader.initialize();

  // Initialize `data-method` link handler.
  methodLink.initialize();
});
