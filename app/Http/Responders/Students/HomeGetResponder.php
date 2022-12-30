<?php

declare(strict_types=1);

namespace App\Http\Responders\Students;

use Illuminate\Http\Response;

class HomeGetResponder
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param array $data
     * @return Response
     */
    public function response(array $data = []): Response
    {
        $this->response->setContent(
            $this->view->make('students/students_home', $data)
        );

        return $this->response;
    }
}
