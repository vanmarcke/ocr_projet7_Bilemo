<?php

namespace App\Api;

use Doctrine\DBAL\Query;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PaginatorApi
{
    private array $infos;
    private $items;

    public function __construct(private PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Method paginate.
     *
     * @param Request $request Request a display of 10 items per page
     * @param         $query   Query result
     */
    public function paginate(Request $request, $query)
    {
        $items = $this->paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /* page number */
            10 /* limit per page */
        );

        $nbOfPages = ceil($items->getTotalItemCount() / 10);

        if ($request->query->getInt('page', 1) > $nbOfPages && $items->getTotalItemCount() > 0) {
            return $this->api->badRequest([
                'error' => 'page ' . $request->query->getInt('page', 1) . " doesn't exist, last page : $nbOfPages",
            ]);
        }

        $this->items = $items;

        $this->infos = [
            'infos' => [
                'page' => $request->query->getInt('page', 1) . " of $nbOfPages",
                'total_items' => $items->getTotalItemCount(),
            ],
        ];

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getInfos()
    {
        return $this->infos;
    }
}
