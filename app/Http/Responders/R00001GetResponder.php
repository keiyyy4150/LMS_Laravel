<?php

declare(strict_types=1);

namespace App\Http\Responders\S00;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\Response;

class R00001GetResponder
{
    protected $response;
    protected $view;

    public function __construct(Response $response, ViewFactory $view)
    {
        $this->response = $response;
        $this->view = $view;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []): Response
    {
        $this->response->setContent(
            $this->view->make('S00/00001', $data)
        );

        return $this->response;
    }
}
