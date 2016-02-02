<?php

namespace Aurora;

use Aurora\Http\Presenters\ForgePaginationPresenter;
use Illuminate\Support\Collection;

class APIResponseCollection extends Collection
{
    /**
     * The collection's paginator.
     *
     * @var \Illuminate\Contracts\Pagination\Paginator
     */
    protected $paginator;

    /**
     * APIResponseCollection constructor.
     * @param array $response - Array of raw API responses
     * @param string $class - Class to create for contents
     */
    public function __construct($response, $class)
    {
        $items = [];
        foreach ($response['data'] as $item) {
            array_push($items, new $class($item));
        }

        // If the response is paginated, create a Paginator.
        if (isset($response['meta']['pagination'])) {
            $this->paginator = new \Illuminate\Pagination\LengthAwarePaginator(
                $response['data'],
                $response['meta']['pagination']['total'],
                $response['meta']['pagination']['per_page'],
                $response['meta']['pagination']['current_page'],
                ['path' => request()->path()]
            );
        }

        parent::__construct($items);
    }

    /**
     * Set the base path for the paginator.
     * @param $path
     * @return self
     */
    public function setPaginationPath($path)
    {
        $this->paginator->setPath($path);

        return $this;
    }

    /**
     * Append a query string to pagination links.
     * @param array $query
     * @return self
     */
    public function appendPaginationQuery($query)
    {
        $this->paginator->appends($query);

        return $this;
    }

    /**
     * Render pagination links to HTML.
     *
     * @return string
     */
    public function links()
    {
        $presenter = new ForgePaginationPresenter($this->paginator);

        return $presenter->render();
    }

    /**
     * Get the total number of results in the collection (including
     * those not currently fetched from the API).
     *
     * @return int
     */
    public function total()
    {
        return $this->paginator->total();
    }
}
