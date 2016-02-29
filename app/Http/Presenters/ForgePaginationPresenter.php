<?php

namespace Aurora\Http\Presenters;

use Illuminate\Contracts\Pagination\Presenter as PresenterContract;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Pagination\UrlWindowPresenterTrait;

class ForgePaginationPresenter implements PresenterContract
{
    use UrlWindowPresenterTrait;

    /**
     * The paginator implementation.
     *
     * @var \Illuminate\Contracts\Pagination\Paginator
     */
    protected $paginator;

    /**
     * The URL window data structure.
     *
     * @var array
     */
    protected $window;

    /**
     * Create a new Bootstrap presenter instance.
     *
     * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
     * @param  \Illuminate\Pagination\UrlWindow|null  $window
     */
    public function __construct($paginator, UrlWindow $window = null)
    {
        $this->paginator = $paginator;
        $this->window = is_null($window) ? UrlWindow::make($paginator) : $window->get();
    }

    /**
     * Determine if the underlying paginator being presented has pages to show.
     *
     * @return bool
     */
    public function hasPages()
    {
        return $this->paginator->hasPages();
    }

    /**
     * Convert the URL window into Bootstrap HTML.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="waypoints -primary -pagination">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }

        return '';
    }

    /**
     * Get HTML wrapper for an available page link.
     *
     * @param  string  $url
     * @param  int  $page
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page)
    {
        return '<li><a href="'.htmlentities($url).'">'.$page.'</a></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="is-active"><a href="#">'.$text.'</a></li>';
    }

    /**
     * Get a pagination "dot" element.
     *
     * @return string
     */
    protected function getDots()
    {
        return '<li><span class="footnote">...</span></li>';
    }

    /**
     * Get the previous page pagination element.
     *
     * @return string
     */
    public function getPreviousButton()
    {
        // Don't return a "previous" button if we're on the first page
        if ($this->paginator->currentPage() <= 1) {
            return '';
        }

        $url = $this->paginator->url($this->paginator->currentPage() - 1);

        return $this->getPageLinkWrapper($url, '&laquo; Prev', 'prev');
    }

    /**
     * Get the next page pagination element.
     *
     * @return string
     */
    public function getNextButton()
    {
        // Don't return a "next" button if there are no more pages
        if (! $this->paginator->hasMorePages()) {
            return '';
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, 'Next &raquo;', 'next');
    }
}
