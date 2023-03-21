<?php

declare(strict_types=1);

namespace App\Http\Responders\Students;

use Illuminate\Http\Response;
use Illuminate\Contracts\View\Factory AS ViewFactory;

class AnswerFormGetResponder
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
        $this->response->setContent(
            $this->view->make('students/answer_form', $data)
        );

        return $this->response;
    }
}
