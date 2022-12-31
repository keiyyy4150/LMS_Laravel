<?php

declare(strict_types=1);

namespace App\Http\Responders\Students;

use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory AS ViewFactory;

class HomeGetResponder
{
    protected $response;
    protected $view;

    public function __construct(Response $response, ViewFactory $view)
    {
        $this->response = $response;
        $this->view     = $view;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []): Response
    {
        if (empty($data)) {
            $this->response->setStatusCode(Response::HTTP_NOT_FOUND);
            $this->response->setContent(
                $this->view->make('errors.404')
            );
            return $this->response;
        }

        $this->response->setContent(
            $this->view->make('students/students_home', $data)
        );

        return $this->response;
    }
}
