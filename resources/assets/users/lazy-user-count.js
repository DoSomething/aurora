import { RestApiClient } from '@dosomething/gateway';

/**
 * Lazy load user count if it's on the page.
 */
async function initialize() {
  const element = document.getElementById('lazy-user-count');
  if (! element) {
    return;
  }

  const aurora = new RestApiClient(window.location.origin, {
    headers: { 'Authorization' : `Bearer ${window.AUTH}`}
  });

  const response = await aurora.get('api/total');
  element.innerText = response ? response['total'] : '???';
  element.classList = 'lazy-loading is-loaded';
}

export default { initialize };
